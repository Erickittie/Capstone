<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function index($classId)
    {
        $class = ClassRoom::where('id', $classId)
            ->where('Instructor_Id', Auth::id())
            ->firstOrFail();

        $projects = Project::where('class_room_id', $class->id)
            ->with([
                'tasks.group',
                'tasks.assignments.student',
                'tasks.submissions.student',
            ])
            ->latest()
            ->get();

        return view(
            'instructor.tasks.index',
            compact('class', 'projects')
        );
    }

    public function create($classId)
    {
        $class = ClassRoom::where('id', $classId)
            ->where('Instructor_Id', Auth::id())
            ->with([
                'groups.students'
            ])
            ->firstOrFail();

        $projects = Project::where('class_room_id', $class->id)
            ->latest()
            ->get();

        return view(
            'instructor.tasks.create',
            compact('class', 'projects')
        );
    }

    public function store(Request $request, $classId)
    {
        $class = ClassRoom::where('id', $classId)
            ->where('Instructor_Id', Auth::id())
            ->with('groups.students')
            ->firstOrFail();

        $request->validate([
            'project_id' => [
                'required',
                'integer',
                'exists:projects,id',
            ],

            'group_id' => [
                'nullable',
                'integer',
                'exists:groups,id',
            ],

            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'points' => [
                'required',
                'integer',
                'min:0',
            ],

            'due_date' => [
                'nullable',
                'date',
            ],

            'student_ids' => [
                'nullable',
                'array',
            ],

            'student_ids.*' => [
                'integer',
                'exists:users,id',
            ],
        ]);

        $project = Project::where('id', $request->project_id)
            ->where('class_room_id', $class->id)
            ->firstOrFail();

        if ($request->filled('group_id')) {

            $groupBelongsToClass = $class->groups()
                ->where('id', $request->group_id)
                ->exists();

            if (!$groupBelongsToClass) {
                return back()
                    ->withInput()
                    ->with(
                        'error',
                        'The selected group does not belong to this class.'
                    );
            }
        }

        $enrolledStudentIds = $class->students
            ->pluck('id')
            ->map(fn ($id) => (int) $id)
            ->toArray();

        $studentIds = collect(
            $request->student_ids ?? []
        )
            ->map(fn ($id) => (int) $id)
            ->unique()
            ->values()
            ->toArray();


        foreach ($studentIds as $studentId) {

            if (!in_array(
                $studentId,
                $enrolledStudentIds,
                true
            )) {

                return back()
                    ->withInput()
                    ->with(
                        'error',
                        'One or more selected students are not enrolled in this class.'
                    );
            }
        }

        DB::transaction(function () use (
            $request,
            $project,
            $studentIds
        ) {

            $task = $project->tasks()->create([
                'group_id' => $request->group_id,
                'title' => $request->title,
                'description' => $request->description,
                'points' => $request->points,
                'due_date' => $request->due_date,
                'status' => 'Pending',
            ]);


            foreach ($studentIds as $studentId) {

                $task->assignments()->create([
                    'student_id' => $studentId,
                    'status' => 'Assigned',
                ]);
            }
        });


        return redirect()
            ->route(
                'instructor.tasks.index',
                $class->id
            )
            ->with(
                'success',
                'Task created and assigned successfully.'
            );
    }

    public function edit($classId, $taskId)
    {
        $class = ClassRoom::where('id', $classId)
            ->where('Instructor_Id', Auth::id())
            ->with('groups.students')
            ->firstOrFail();

        $task = Task::where('id', $taskId)
            ->whereHas('project', function ($query) use ($class) {
                $query->where(
                    'class_room_id',
                    $class->id
                );
            })
            ->with([
                'project',
                'group',
                'assignments.student',
            ])
            ->firstOrFail();

        $projects = Project::where(
            'class_room_id',
            $class->id
        )
            ->latest()
            ->get();

        return view(
            'instructor.tasks.edit',
            compact(
                'class',
                'task',
                'projects'
            )
        );
    }

    public function update(
        Request $request,
        $classId,
        $taskId
    ) {

        $class = ClassRoom::where('id', $classId)
            ->where('Instructor_Id', Auth::id())
            ->firstOrFail();

        $task = Task::where('id', $taskId)
            ->whereHas('project', function ($query) use ($class) {
                $query->where(
                    'class_room_id',
                    $class->id
                );
            })
            ->firstOrFail();


        $request->validate([
            'project_id' => 'required|integer|exists:projects,id',

            'group_id' => 'nullable|integer|exists:groups,id',

            'title' => 'required|string|max:255',

            'description' => 'nullable|string',

            'points' => 'required|integer|min:0',

            'due_date' => 'nullable|date',

            'status' => 'required|string',
        ]);


        Project::where('id', $request->project_id)
            ->where('class_room_id', $class->id)
            ->firstOrFail();


        if ($request->filled('group_id')) {

            $class->groups()
                ->where('id', $request->group_id)
                ->firstOrFail();
        }


        $task->update([
            'project_id' => $request->project_id,
            'group_id' => $request->group_id,
            'title' => $request->title,
            'description' => $request->description,
            'points' => $request->points,
            'due_date' => $request->due_date,
            'status' => $request->status,
        ]);


        return redirect()
            ->route(
                'instructor.tasks.index',
                $class->id
            )
            ->with(
                'success',
                'Task updated successfully.'
            );
    }

    public function destroy($classId, $taskId)
    {
        $class = ClassRoom::where('id', $classId)
            ->where('Instructor_Id', Auth::id())
            ->firstOrFail();

        $task = Task::where('id', $taskId)
            ->whereHas('project', function ($query) use ($class) {
                $query->where(
                    'class_room_id',
                    $class->id
                );
            })
            ->firstOrFail();


        $task->delete();


        return redirect()
            ->route(
                'instructor.tasks.index',
                $class->id
            )
            ->with(
                'success',
                'Task deleted successfully.'
            );
    }
}