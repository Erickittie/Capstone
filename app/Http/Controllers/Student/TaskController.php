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
    /*
    |--------------------------------------------------------------------------
    | PROJECT TASKS
    |--------------------------------------------------------------------------
    */

    public function project($classId, $projectId)
    {
        $student = Auth::user();

        // Make sure student belongs to the class
        $class = ClassRoom::where('id', $classId)
            ->whereHas('students', function ($query) use ($student) {
                $query->where('users.id', $student->id);
            })
            ->firstOrFail();

        // Get student's group
        $group = Group::where('class_room_id', $class->id)
            ->whereHas('students', function ($query) use ($student) {
                $query->where('users.id', $student->id);
            })
            ->with('students')
            ->firstOrFail();

        // Make sure project belongs to the class and group
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

        // Get student's membership information
        $membership = $group->students()
            ->where('users.id', $student->id)
            ->first();

        $isLeader = $membership && $membership->pivot->is_leader;

        // Get tasks assigned to current student
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


    /*
    |--------------------------------------------------------------------------
    | SHOW TASK
    |--------------------------------------------------------------------------
    */

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


    /*
    |--------------------------------------------------------------------------
    | DOWNLOAD TASK ATTACHMENT
    |--------------------------------------------------------------------------
    */

    public function download($classId, $projectId, $taskId)
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

        $task = Task::where('id', $taskId)
            ->where('project_id', $project->id)
            ->where('group_id', $group->id)
            ->whereHas('assignments', function ($query) use ($student) {
                $query->where('student_id', $student->id);
            })
            ->firstOrFail();

        if (!$task->file_path) {
            abort(404, 'This task has no attachment.');
        }

        $path = storage_path('app/public/' . $task->file_path);

        if (!file_exists($path)) {
            abort(404, 'Task attachment not found.');
        }

        return response()->download($path);
    }


    /*
    |--------------------------------------------------------------------------
    | CREATE TASK
    |--------------------------------------------------------------------------
    */

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
            abort(
                403,
                'Only the Group Leader / PM can create tasks.'
            );
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


    /*
    |--------------------------------------------------------------------------
    | STORE / CREATE TASK
    |--------------------------------------------------------------------------
    */

    public function store(Request $request, $classId, $projectId)
    {
        $student = Auth::user();

        $request->validate([
            'title' => [
                'required',
                'string',
                'max:255'
            ],

            'description' => [
                'nullable',
                'string'
            ],

            'points' => [
                'required',
                'integer',
                'min:1'
            ],

            'due_date' => [
                'nullable',
                'date'
            ],

            'file' => [
                'nullable',
                'file',
                'max:10240',
                'mimes:pdf,doc,docx,txt,zip,jpg,jpeg,png',
            ],

            'assignees' => [
                'required',
                'array',
                'min:1'
            ],

            'assignees.*' => [
                'integer'
            ],
        ]);

        // Make sure student belongs to class
        $class = ClassRoom::where('id', $classId)
            ->whereHas('students', function ($query) use ($student) {
                $query->where('users.id', $student->id);
            })
            ->firstOrFail();

        // Get student's group
        $group = Group::where('class_room_id', $class->id)
            ->whereHas('students', function ($query) use ($student) {
                $query->where('users.id', $student->id);
            })
            ->with('students')
            ->firstOrFail();

        // Check if current student is leader
        $membership = $group->students()
            ->where('users.id', $student->id)
            ->first();

        if (!$membership || !$membership->pivot->is_leader) {
            abort(
                403,
                'Only the Group Leader / PM can create tasks.'
            );
        }

        // Make sure project belongs to group
        $project = Project::where('id', $projectId)
            ->where('class_room_id', $class->id)
            ->whereHas('groups', function ($query) use ($group) {
                $query->where('groups.id', $group->id);
            })
            ->firstOrFail();

        // Get group member IDs
        $memberIds = $group->students
            ->pluck('id')
            ->toArray();

        // Make sure selected assignees belong to this group
        $invalidAssignees = array_diff(
            $request->assignees,
            $memberIds
        );

        if (!empty($invalidAssignees)) {
            return back()
                ->withInput()
                ->withErrors([
                    'assignees' =>
                        'You can only assign tasks to members of your group.',
                ]);
        }

        DB::transaction(function () use (
            $request,
            $project,
            $group
        ) {

            /*
            |--------------------------------------------------------------------------
            | STORE ATTACHMENT
            |--------------------------------------------------------------------------
            */

            $filePath = null;

            if ($request->hasFile('file')) {

                $filePath = $request
                    ->file('file')
                    ->store('tasks', 'public');
            }


            /*
            |--------------------------------------------------------------------------
            | CREATE TASK
            |--------------------------------------------------------------------------
            */

            $task = Task::create([
                'project_id' => $project->id,
                'group_id' => $group->id,
                'title' => $request->title,
                'description' => $request->description,
                'points' => $request->points,
                'due_date' => $request->due_date,
                'file_path' => $filePath,
                'status' => 'Pending',
            ]);


            /*
            |--------------------------------------------------------------------------
            | ASSIGN TASK + NOTIFY STUDENT
            |--------------------------------------------------------------------------
            */

            foreach ($request->assignees as $studentId) {

                TaskAssignment::create([
                    'task_id' => $task->id,
                    'student_id' => $studentId,
                    'status' => 'Assigned',
                ]);


                // 🔔 NOTIFICATION:
                // Student has been assigned a new task.

                Notification::create([
                    'user_id' => $studentId,
                    'type' => 'task_assigned',
                    'title' => 'New Task Assigned',
                    'message' =>
                        'You have been assigned a new task: "' .
                        $task->title .
                        '".',
                    'task_id' => $task->id,
                    'submission_id' => null,
                    'is_read' => false,
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


    /*
    |--------------------------------------------------------------------------
    | START TASK
    |--------------------------------------------------------------------------
    */

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

        return redirect()
            ->route('student.tasks.show', [
                'classId' => $class->id,
                'projectId' => $project->id,
                'taskId' => $taskId,
            ])
            ->with(
                'success',
                'Task started successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | SUBMIT TASK
    |--------------------------------------------------------------------------
    */

    public function submit(
        Request $request,
        $classId,
        $projectId,
        $taskId
    ) {
        $student = Auth::user();

        $request->validate([
            'submission_text' => [
                'nullable',
                'string',
                'max:10000'
            ],

            'file' => [
                'nullable',
                'file',
                'max:10240',
                'mimes:pdf,doc,docx,txt,zip,jpg,jpeg,png',
            ],
        ]);

        // Check class
        $class = ClassRoom::where('id', $classId)
            ->whereHas('students', function ($query) use ($student) {
                $query->where('users.id', $student->id);
            })
            ->firstOrFail();

        // Check group
        $group = Group::where('class_room_id', $class->id)
            ->whereHas('students', function ($query) use ($student) {
                $query->where('users.id', $student->id);
            })
            ->firstOrFail();

        // Check project
        $project = Project::where('id', $projectId)
            ->where('class_room_id', $class->id)
            ->whereHas('groups', function ($query) use ($group) {
                $query->where('groups.id', $group->id);
            })
            ->firstOrFail();

        // Check assignment
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

        // Student must submit either text or file
        if (
            !$request->filled('submission_text')
            &&
            !$request->hasFile('file')
        ) {

            return back()
                ->withErrors([
                    'submission' =>
                        'Please provide a description or upload a file.',
                ])
                ->withInput();
        }


        /*
        |--------------------------------------------------------------------------
        | STORE SUBMISSION FILE
        |--------------------------------------------------------------------------
        */

        $filePath = null;

        if ($request->hasFile('file')) {

            $filePath = $request
                ->file('file')
                ->store('submissions', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | GET TASK
        |--------------------------------------------------------------------------
        */

        $task = Task::findOrFail($taskId);


        /*
        |--------------------------------------------------------------------------
        | CREATE SUBMISSION
        |--------------------------------------------------------------------------
        */

        $submission = TaskSubmission::create([
            'task_id' => $taskId,
            'student_id' => $student->id,
            'submission_text' => $request->submission_text,
            'file_path' => $filePath,
            'status' => 'Pending',
            'submitted_at' => now(),
        ]);


        /*
        |--------------------------------------------------------------------------
        | UPDATE ASSIGNMENT
        |--------------------------------------------------------------------------
        |
        | Important:
        | completed_at is NOT set here.
        |
        | The task is only completed after the PM approves it.
        |
        */

        $assignment->update([
            'status' => 'Submitted',
        ]);


        /*
        |--------------------------------------------------------------------------
        | 🔔 NOTIFY GROUP LEADER
        |--------------------------------------------------------------------------
        */

        $leader = $group->students()
            ->wherePivot('is_leader', true)
            ->first();

        if ($leader) {

            Notification::create([
                'user_id' => $leader->id,
                'type' => 'task_submitted',
                'title' => 'Task Submitted for Review',
                'message' =>
                    $student->name .
                    ' submitted "' .
                    $task->title .
                    '" for your review.',
                'task_id' => $task->id,
                'submission_id' => $submission->id,
                'is_read' => false,
            ]);
        }


        return redirect()
            ->route('student.tasks.show', [
                'classId' => $class->id,
                'projectId' => $project->id,
                'taskId' => $taskId,
            ])
            ->with(
                'success',
                'Task submitted successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | REVIEW SUBMISSIONS
    |--------------------------------------------------------------------------
    */

    public function review(
        $classId,
        $projectId,
        $taskId
    ) {
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

        // Only leader can review
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


    /*
    |--------------------------------------------------------------------------
    | APPROVE SUBMISSION
    |--------------------------------------------------------------------------
    */

    public function approveSubmission(
        Request $request,
        $classId,
        $projectId,
        $taskId,
        $submissionId
    ) {
        $student = Auth::user();

        $request->validate([
            'feedback' => [
                'nullable',
                'string',
                'max:10000'
            ],
        ]);

        // Check class
        $class = ClassRoom::where('id', $classId)
            ->whereHas('students', function ($query) use ($student) {
                $query->where('users.id', $student->id);
            })
            ->firstOrFail();

        // Check group
        $group = Group::where('class_room_id', $class->id)
            ->whereHas('students', function ($query) use ($student) {
                $query->where('users.id', $student->id);
            })
            ->firstOrFail();

        // Check leader
        $isLeader = $group->students()
            ->where('users.id', $student->id)
            ->wherePivot('is_leader', true)
            ->exists();

        abort_unless(
            $isLeader,
            403,
            'Only the group leader can approve submissions.'
        );

        // Check project
        $project = Project::where('id', $projectId)
            ->where('class_room_id', $class->id)
            ->whereHas('groups', function ($query) use ($group) {
                $query->where('groups.id', $group->id);
            })
            ->firstOrFail();

        // Check task
        $task = Task::where('id', $taskId)
            ->where('project_id', $project->id)
            ->where('group_id', $group->id)
            ->firstOrFail();

        // Check submission
        $submission = TaskSubmission::where('id', $submissionId)
            ->where('task_id', $task->id)
            ->where('status', 'Pending')
            ->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | APPROVE
        |--------------------------------------------------------------------------
        */

        $submission->update([
            'status' => 'Approved',
            'approved_at' => now(),
            'approved_by' => $student->id,
            'feedback' => $request->feedback,
        ]);


        /*
        |--------------------------------------------------------------------------
        | COMPLETE ASSIGNMENT
        |--------------------------------------------------------------------------
        */

        TaskAssignment::where('task_id', $task->id)
            ->where('student_id', $submission->student_id)
            ->update([
                'status' => 'Approved',
                'completed_at' => now(),
            ]);


        /*
        |--------------------------------------------------------------------------
        | 🔔 NOTIFY STUDENT
        |--------------------------------------------------------------------------
        */

        Notification::create([
            'user_id' => $submission->student_id,
            'type' => 'task_approved',
            'title' => 'Task Approved',
            'message' =>
                'Your submission for "' .
                $task->title .
                '" has been approved by the Group Leader.',
            'task_id' => $task->id,
            'submission_id' => $submission->id,
            'is_read' => false,
        ]);


        return redirect()
            ->route('student.tasks.review', [
                'classId' => $classId,
                'projectId' => $projectId,
                'taskId' => $task->id,
            ])
            ->with(
                'success',
                'Submission approved successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | REJECT SUBMISSION
    |--------------------------------------------------------------------------
    */

    public function rejectSubmission(
        Request $request,
        $classId,
        $projectId,
        $taskId,
        $submissionId
    ) {
        $student = Auth::user();

        $request->validate([
            'feedback' => [
                'required',
                'string',
                'max:10000'
            ],
        ]);

        // Check class
        $class = ClassRoom::where('id', $classId)
            ->whereHas('students', function ($query) use ($student) {
                $query->where('users.id', $student->id);
            })
            ->firstOrFail();

        // Check group
        $group = Group::where('class_room_id', $class->id)
            ->whereHas('students', function ($query) use ($student) {
                $query->where('users.id', $student->id);
            })
            ->firstOrFail();

        // Check leader
        $isLeader = $group->students()
            ->where('users.id', $student->id)
            ->wherePivot('is_leader', true)
            ->exists();

        abort_unless(
            $isLeader,
            403,
            'Only the group leader can reject submissions.'
        );

        // Check project
        $project = Project::where('id', $projectId)
            ->where('class_room_id', $class->id)
            ->whereHas('groups', function ($query) use ($group) {
                $query->where('groups.id', $group->id);
            })
            ->firstOrFail();

        // Check task
        $task = Task::where('id', $taskId)
            ->where('project_id', $project->id)
            ->where('group_id', $group->id)
            ->firstOrFail();

        // Check submission
        $submission = TaskSubmission::where('id', $submissionId)
            ->where('task_id', $task->id)
            ->where('status', 'Pending')
            ->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | REJECT
        |--------------------------------------------------------------------------
        */

        $submission->update([
            'status' => 'Rejected',
            'feedback' => $request->feedback,
        ]);


        /*
        |--------------------------------------------------------------------------
        | PUT TASK BACK IN PROGRESS
        |--------------------------------------------------------------------------
        */

        TaskAssignment::where('task_id', $task->id)
            ->where('student_id', $submission->student_id)
            ->update([
                'status' => 'In Progress',
            ]);


        /*
        |--------------------------------------------------------------------------
        | 🔔 NOTIFY STUDENT
        |--------------------------------------------------------------------------
        */

        Notification::create([
            'user_id' => $submission->student_id,
            'type' => 'task_rejected',
            'title' => 'Task Submission Rejected',
            'message' =>
                'Your submission for "' .
                $task->title .
                '" was rejected. Please review the feedback and resubmit.',
            'task_id' => $task->id,
            'submission_id' => $submission->id,
            'is_read' => false,
        ]);


        return redirect()
            ->route('student.tasks.review', [
                'classId' => $classId,
                'projectId' => $projectId,
                'taskId' => $task->id,
            ])
            ->with(
                'success',
                'Submission rejected. The student can revise and submit again.'
            );
    }

    public function manager($classId)
    {
    $student = Auth::user();

    /*
    |--------------------------------------------------------------------------
    | Verify that the student belongs to this class
    |--------------------------------------------------------------------------
    */
    $class = ClassRoom::whereKey($classId)
        ->whereHas('students', function ($query) use ($student) {
            $query->where('users.id', $student->id);
        })
        ->firstOrFail();

    /*
    |--------------------------------------------------------------------------
    | Get the student's group in this class
    |--------------------------------------------------------------------------
    */
    $group = $student->groups()
        ->where('class_room_id', $classId)
        ->with('projects')
        ->first();

    /*
    |--------------------------------------------------------------------------
    | No group yet
    |--------------------------------------------------------------------------
    */
    if (!$group) {
        return view('student.task-manager', [
            'class' => $class,
            'group' => null,
            'projects' => collect(),
            'tasks' => collect(),
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Get projects assigned to the group
    |--------------------------------------------------------------------------
    */
    $projects = $group->projects()
        ->where('class_room_id', $classId)
        ->latest()
        ->get();

    /*
    |--------------------------------------------------------------------------
    | Get tasks assigned to the logged-in student
    |--------------------------------------------------------------------------
    |
    | We use task_assignments instead of simply getting every task
    | belonging to the group because the Task Manager should show
    | the student's assigned tasks.
    |
    */
    $tasks = Task::with([
        'project',
        'group',
        'assignments' => function ($query) use ($student) {
            $query->where('student_id', $student->id);
        },
        'submissions' => function ($query) use ($student) {
            $query->where('student_id', $student->id)
                ->latest();
        },
    ])
        ->where('group_id', $group->id)
        ->whereHas('assignments', function ($query) use ($student) {
            $query->where('student_id', $student->id);
        })
        ->latest()
        ->get();

    return view('student.task-manager', compact(
        'class',
        'group',
        'projects',
        'tasks'
    ));
    }
}