<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstructorClassController extends Controller
{
    //
    public function show($classId) {
        $class = ClassRoom::where('id', $classId)
        -> where('Instructor_Id', Auth::id())
        -> with('students')
        -> firstOrFail();

        return view('instructor.course-detail', compact('class'));
    }

    public function importRoster(Request $request, $classId) {
        
        $class = ClassRoom::where('id', $classId)
        -> where('Instructor_Id', Auth::id())
        -> firstOrFail();

        $request -> validate([
            'roster' => 'required|file|mimes:csv,txt|max:2048'
        ]);

        $file = $request -> file('roster');

        $handle = fopen($file -> getRealPath(), 'r');

        if (!$handle) {
            return back() -> with(
                'error',
                'Unable to read the CSV file.'
            );
        }

        $header = fgetcsv($handle);

        if (!$header) {
            fclose($handle);

            return back() -> with(
                'error',
                'The CSV file is empty.'
            );
        }

        $header = array_map(function ($value) {
            return trim(
                str_replace("\xEF\xBB\xBF", '', $value)
            );
        }, $header);

        $requiredColumns = [
            'student_id',
            'name',
            'email',
        ];

        foreach ($requiredColumns as $column) {
            if (!in_array($column, $header)) {

                fclose($handle);

                return back() -> with(
                    'error',
                    "Missing required column: {$column}"
                );
            }
        }

        $imported = 0;
        $skipped = 0;

        while (($row = fgetcsv($handle)) !== false) {
            if (count(array_filter($row)) === 0) {
                continue;
            }

            if (count($row) !== count($header)) {
                $skipped++;
                continue;
            }

            $data = array_combine($header, $row);

            if (!$data) {
                $skipped++;
                continue;
            }

            $studentId = trim(
                $data['student_id'] ?? ''
            );

            $email = trim(
                $data['email'] ?? ''
            );

            if (!$studentId || !$email) {
                $skipped++;
                continue;
            }

            $student = User::where (
                'student_id',
                $studentId
            )
            ->where(
                'role',
                'Student'
            )
            ->first();

            if (!$student) {
                $skipped++;
                continue;
            }

            $class -> students() -> syncWithoutDetaching([
                $student -> id
            ]);

            $imported++;
        }

        fclose($handle);

        return back() -> with(
            'success',
            "{$imported} students(s) imported successfully. "
            . "{$skipped} row(s) skipped."
        );

    }
}
