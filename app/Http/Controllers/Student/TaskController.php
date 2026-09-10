<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use App\Models\Group;
use App\Models\Project;
use App\Models\Task;
use App\Models\TaskAssignment;
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

        return view(
            'student.project',
            compact(
                'student',
                'class',
                'group',
                'project',
                'isLeader'
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
                    'assignees' => 'You can only assign tasks to members of your group.'
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
}