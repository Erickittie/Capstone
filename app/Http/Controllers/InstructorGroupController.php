<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InstructorGroupController extends Controller
{
    //
    public function index($classId) {
        $class = ClassRoom::where('id', $classId)
        -> where('Instructor_Id', Auth::id())
        -> with([
            'students',
            'groups.students'
        ])
        -> firstOrFail();

        return view(
            'instructor.groups',
            compact('class')
        );
    }

    public function saveManual(Request $request, $classId) {
        $class = ClassRoom::where('id', $classId)
        -> where('Instructor_Id', Auth::id())
        -> firstOrFail();

        $request -> validate([
            'groups' => 'required|array|min:1',
            'groups.*.name' => 'required|string|max:255',
            'groups.*.students' => 'nullable|array',
            'groups.*.students' => 'integer|exists:users,id',
        ]);

        DB::transaction(function () use ($request, $class) {
            $class -> groups() -> delete();

            foreach ($request -> groups as $index => $groupData) {

                $group = $class -> groups() -> create([
                    'name' => $groupData['name'],
                    'group_number' => $index + 1,
                ]);

            if (!empty($groupData['students'])) {
                $students = [];

                foreach ($groupData['students'] as $studentId) {
                    $students[] = [
                        'students_id' => $studentId,
                        'is_leader' => false,
                    ];
                }

                $group -> students() ->attach(
                    collect($students)
                    -> mapWithKeys(function ($student) {
                        return [
                            $student['student_id'] => [
                                'is_leader' => $student['is_leader']
                            ]
                        ];
                    })
                    -> toArray()
                );
            }    
            }
        });

        return back() ->with(
            'success',
            'Groups saved successfully.'
        );
    }

    public function automatic(Request $request, $classId)
{
    $class = ClassRoom::where('id', $classId)
        ->where('Instructor_Id', Auth::id())
        ->with('students')
        ->firstOrFail();

    $request->validate([
        'number_of_groups' => [
            'required',
            'integer',
            'min:1',
            'max:' . max(1, $class->students->count()),
        ],
    ]);

    $students = $class->students
        ->shuffle()
        ->values();

    $numberOfGroups = (int) $request->number_of_groups;

    DB::transaction(function () use (
        $class,
        $students,
        $numberOfGroups
    ) {
    
        $class->groups()->delete();

        $groups = [];

        for ($i = 1; $i <= $numberOfGroups; $i++) {
            $groups[] = $class->groups()->create([
                'name' => 'Group ' . $i,
                'group_number' => $i,
            ]);
        }

        foreach ($students as $index => $student) {
            $groupIndex = $index % $numberOfGroups;

            $groups[$groupIndex]
                ->students()
                ->attach(
                    $student->id,
                    ['is_leader' => false]
                );
        }
    });

    return back()->with(
        'success',
        'Students were automatically grouped successfully.'
    );
}
}
