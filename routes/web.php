<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'landing');

Route::view('/registration', 'auth.registration');

Route::view('/login', 'auth.login');

Route::view('/dashboard', 'instructor.dashboard');

Route::prefix('instructor')->group(function () {
    Route::view('create-class', 'instructor.create-class');
    Route::view('group-assignment', 'instructor.group-assignment');
    Route::view('task-ledger', 'instructor.task-ledger');
    Route::view('course-detail', 'instructor.course-detail');
});

Route::view('/StudentDashboard', 'student.StudentDashboard');

Route::prefix('student')->group(function () {
    Route::view('class/{classId}', 'student.class-detail');
    Route::view('class/{classId}/contribution', 'student.contribution');
    Route::view('class/{classId}/group-status', 'student.group-status');
    Route::view('class/{classId}/leader-vote', 'student.leader-vote');
    Route::view('class/{classId}/task-manager', 'student.task-manager');
    Route::view('class/{classId}/file-repository', 'student.file-repository');
    Route::view('class/{classId}/checkin', 'student.checkin-schedule');
});
Route::view('/overview', 'admin.overview');
Route::view('/users', 'admin.users');
Route::view('/TeacherDetails', 'admin.TeacherDetails');
Route::view('/StudentDetails', 'admin.StudentDetails');
Route::view('/classes', 'admin.classes');
Route::view('/ClassDetails', 'admin.ClassDetails');
Route::view('/reports', 'admin.reports');