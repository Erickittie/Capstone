<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use App\Models\Group;
use App\Models\Project;
use App\Models\Task;
use App\Models\TaskAssignment;
use App\Models\TaskSubmission;
use App\Models\Student\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function project($classId, $projectId)
    {
        $student = Auth::user();

        $class = ClassRoom::where('id', $classId)
            ->whereHas('students', function ($query) use ($student) {
                $query->where('users.id', $student->id);
            })
            ->firstOrFail();

        $group = Group::where('class_room_id', $class->id)
            ->whereHas('students', function ($query) use ($student) {
                $query->where('users.id', $student->id);
            })
            ->with('students')
            ->firstOrFail();

        $project = Project::where('id', $projectId)
            ->where('class_room_id', $class->id)
            ->whereHas('groups', function ($query) use ($group) {
                $query->where('groups.id', $group->id);
            })
            ->with([
                'groups.students',
                'tasks.assignments.student'
            ])
            ->firstOrFail();

        $membership = $group->students()
            ->where('users.id', $student->id)
            ->first();

        $isLeader = $membership && $membership->pivot->is_leader;

        $myTasks = $project->tasks()
            ->where('group_id', $group->id)
            ->whereHas('assignments', function ($query) use ($student) {
                $query->where('student_id', $student->id);
            })
            ->with([
                'assignments' => function ($query) use ($student) {
                    $query->where('student_id', $student->id);
                }
            ])
            ->latest()
            ->get();

        return view(
            'student.project',
            compact(
                'student',
                'class',
                'group',
                'project',
                'isLeader',
                'myTasks'
            )
        );
    }


    public function show($classId, $projectId, $taskId)
    {
        $student = Auth::user();

        $class = ClassRoom::where('id', $classId)
            ->whereHas('students', function ($query) use ($student) {
                $query->where('users.id', $student->id);
            })
            ->firstOrFail();

        $group = Group::where('class_room_id', $class->id)
            ->whereHas('students', function ($query) use ($student) {
                $query->where('users.id', $student->id);
            })
            ->with('students')
            ->firstOrFail();

        $project = Project::where('id', $projectId)
            ->where('class_room_id', $class->id)
            ->whereHas('groups', function ($query) use ($group) {
                $query->where('groups.id', $group->id);
            })
            ->firstOrFail();

        $task = Task::where('id', $taskId)
            ->where('project_id', $project->id)
            ->where('group_id', $group->id)
            ->whereHas('assignments', function ($query) use ($student) {
                $query->where('student_id', $student->id);
            })
            ->with([
                'assignments' => function ($query) use ($student) {
                    $query->where('student_id', $student->id);
                }
            ])
            ->firstOrFail();

        $assignment = $task->assignments->first();

        return view(
            'student.tasks.show',
            compact(
                'student',
                'class',
                'group',
                'project',
                'task',
                'assignment'
            )
        );
    }


    public function create($classId, $projectId)
    {
        $student = Auth::user();

        $class = ClassRoom::where('id', $classId)
            ->whereHas('students', function ($query) use ($student) {
                $query->where('users.id', $student->id);
            })
            ->firstOrFail();

        $group = Group::where('class_room_id', $class->id)
            ->whereHas('students', function ($query) use ($student) {
                $query->where('users.id', $student->id);
            })
            ->with('students')
            ->firstOrFail();

        $membership = $group->students()
            ->where('users.id', $student->id)
            ->first();

        if (!$membership || !$membership->pivot->is_leader) {
            abort(403, 'Only the Group Leader / PM can create tasks.');
        }

        $project = Project::where('id', $projectId)
            ->where('class_room_id', $class->id)
            ->whereHas('groups', function ($query) use ($group) {
                $query->where('groups.id', $group->id);
            })
            ->firstOrFail();

        return view(
            'student.tasks.create',
            compact(
                'student',
                'class',
                'group',
                'project'
            )
        );
    }


    public function store(Request $request, $classId, $projectId)
    {
        $student = Auth::user();

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'points' => ['required', 'integer', 'min:1'],
            'due_date' => ['nullable', 'date'],
            'assignees' => ['required', 'array', 'min:1'],
            'assignees.*' => ['integer'],
        ]);

        $class = ClassRoom::where('id', $classId)
            ->whereHas('students', function ($query) use ($student) {
                $query->where('users.id', $student->id);
            })
            ->firstOrFail();

        $group = Group::where('class_room_id', $class->id)
            ->whereHas('students', function ($query) use ($student) {
                $query->where('users.id', $student->id);
            })
            ->with('students')
            ->firstOrFail();

        $membership = $group->students()
            ->where('users.id', $student->id)
            ->first();

        if (!$membership || !$membership->pivot->is_leader) {
            abort(403, 'Only the Group Leader / PM can create tasks.');
        }

        $project = Project::where('id', $projectId)
            ->where('class_room_id', $class->id)
            ->whereHas('groups', function ($query) use ($group) {
                $query->where('groups.id', $group->id);
            })
            ->firstOrFail();

        $memberIds = $group->students
            ->pluck('id')
            ->toArray();

        $invalidAssignees = array_diff(
            $request->assignees,
            $memberIds
        );

        if (!empty($invalidAssignees)) {
            return back()
                ->withInput()
                ->withErrors([
                    'assignees' =>
                        'You can only assign tasks to members of your group.'
                ]);
        }

        DB::transaction(function () use (
            $request,
            $project,
            $group
        ) {

            $task = Task::create([
                'project_id' => $project->id,
                'group_id' => $group->id,
                'title' => $request->title,
                'description' => $request->description,
                'points' => $request->points,
                'due_date' => $request->due_date,
                'status' => 'Pending',
            ]);

            foreach ($request->assignees as $studentId) {

                TaskAssignment::create([
                    'task_id' => $task->id,
                    'student_id' => $studentId,
                    'status' => 'Assigned',
                ]);
            }
        });

        return redirect()
            ->route('student.project.show', [
                'classId' => $class->id,
                'projectId' => $project->id,
            ])
            ->with(
                'success',
                'Task created and assigned successfully.'
            );
    }


    public function start($classId, $projectId, $taskId)
    {
        $student = Auth::user();

        $class = ClassRoom::where('id', $classId)
            ->whereHas('students', function ($query) use ($student) {
                $query->where('users.id', $student->id);
            })
            ->firstOrFail();

        $group = Group::where('class_room_id', $class->id)
            ->whereHas('students', function ($query) use ($student) {
                $query->where('users.id', $student->id);
            })
            ->firstOrFail();

        $project = Project::where('id', $projectId)
            ->where('class_room_id', $class->id)
            ->whereHas('groups', function ($query) use ($group) {
                $query->where('groups.id', $group->id);
            })
            ->firstOrFail();

        $assignment = TaskAssignment::where('task_id', $taskId)
            ->where('student_id', $student->id)
            ->whereHas('task', function ($query) use ($project, $group) {
                $query->where('project_id', $project->id)
                    ->where('group_id', $group->id);
            })
            ->firstOrFail();

        if ($assignment->status === 'Assigned') {

            $assignment->update([
                'status' => 'In Progress',
                'started_at' => now(),
            ]);
        }

        return redirect()->route('student.tasks.show', [
            'classId' => $class->id,
            'projectId' => $project->id,
            'taskId' => $taskId,
        ])->with(
            'success',
            'Task started successfully.'
        );
    }


    public function submit(Request $request, $classId, $projectId, $taskId)
    {
        $student = Auth::user();

        $request->validate([
            'submission_text' => 'nullable|string|max:10000',
            'file' => 'nullable|file|max:10240|mimes:pdf,doc,docx,txt,zip,jpg,jpeg,png',
        ]);

        $class = ClassRoom::where('id', $classId)
            ->whereHas('students', function ($query) use ($student) {
                $query->where('users.id', $student->id);
            })
            ->firstOrFail();

        $group = Group::where('class_room_id', $class->id)
            ->whereHas('students', function ($query) use ($student) {
                $query->where('users.id', $student->id);
            })
            ->firstOrFail();

        $project = Project::where('id', $projectId)
            ->where('class_room_id', $class->id)
            ->whereHas('groups', function ($query) use ($group) {
                $query->where('groups.id', $group->id);
            })
            ->firstOrFail();

        $assignment = TaskAssignment::where('task_id', $taskId)
            ->where('student_id', $student->id)
            ->whereHas('task', function ($query) use ($project, $group) {
                $query->where('project_id', $project->id)
                    ->where('group_id', $group->id);
            })
            ->firstOrFail();

        if ($assignment->status !== 'In Progress') {
            return back()->with(
                'error',
                'This task cannot be submitted right now.'
            );
        }

        if (
            !$request->filled('submission_text')
            && !$request->hasFile('file')
        ) {
            return back()
                ->withErrors([
                    'submission' =>
                        'Please provide a description or upload a file.'
                ])
                ->withInput();
        }

        $filePath = null;

        if ($request->hasFile('file')) {

            $filePath = $request->file('file')->store(
                'submissions',
                'public'
            );
        }

        TaskSubmission::create([
            'task_id' => $taskId,
            'student_id' => $student->id,
            'submission_text' => $request->submission_text,
            'file_path' => $filePath,
            'status' => 'Pending',
            'submitted_at' => now(),
        ]);

        /*
         * IMPORTANT:
         * Do NOT set completed_at here.
         * The task is only completed after the
         * Group Leader / PM approves the submission.
         */

        $assignment->update([
            'status' => 'Submitted',
        ]);

        return redirect()->route('student.tasks.show', [
            'classId' => $class->id,
            'projectId' => $project->id,
            'taskId' => $taskId,
        ])->with(
            'success',
            'Task submitted successfully.'
        );
    }


    public function review($classId, $projectId, $taskId)
    {
        $student = Auth::user();

        $class = ClassRoom::where('id', $classId)
            ->whereHas('students', function ($query) use ($student) {
                $query->where('users.id', $student->id);
            })
            ->firstOrFail();

        $group = Group::where('class_room_id', $class->id)
            ->whereHas('students', function ($query) use ($student) {
                $query->where('users.id', $student->id);
            })
            ->with('students')
            ->firstOrFail();

        $project = Project::where('id', $projectId)
            ->where('class_room_id', $class->id)
            ->whereHas('groups', function ($query) use ($group) {
                $query->where('groups.id', $group->id);
            })
            ->firstOrFail();

        $leader = $group->students()
            ->where('users.id', $student->id)
            ->wherePivot('is_leader', true)
            ->exists();

        abort_unless(
            $leader,
            403,
            'Only the group leader can review submissions.'
        );

        $task = Task::where('id', $taskId)
            ->where('project_id', $project->id)
            ->where('group_id', $group->id)
            ->with([
                'assignments.student',
                'submissions.student',
            ])
            ->firstOrFail();

        $submissions = $task->submissions()
            ->with('student')
            ->latest('submitted_at')
            ->get();

        return view(
            'student.tasks.review',
            compact(
                'student',
                'class',
                'group',
                'project',
                'task',
                'submissions'
            )
        );
    }


    public function approveSubmission(
        Request $request,
        $classId,
        $projectId,
        $taskId,
        $submissionId
    ) {
        $student = Auth::user();

        $request->validate([
            'feedback' => 'nullable|string|max:10000',
        ]);

        $class = ClassRoom::where('id', $classId)
            ->whereHas('students', function ($query) use ($student) {
                $query->where('users.id', $student->id);
            })
            ->firstOrFail();

        $group = Group::where('class_room_id', $class->id)
            ->whereHas('students', function ($query) use ($student) {
                $query->where('users.id', $student->id);
            })
            ->firstOrFail();

        $isLeader = $group->students()
            ->where('users.id', $student->id)
            ->wherePivot('is_leader', true)
            ->exists();

        abort_unless(
            $isLeader,
            403,
            'Only the group leader can approve submissions.'
        );

        $project = Project::where('id', $projectId)
            ->where('class_room_id', $class->id)
            ->whereHas('groups', function ($query) use ($group) {
                $query->where('groups.id', $group->id);
            })
            ->firstOrFail();

        $task = Task::where('id', $taskId)
            ->where('project_id', $project->id)
            ->where('group_id', $group->id)
            ->firstOrFail();

        $submission = TaskSubmission::where('id', $submissionId)
            ->where('task_id', $task->id)
            ->where('status', 'Pending')
            ->firstOrFail();

        $submission->update([
            'status' => 'Approved',
            'approved_at' => now(),
            'approved_by' => $student->id,
            'feedback' => $request->feedback,
        ]);

        TaskAssignment::where('task_id', $task->id)
            ->where('student_id', $submission->student_id)
            ->update([
                'status' => 'Approved',
                'completed_at' => now(),
            ]);

        // 🔔 NOTIFY THE STUDENT
        Notification::create([
            'user_id' => $submission->student_id,
            'type' => 'task_approved',
            'title' => 'Task Approved',
            'message' => 'Your submission for "' . $task->title . '" has been approved by the Group Leader.',
            'task_id' => $task->id,
            'submission_id' => $submission->id,
            'is_read' => false,
        ]);

        return redirect()
            ->route('student.tasks.review', [
                'classId' => $class->id,
                'projectId' => $project->id,
                'taskId' => $task->id,
            ])
            ->with(
                'success',
                'Submission approved successfully.'
            );
    }


    public function rejectSubmission(
        Request $request,
        $classId,
        $projectId,
        $taskId,
        $submissionId
    ) {

        $student = Auth::user();

        $request->validate([
            'feedback' => 'required|string|max:10000',
        ]);

        $class = ClassRoom::where('id', $classId)
            ->whereHas('students', function ($query) use ($student) {
                $query->where('users.id', $student->id);
            })
            ->firstOrFail();

        $group = Group::where('class_room_id', $class->id)
            ->whereHas('students', function ($query) use ($student) {
                $query->where('users.id', $student->id);
            })
            ->firstOrFail();

        $isLeader = $group->students()
            ->where('users.id', $student->id)
            ->wherePivot('is_leader', true)
            ->exists();

        abort_unless(
            $isLeader,
            403,
            'Only the group leader can reject submissions.'
        );

        $project = Project::where('id', $projectId)
            ->where('class_room_id', $class->id)
            ->whereHas('groups', function ($query) use ($group) {
                $query->where('groups.id', $group->id);
            })
            ->firstOrFail();

        $task = Task::where('id', $taskId)
            ->where('project_id', $project->id)
            ->where('group_id', $group->id)
            ->firstOrFail();

        $submission = TaskSubmission::where('id', $submissionId)
            ->where('task_id', $task->id)
            ->where('status', 'Pending')
            ->firstOrFail();

        $submission->update([
            'status' => 'Rejected',
            'feedback' => $request->feedback,
        ]);

        TaskAssignment::where('task_id', $task->id)
            ->where('student_id', $submission->student_id)
            ->update([
                'status' => 'In Progress',
            ]);

        // 🔔 NOTIFY THE STUDENT
        Notification::create([
            'user_id' => $submission->student_id,
            'type' => 'task_rejected',
            'title' => 'Task Submission Rejected',
            'message' => 'Your submission for "' . $task->title . '" was rejected. Please review the feedback and resubmit.',
            'task_id' => $task->id,
            'submission_id' => $submission->id,
            'is_read' => false,
        ]);

        return redirect()
            ->route('student.tasks.review', [
                'classId' => $class->id,
                'projectId' => $project->id,
                'taskId' => $task->id,
            ])
            ->with(
                'success',
                'Submission rejected. The student can revise and submit again.'
            );
    }
}
