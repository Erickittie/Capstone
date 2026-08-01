<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AuthController;

Route::get('/', function(){
    return redirect() ->route('login');
});

Route::middleware('guest') -> group(function(){
    Route::get('/login', [AuthController::class, 'login']) -> name('login');
    Route::post('/login', [AuthController::class, 'authenticate']) -> name('authenticate');
});

// Admin Routes

Route::middleware('auth') -> group(function () {
    Route::post('/logout', [AuthController::class, 'logout']) -> name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index']) -> name('dashboard');
    Route::resource('users', UserController::class);
    Route::resource('classes', ClassController::class);
    Route::get('/reports', [ReportController::class, 'index']) -> name('reports.index');
    Route::view('/teacher', 'instructor.dashboard') -> name('instructor.dashboard');
    Route::view('/student', 'student.dashboard') -> name('student.dashboard');
});


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
    Route::view('class/{classId}/task-manager', 'student.task-manager');
    Route::view('class/{classId}/file-repository', 'student.file-repository');

    // Check-in request routes
    Route::get('class/{classId}/checkin', [\App\Http\Controllers\Student\CheckinRequestController::class, 'index'])
        ->name('student.checkin.index');
    Route::post('class/{classId}/checkin', [\App\Http\Controllers\Student\CheckinRequestController::class, 'store'])
        ->name('student.checkin.store');

    // Vote routes
    Route::get('class/{classId}/leader-vote', [\App\Http\Controllers\Student\VoteController::class, 'index'])
        ->name('student.vote.index');
    Route::post('class/{classId}/leader-vote', [\App\Http\Controllers\Student\VoteController::class, 'store'])
        ->name('student.vote.store');
});

Route::view('/overview', 'admin.overview');
Route::view('/users', 'admin.users');
Route::view('/TeacherDetails', 'admin.TeacherDetails');
Route::view('/StudentDetails', 'admin.StudentDetails');
Route::view('/classes', 'admin.classes');
Route::view('/ClassDetails', 'admin.ClassDetails');
Route::view('/reports', 'admin.reports');