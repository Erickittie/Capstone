<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstructorProjectController extends Controller
{
    public function index($classId)
    {
        $class = ClassRoom::where('id', $classId)
            ->where('Instructor_Id', Auth::id())
            ->firstOrFail();

        $projects = Project::where('class_room_id', $class->id)
            ->with('groups')
            ->latest()
            ->get();

        $groups = $class->groups()
            ->with('students')
            ->get();

        return view(
            'instructor.projects.index',
            compact('class', 'projects', 'groups')
        );
    }

    public function create($classId)
    {
        $class = ClassRoom::where('id', $classId)
            ->where('Instructor_Id', Auth::id())
            ->firstOrFail();

        $groups = $class->groups()
            ->with('students')
            ->get();

        return view(
            'instructor.projects.create',
            compact('class', 'groups')
        );
    }

    public function store(Request $request, $classId)
    {
        $class = ClassRoom::where('id', $classId)
            ->where('Instructor_Id', Auth::id())
            ->firstOrFail();

        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'contribution_threshold' => [
                'required',
                'numeric',
                'gt:0',
                'lte:100',
            ],

            'start_date' => [
                'nullable',
                'date',
            ],

            'end_date' => [
                'nullable',
                'date',
                'after_or_equal:start_date',
            ],

            'status' => [
                'required',
                'string',
                'max:50',
            ],

            'groups' => [
                'required',
                'array',
                'min:1',
            ],

            'groups.*' => [
                'integer',
                'distinct',
                'exists:groups,id',
            ],
        ]);

        $validGroupIds = $class->groups()
            ->whereIn('groups.id', $validated['groups'])
            ->pluck('groups.id')
            ->toArray();

        if (count($validGroupIds) !== count($validated['groups'])) {
            return back()
                ->withInput()
                ->withErrors([
                    'groups' =>
                        'One or more selected groups do not belong to this class.',
                ]);
        }

        $project = Project::create([
            'class_room_id' => $class->id,
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'contribution_threshold' => $validated['contribution_threshold'],
            'start_date' => $validated['start_date'] ?? null,
            'end_date' => $validated['end_date'] ?? null,
            'status' => $validated['status'],
        ]);

        // Preserve the selected group assignments.
        $project->groups()->sync($validGroupIds);

        return redirect()
            ->route('instructor.projects.index', $class->id)
            ->with(
                'success',
                'Project created and assigned to the selected groups successfully.'
            );
    }

    public function edit($classId, $projectId)
    {
        $class = ClassRoom::where('id', $classId)
            ->where('Instructor_Id', Auth::id())
            ->firstOrFail();

        $project = Project::where('id', $projectId)
            ->where('class_room_id', $class->id)
            ->with('groups')
            ->firstOrFail();

        $groups = $class->groups()
            ->with('students')
            ->get();

        return view(
            'instructor.projects.edit',
            compact('class', 'project', 'groups')
        );
    }

    public function update(
        Request $request,
        $classId,
        $projectId
    ) {
        $class = ClassRoom::where('id', $classId)
            ->where('Instructor_Id', Auth::id())
            ->firstOrFail();

        $project = Project::where('id', $projectId)
            ->where('class_room_id', $class->id)
            ->firstOrFail();

        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'contribution_threshold' => [
                'required',
                'numeric',
                'gt:0',
                'lte:100',
            ],

            'start_date' => [
                'nullable',
                'date',
            ],

            'end_date' => [
                'nullable',
                'date',
                'after_or_equal:start_date',
            ],

            'status' => [
                'required',
                'string',
                'max:50',
            ],

            'groups' => [
                'required',
                'array',
                'min:1',
            ],

            'groups.*' => [
                'integer',
                'distinct',
                'exists:groups,id',
            ],
        ]);

        $validGroupIds = $class->groups()
            ->whereIn('groups.id', $validated['groups'])
            ->pluck('groups.id')
            ->toArray();

        if (count($validGroupIds) !== count($validated['groups'])) {
            return back()
                ->withInput()
                ->withErrors([
                    'groups' =>
                        'One or more selected groups do not belong to this class.',
                ]);
        }

        $project->update([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'contribution_threshold' => $validated['contribution_threshold'],
            'start_date' => $validated['start_date'] ?? null,
            'end_date' => $validated['end_date'] ?? null,
            'status' => $validated['status'],
        ]);

        // Preserve the selected group assignments.
        $project->groups()->sync($validGroupIds);

        return redirect()
            ->route('instructor.projects.index', $class->id)
            ->with(
                'success',
                'Project updated successfully.'
            );
    }

    public function destroy($classId, $projectId)
    {
        $class = ClassRoom::where('id', $classId)
            ->where('Instructor_Id', Auth::id())
            ->firstOrFail();

        $project = Project::where('id', $projectId)
            ->where('class_room_id', $class->id)
            ->firstOrFail();

        $project->delete();

        return redirect()
            ->route('instructor.projects.index', $class->id)
            ->with(
                'success',
                'Project deleted successfully.'
            );
    }
}