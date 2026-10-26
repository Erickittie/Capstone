<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shared\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class BulkUserRegistrationController extends Controller
{
    public function index()
    {
        return view('admin.users.bulk-register');
    }

    public function template()
    {
        $filename = 'carryon_users_template.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $columns = [
            'student_id',
            'instructor_id',
            'name',
            'email',
            'role',
            'department',
        ];

        $callback = function () use ($columns) {
            $file = fopen('php://output', 'w');

            fputcsv($file, $columns);

            fputcsv($file, [
                '2022008683',
                '',
                'Sample Student',
                'student@example.com',
                'Student',
                'SCS',
            ]);

            fputcsv($file, [
                '',
                'INS-0001',
                'Sample Instructor',
                'instructor@example.com',
                'Instructor',
                'SCS',
            ]);

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function import(Request $request)
    {
        $request->validate([
            'csv_file' => [
                'required',
                'file',
                'mimes:csv,txt',
                'max:5120',
            ],
        ]);

        $file = $request->file('csv_file');
        $handle = fopen($file->getRealPath(), 'r');

        if (!$handle) {
            return back()->with('error', 'Unable to open CSV file.');
        }

        $header = fgetcsv($handle);

        if (!$header) {
            fclose($handle);

            return back()->with('error', 'The CSV file is empty.');
        }

        $header = array_map(function ($column) {
            return strtolower(trim(preg_replace('/^\xEF\xBB\xBF/', '', $column)));
        }, $header);

        $requiredColumns = [
            'student_id',
            'instructor_id',
            'name',
            'email',
            'role',
            'department',
        ];

        foreach ($requiredColumns as $column) {
            if (!in_array($column, $header, true)) {
                fclose($handle);

                return back()->with(
                    'error',
                    "Missing required CSV column: {$column}"
                );
            }
        }

        $successCount = 0;
        $skippedCount = 0;
        $errors = [];
        $rowNumber = 1;

        while (($row = fgetcsv($handle)) !== false) {
            $rowNumber++;

            if (count(array_filter($row, function ($value) {
                return trim((string) $value) !== '';
            })) === 0) {
                continue;
            }

            $data = [];

            foreach ($header as $index => $column) {
                $data[$column] = isset($row[$index])
                    ? trim($row[$index])
                    : null;
            }

            $data['student_id'] = $data['student_id'] ?: null;
            $data['instructor_id'] = $data['instructor_id'] ?: null;
            $data['department'] = $data['department'] ?: null;

            $validator = Validator::make($data, [
                'student_id' => 'nullable|string|max:50',
                'instructor_id' => 'nullable|string|max:50',
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'role' => 'required|in:Student,Instructor',
                'department' => 'nullable|string|max:255',
            ]);

            if ($validator->fails()) {
                $errors[] = [
                    'row' => $rowNumber,
                    'name' => $data['name'] ?? '',
                    'email' => $data['email'] ?? '',
                    'errors' => $validator->errors()->all(),
                ];

                continue;
            }

            // Validate the ID that belongs to the selected role.
            if ($data['role'] === 'Student') {
                if (empty($data['student_id'])) {
                    $errors[] = [
                        'row' => $rowNumber,
                        'name' => $data['name'],
                        'email' => $data['email'],
                        'errors' => [
                            'Student ID is required for Student accounts.',
                        ],
                    ];

                    continue;
                }

                if (!empty($data['instructor_id'])) {
                    $errors[] = [
                        'row' => $rowNumber,
                        'name' => $data['name'],
                        'email' => $data['email'],
                        'errors' => [
                            'Leave instructor_id blank for Student accounts.',
                        ],
                    ];

                    continue;
                }

                if (User::where('student_id', $data['student_id'])->exists()) {
                    $skippedCount++;

                    $errors[] = [
                        'row' => $rowNumber,
                        'name' => $data['name'],
                        'email' => $data['email'],
                        'errors' => ['Student ID already exists.'],
                    ];

                    continue;
                }

                $defaultPassword = $data['student_id'];
            } else {
                if (empty($data['instructor_id'])) {
                    $errors[] = [
                        'row' => $rowNumber,
                        'name' => $data['name'],
                        'email' => $data['email'],
                        'errors' => [
                            'Instructor ID is required for Instructor accounts.',
                        ],
                    ];

                    continue;
                }

                if (!empty($data['student_id'])) {
                    $errors[] = [
                        'row' => $rowNumber,
                        'name' => $data['name'],
                        'email' => $data['email'],
                        'errors' => [
                            'Leave student_id blank for Instructor accounts.',
                        ],
                    ];

                    continue;
                }

                if (User::where('instructor_id', $data['instructor_id'])->exists()) {
                    $skippedCount++;

                    $errors[] = [
                        'row' => $rowNumber,
                        'name' => $data['name'],
                        'email' => $data['email'],
                        'errors' => ['Instructor ID already exists.'],
                    ];

                    continue;
                }

                $defaultPassword = 'CarryOn@123';
            }

            if (User::where('email', $data['email'])->exists()) {
                $skippedCount++;

                $errors[] = [
                    'row' => $rowNumber,
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'errors' => ['Email already exists.'],
                ];

                continue;
            }

            User::create([
                'student_id' => $data['role'] === 'Student'
                    ? $data['student_id']
                    : null,
                'instructor_id' => $data['role'] === 'Instructor'
                    ? $data['instructor_id']
                    : null,
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($defaultPassword),
                'role' => $data['role'],
                'department' => $data['department'],
                'status' => 'Active',
            ]);

            $successCount++;
        }

        fclose($handle);

        return view('admin.users.bulk-result', [
            'successCount' => $successCount,
            'skippedCount' => $skippedCount,
            'errors' => $errors,
        ]);
    }
}