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

        return view(
            'instructor.projects.index',
            compact('class', 'projects')
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

        $request->validate([
            'title' => ['required', 'string', 'max:255'],

            'description' => [
                'nullable',
                'string'
            ],

            'start_date' => [
                'nullable',
                'date'
            ],

            'end_date' => [
                'nullable',
                'date',
                'after_or_equal:start_date'
            ],

            'status' => [
                'required',
                'string',
                'max:50'
            ],

            'groups' => [
                'required',
                'array',
                'min:1'
            ],

            'groups.*' => [
                'integer',
                'exists:groups,id'
            ],
        ]);

        $validGroupIds = $class->groups()
            ->whereIn('groups.id', $request->groups)
            ->pluck('groups.id')
            ->toArray();


        if (count($validGroupIds) !== count($request->groups)) {

            return back()
                ->withInput()
                ->withErrors([
                    'groups' =>
                        'One or more selected groups do not belong to this class.'
                ]);
        }

        $project = Project::create([
            'class_room_id' => $class->id,
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
        ]);

        $project->groups()->sync($validGroupIds);

        return redirect()
            ->route(
                'instructor.projects.index',
                $class->id
            )
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

        $request->validate([
            'title' => ['required', 'string', 'max:255'],

            'description' => [
                'nullable',
                'string'
            ],

            'start_date' => [
                'nullable',
                'date'
            ],

            'end_date' => [
                'nullable',
                'date',
                'after_or_equal:start_date'
            ],

            'status' => [
                'required',
                'string',
                'max:50'
            ],

            'groups' => [
                'required',
                'array',
                'min:1'
            ],

            'groups.*' => [
                'integer',
                'exists:groups,id'
            ],
        ]);

        $validGroupIds = $class->groups()
            ->whereIn('groups.id', $request->groups)
            ->pluck('groups.id')
            ->toArray();

        if (count($validGroupIds) !== count($request->groups)) {

            return back()
                ->withInput()
                ->withErrors([
                    'groups' =>
                        'One or more selected groups do not belong to this class.'
                ]);
        }

        $project->update([
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
        ]);

        $project->groups()->sync($validGroupIds);

        return redirect()
            ->route(
                'instructor.projects.index',
                $class->id
            )
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
            ->route(
                'instructor.projects.index',
                $class->id
            )
            ->with(
                'success',
                'Project deleted successfully.'
            );
    }
}