<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use App\Models\Group;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class MyContributionController extends Controller
{

    public function index()
    {
        $studentId = Auth::id();

        $classes = ClassRoom::whereHas('students', function ($query) use ($studentId) {
            $query->where('users.id', $studentId);
        })
        ->with([
            'groups.students',
        ])
        ->get();

        $contributions = $classes->map(function ($class) use ($studentId) {

            $group = Group::where('class_room_id', $class->id)
                ->whereHas('students', function ($query) use ($studentId) {
                    $query->where('users.id', $studentId);
                })
                ->first();

            if (!$group) {
                return (object) [
                    'class' => $class,
                    'group' => null,
                    'assigned_tasks' => 0,
                    'completed_tasks' => 0,
                    'submitted_tasks' => 0,
                    'pending_tasks' => 0,
                    'progress_percentage' => 0,
                    'my_points' => 0,
                    'group_points' => 0,
                    'contribution_percentage' => 0,
                ];
            }

            $tasks = Task::where('group_id', $group->id)
                ->with([
                    'assignments.student',
                ])
                ->get();

            $myAssignments = $tasks
                ->flatMap(function ($task) {
                    return $task->assignments;
                })
                ->where('student_id', $studentId);

            $assignedTasks = $myAssignments->count();

            $completedTasks = $myAssignments
                ->where('status', 'Approved')
                ->count();

            $submittedTasks = $myAssignments
                ->where('status', 'Submitted')
                ->count();

            $pendingTasks = $myAssignments
                ->whereNotIn('status', [
                    'Approved',
                    'Submitted',
                    'In Progress',
                ])
                ->count();

            $progressPercentage = $assignedTasks > 0
                ? round(
                    ($completedTasks / $assignedTasks) * 100,
                    1
                )
                : 0;

            $myPoints = 0;

            foreach ($tasks as $task) {

                $approvedAssignments = $task->assignments
                    ->where('status', 'Approved');

                if ($approvedAssignments->isEmpty()) {
                    continue;
                }

                $myApprovedAssignment = $approvedAssignments
                    ->where('student_id', $studentId)
                    ->first();

                if ($myApprovedAssignment) {

                    $approvedMemberCount = $approvedAssignments->count();

                    $myPoints +=
                        $task->points / $approvedMemberCount;
                }
            }

            $groupPoints = 0;

            foreach ($tasks as $task) {

                $approvedAssignments = $task->assignments
                    ->where('status', 'Approved');

                if ($approvedAssignments->isEmpty()) {
                    continue;
                }

                $groupPoints += $task->points;
            }

            $contributionPercentage = $groupPoints > 0
                ? round(
                    ($myPoints / $groupPoints) * 100,
                    1
                )
                : 0;

            return (object) [
                'class' => $class,
                'group' => $group,

                'assigned_tasks' => $assignedTasks,
                'completed_tasks' => $completedTasks,
                'submitted_tasks' => $submittedTasks,
                'pending_tasks' => $pendingTasks,

                'progress_percentage' => $progressPercentage,

                'my_points' => round($myPoints, 1),
                'group_points' => round($groupPoints, 1),

                'contribution_percentage' => $contributionPercentage,
            ];
        });

        return view(
            'student.my-contributions',
            compact('contributions')
        );
    }

    public function classContribution($classId)
    {
        $studentId = Auth::id();

        $class = ClassRoom::where('id', $classId)
            ->whereHas('students', function ($query) use ($studentId) {
                $query->where('users.id', $studentId);
            })
            ->firstOrFail();

        $group = Group::where('class_room_id', $class->id)
            ->whereHas('students', function ($query) use ($studentId) {
                $query->where('users.id', $studentId);
            })
            ->with([
                'students',
            ])
            ->first();

        if (!$group) {
            return view('student.my-contribution', [
                'class' => $class,
                'group' => null,
                'assignedTasks' => 0,
                'completedTasks' => 0,
                'submittedTasks' => 0,
                'pendingTasks' => 0,
                'myPoints' => 0,
                'groupPoints' => 0,
                'contributionPercentage' => 0,
                'progressPercentage' => 0,
            ]);
        }

        $tasks = Task::where('group_id', $group->id)
            ->with([
                'assignments.student',
            ])
            ->get();

        $myAssignments = $tasks
            ->flatMap(function ($task) {
                return $task->assignments;
            })
            ->where('student_id', $studentId);

        $assignedTasks = $myAssignments->count();

        $completedTasks = $myAssignments
            ->where('status', 'Approved')
            ->count();

        $submittedTasks = $myAssignments
            ->where('status', 'Submitted')
            ->count();

        $inProgressTasks = $myAssignments
            ->where('status', 'In Progress')
            ->count();

        $pendingTasks = $myAssignments
            ->whereNotIn('status', [
                'Approved',
                'Submitted',
                'In Progress',
            ])
            ->count();

        $progressPercentage = $assignedTasks > 0
            ? round(
                ($completedTasks / $assignedTasks) * 100,
                1
            )
            : 0;

        $myPoints = 0;

        foreach ($tasks as $task) {

            $approvedAssignments = $task->assignments
                ->where('status', 'Approved');

            if ($approvedAssignments->isEmpty()) {
                continue;
            }

            $myApprovedAssignment = $approvedAssignments
                ->where('student_id', $studentId)
                ->first();

            if ($myApprovedAssignment) {

                $approvedMemberCount = $approvedAssignments->count();

                $myPoints +=
                    $task->points / $approvedMemberCount;
            }
        }

        $groupPoints = 0;

        foreach ($tasks as $task) {

            $approvedAssignments = $task->assignments
                ->where('status', 'Approved');

            if ($approvedAssignments->isEmpty()) {
                continue;
            }

            $groupPoints += $task->points;
        }

        $contributionPercentage = $groupPoints > 0
            ? round(
                ($myPoints / $groupPoints) * 100,
                1
            )
            : 0;

        return view('student.my-contribution', [
            'class' => $class,
            'group' => $group,

            'assignedTasks' => $assignedTasks,
            'completedTasks' => $completedTasks,
            'submittedTasks' => $submittedTasks,
            'pendingTasks' => $pendingTasks,

            'myPoints' => $myPoints,
            'groupPoints' => $groupPoints,

            'contributionPercentage' => $contributionPercentage,
            'progressPercentage' => $progressPercentage,
        ]);
    }
}