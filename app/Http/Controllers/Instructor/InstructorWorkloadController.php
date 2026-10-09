<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;

use App\Models\ClassRoom;
use App\Models\Project;
use App\Models\Task;
use App\Models\TaskSubmission;
use Illuminate\Support\Facades\Auth;

class InstructorWorkloadController extends Controller
{
    public function show($classId, $projectId)
    {
        // Verify that the logged-in instructor owns this class.
        $class = ClassRoom::where('id', $classId)
            ->where('Instructor_Id', Auth::id())
            ->firstOrFail();

        // Make sure the project belongs to this class.
        $project = Project::where('id', $projectId)
            ->where('class_room_id', $class->id)
            ->firstOrFail();

        $threshold = (float) ($project->contribution_threshold ?? 20);

        // Get the groups assigned to this project and their members.
        $groups = $project->groups()
            ->with('students')
            ->get();

        $reports = [];

        foreach ($groups as $group) {
            $memberIds = $group->students->pluck('id');

            // Only count tasks belonging to this project and group.
            $tasks = Task::where('project_id', $project->id)
                ->where('group_id', $group->id)
                ->get(['id', 'points']);

            $taskIds = $tasks->pluck('id');
            $taskPoints = $tasks->pluck('points', 'id');

            // Start every member at zero approved points.
            $pointsByStudent = $memberIds
                ->mapWithKeys(fn ($id) => [$id => 0])
                ->all();

            // Get submissions from members of this group.
            // The latest submission for each student/task pair is used,
            // so an older approval isn't counted if the latest submission
            // was rejected.
            $latestSubmissions = TaskSubmission::whereIn('task_id', $taskIds)
                ->whereIn('student_id', $memberIds)
                ->orderBy('id')
                ->get()
                ->groupBy(fn ($submission) =>
                    $submission->task_id . '-' . $submission->student_id
                )
                ->map(fn ($submissions) => $submissions->last())
                ->filter(fn ($submission) =>
                    strtolower($submission->status) === 'approved'
                );

            // Award points only for the latest approved submission
            // of each task by each group member.
            foreach ($latestSubmissions as $submission) {
                if (
                    array_key_exists($submission->student_id, $pointsByStudent)
                    && $taskPoints->has($submission->task_id)
                ) {
                    $pointsByStudent[$submission->student_id] +=
                        (int) $taskPoints->get($submission->task_id);
                }
            }

            $totalApprovedPoints = array_sum($pointsByStudent);

            $members = $group->students->map(function ($student) use (
                $pointsByStudent,
                $totalApprovedPoints,
                $threshold
            ) {
                $points = $pointsByStudent[$student->id] ?? 0;

                $contribution = $totalApprovedPoints > 0
                    ? round(($points / $totalApprovedPoints) * 100, 2)
                    : null;

                return [
                    'student' => $student,
                    'approved_points' => $points,
                    'contribution' => $contribution,
                    'is_below_threshold' => $contribution !== null
                        && $contribution < $threshold,
                ];
            });

            $reports[] = [
                'group' => $group,
                'members' => $members,
                'total_approved_points' => $totalApprovedPoints,
                'approved_submission_count' => $latestSubmissions->count(),
                'has_enough_work' => $totalApprovedPoints > 0,
                'flagged_count' => $members
                    ->where('is_below_threshold', true)
                    ->count(),
            ];
        }

        return view(
            'instructor.projects.workload',
            compact('class', 'project', 'reports', 'threshold')
        );
    }
}