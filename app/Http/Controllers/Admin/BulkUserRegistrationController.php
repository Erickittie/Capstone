<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
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
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $columns = [
            'student_id',
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
                'Jer Erick Dumalagan',
                'jererick.dumalagan@gmail.com',
                'Student',
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

            return back()->with(
                'error',
                'The CSV file is empty.'
            );
        }

        $header = array_map(function ($column) {
            return strtolower(trim($column));
        }, $header);


        $requiredColumns = [
            'student_id',
            'name',
            'email',
            'role',
            'department',
        ];

        foreach ($requiredColumns as $column) {

            if (!in_array($column, $header)) {

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

            if (
                count(array_filter($row, function ($value) {
                    return trim($value) !== '';
                })) === 0
            ) {
                continue;
            }

            $data = [];

            foreach ($header as $index => $column) {
                $data[$column] = isset($row[$index])
                    ? trim($row[$index])
                    : null;
            }

            $validator = Validator::make($data, [
                'student_id' => 'nullable|string|max:50',
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

            if (
                $data['role'] === 'Student' &&
                empty($data['student_id'])
            ) {

                $errors[] = [
                    'row' => $rowNumber,
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'errors' => [
                        'Student ID is required for Student accounts.'
                    ],
                ];

                continue;
            }

            if (
                User::where('email', $data['email'])->exists()
            ) {

                $skippedCount++;

                $errors[] = [
                    'row' => $rowNumber,
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'errors' => [
                        'Email already exists.'
                    ],
                ];

                continue;
            }

            if (
                !empty($data['student_id']) &&
                User::where(
                    'student_id',
                    $data['student_id']
                )->exists()
            ) {

                $skippedCount++;

                $errors[] = [
                    'row' => $rowNumber,
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'errors' => [
                        'Student ID already exists.'
                    ],
                ];

                continue;
            }

            if ($data['role'] === 'Student') {

                $defaultPassword = $data['student_id'];

            } else {

                $defaultPassword = 'CarryOn@123';

            }

            User::create([
                'student_id' => $data['student_id'] ?: null,
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($defaultPassword),
                'role' => $data['role'],
                'department' => $data['department'] ?: null,
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