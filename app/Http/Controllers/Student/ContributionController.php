<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use App\Models\Group;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class ContributionController extends Controller
{
    public function index($classId)
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
                'projects.tasks.assignments.student',
            ])
            ->firstOrFail();

        $tasks = Task::where('group_id', $group->id)
            ->with([
                'assignments.student',
            ])
            ->get();

        $members = $group->students->map(function ($member) use ($tasks) {

            $memberAssignments = $tasks
                ->flatMap(function ($task) {
                    return $task->assignments;
                })
                ->where('student_id', $member->id);

            $assignedTasks = $memberAssignments->count();

            $completedTasks = $memberAssignments
                ->where('status', 'Approved')
                ->count();

            $submittedTasks = $memberAssignments
                ->where('status', 'Submitted')
                ->count();

            $inProgressTasks = $memberAssignments
                ->where('status', 'In Progress')
                ->count();

            $progress = $assignedTasks > 0
                ? ($completedTasks / $assignedTasks) * 100
                : 0;

            $contributionPoints = 0;

            foreach ($tasks as $task) {

                $approvedAssignments = $task->assignments
                    ->where('status', 'Approved');

                if ($approvedAssignments->isEmpty()) {
                    continue;
                }

                $memberApproved = $approvedAssignments
                    ->where('student_id', $member->id)
                    ->first();

                if ($memberApproved) {

                    $approvedMemberCount = $approvedAssignments->count();

                    $contributionPoints +=
                        $task->points / $approvedMemberCount;
                }
            }

            return (object) [
                'id' => $member->id,
                'name' => $member->name,
                'is_leader' => (bool) $member->pivot->is_leader,

                'assigned_tasks' => $assignedTasks,
                'completed_tasks' => $completedTasks,
                'submitted_tasks' => $submittedTasks,
                'in_progress_tasks' => $inProgressTasks,

                'progress' => round($progress, 1),

                'contribution_points' => $contributionPoints,
            ];
        });

        $totalContributionPoints = $members->sum('contribution_points');

        $members = $members->map(function ($member) use ($totalContributionPoints) {

            $member->contribution_percentage =
                $totalContributionPoints > 0
                    ? round(
                        ($member->contribution_points / $totalContributionPoints) * 100,
                        1
                    )
                    : 0;

            return $member;
        });

        $totalAssignedTasks = $tasks
            ->flatMap(function ($task) {
                return $task->assignments;
            })
            ->count();

        $totalCompletedTasks = $tasks
            ->flatMap(function ($task) {
                return $task->assignments;
            })
            ->where('status', 'Approved')
            ->count();

        $groupProgress = $totalAssignedTasks > 0
            ? round(
                ($totalCompletedTasks / $totalAssignedTasks) * 100,
                1
            )
            : 0;

        return view('student.contribution', [
            'class' => $class,
            'group' => $group,
            'tasks' => $tasks,
            'members' => $members,
            'totalContributionPoints' => $totalContributionPoints,
            'groupProgress' => $groupProgress,
        ]);
    }
}