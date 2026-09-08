<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstructorTaskLedgerController extends Controller
{
    public function index(Request $request, $classId)
    {
        $class = ClassRoom::where('id', $classId)
            ->where('Instructor_Id', Auth::id())
            ->with('groups')
            ->firstOrFail();

        $tasks = Task::whereHas('project', function ($query) use ($class) {
                $query->where('class_room_id', $class->id);
            })
            ->with([
                'project',
                'group',
                'assignments.student',
                'submissions.student',
            ])
            ->latest()
            ->get();

        $rows = [];

        foreach ($tasks as $task) {

            /*
             * Each assigned student becomes one row
             * in the instructor task ledger.
             */
            foreach ($task->assignments as $assignment) {

                $submission = $task->submissions
                    ->where('student_id', $assignment->student_id)
                    ->sortByDesc(function ($submission) {
                        return $submission->submitted_at
                            ?? $submission->created_at;
                    })
                    ->first();

                $rows[] = [
                    'task_id' => $task->id,
                    'assignment_id' => $assignment->id,

                    'task_title' => $task->title,

                    'project_title' => $task->project->title
                        ?? 'No Project',

                    'group_name' => $task->group->name
                        ?? 'No Group',

                    'student_id' => $assignment->student_id,

                    'student_name' => $assignment->student->name
                        ?? 'Unknown Student',

                    'points' => $task->points,

                    'assignment_status' => $assignment->status,

                    'submission_status' => $submission->status
                        ?? 'Not Submitted',

                    'submitted_at' => $submission?->submitted_at,

                    'approved_at' => $submission?->approved_at,

                    'feedback' => $submission?->feedback,
                ];
            }
        }

        return view(
            'instructor.tasks.ledger',
            compact(
                'class',
                'rows'
            )
        );
    }

    public function data(Request $request, $classId)
    {
        $class = ClassRoom::where('id', $classId)
            ->where('Instructor_Id', Auth::id())
            ->firstOrFail();

        $tasks = Task::whereHas('project', function ($query) use ($class) {
                $query->where('class_room_id', $class->id);
            })
            ->with([
                'project',
                'group',
                'assignments.student',
                'submissions.student',
            ])
            ->latest()
            ->get();

        $rows = [];

        foreach ($tasks as $task) {

            foreach ($task->assignments as $assignment) {

                $submission = $task->submissions
                    ->where('student_id', $assignment->student_id)
                    ->sortByDesc(function ($submission) {
                        return $submission->submitted_at
                            ?? $submission->created_at;
                    })
                    ->first();

                $rows[] = [
                    'task_id' => $task->id,
                    'assignment_id' => $assignment->id,

                    'task_title' => $task->title,

                    'project_title' => $task->project->title
                        ?? 'No Project',

                    'group_name' => $task->group->name
                        ?? 'No Group',

                    'student_id' => $assignment->student_id,

                    'student_name' => $assignment->student->name
                        ?? 'Unknown Student',

                    'points' => $task->points,

                    'assignment_status' => $assignment->status,

                    'submission_status' => $submission->status
                        ?? 'Not Submitted',

                    'submitted_at' => $submission?->submitted_at,

                    'approved_at' => $submission?->approved_at,

                    'feedback' => $submission?->feedback,
                ];
            }
        }

        return response()->json([
            'rows' => $rows,
            'updated_at' => now()->format('Y-m-d H:i:s'),
        ]);
    }
}