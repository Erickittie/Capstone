<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InstructorDashboardController;
use App\Http\Controllers\InstructorClassController;
use App\Http\Controllers\InstructorGroupController;
use App\Http\Controllers\Student\TaskController;
use App\Http\Controllers\InstructorProjectController;
use App\Http\Controllers\InstructorTaskLedgerController;
use App\Http\Controllers\Student\StudentDashboardController;
use App\Http\Controllers\Student\StudentClassController;
use App\Http\Controllers\Student\VoteController;
use App\Http\Controllers\Student\NotificationController;


Route::get('/', function(){
    return redirect() ->route('login');
});

Route::middleware('guest') -> group(function(){
    Route::get('/login', [AuthController::class, 'login']) -> name('login');
    Route::post('/login', [AuthController::class, 'authenticate']) -> name('authenticate');
});

Route::view('/registration', 'auth.registration') -> name('registration');

// Admin Routes
Route::middleware(['auth', 'role:Admin']) ->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']) ->name('dashboard');
    Route::resource('users', UserController::class);
    Route::resource('classes', ClassController::class);
    Route::get('/reports', [ReportController::class, 'index']) ->name('reports.index');
    Route::get('/reports/enrollment', [ReportController::class, 'enrollment']) ->name('reports.enrollment');
    Route::get('/reports/contribution', [ReportController::class, 'contribution']) ->name('reports.contribution');
    Route::get('/reports/completion', [ReportController::class, 'completion']) ->name('reports.completion');
});

Route::middleware(['auth', 'role:Instructor'])->group(function () {
    Route::get(
        '/teacher',
        [InstructorDashboardController::class, 'index']
    )->name('instructor.dashboard');
    Route::get(
        '/instructor/class/{classId}',
        [InstructorClassController::class, 'show']
    )->name('instructor.class.configure');
    Route::post(
        '/instructor/class/{classId}/roster/import',
        [InstructorClassController::class, 'importRoster']
    )->name('instructor.class.roster.import');
    Route::get(
        '/instructor/class/{classId}/groups',
        [InstructorGroupController::class, 'index']
    )->name('instructor.class.groups');
    Route::post(
        '/instructor/class/{classId}/groups/manual',
        [InstructorGroupController::class, 'saveManual']
    )->name('instructor.class.groups.manual');
    Route::post(
        '/instructor/class/{classId}/groups/automatic',
        [InstructorGroupController::class, 'automatic']
    )->name('instructor.class.groups.automatic');
    Route::get(
        '/instructor/class/{classId}/projects',
        [InstructorProjectController::class, 'index']
    )->name('instructor.projects.index');
    Route::get(
        '/instructor/class/{classId}/projects/create',
        [InstructorProjectController::class, 'create']
    )->name('instructor.projects.create');
    Route::post(
        '/instructor/class/{classId}/projects',
        [InstructorProjectController::class, 'store']
    )->name('instructor.projects.store');
    Route::get(
        '/instructor/class/{classId}/projects/{projectId}/edit',
        [InstructorProjectController::class, 'edit']
    )->name('instructor.projects.edit');
    Route::put(
        '/instructor/class/{classId}/projects/{projectId}',
        [InstructorProjectController::class, 'update']
    )->name('instructor.projects.update');
    Route::delete(
        '/instructor/class/{classId}/projects/{projectId}',
        [InstructorProjectController::class, 'destroy']
    )->name('instructor.projects.destroy');
    Route::get(
        '/instructor/class/{classId}/task-ledger',
        [InstructorTaskLedgerController::class, 'index']
    )->name('instructor.tasks.ledger');
    Route::get(
        '/instructor/class/{classId}/task-ledger/data',
        [InstructorTaskLedgerController::class, 'data']
    )->name('instructor.tasks.ledger.data');
});

Route::middleware(['auth', 'role:Student'])->group(function () {
    Route::get(
        '/student',
        [StudentDashboardController::class, 'index']
    )->name('student.dashboard');
    Route::get(
        '/student/class/{classId}',
        [StudentClassController::class, 'show']
    )->name('student.class.detail');
    Route::get(
        '/student/class/{classId}/projects/{projectId}',
        [TaskController::class, 'project']
    )->name('student.project.show');
    Route::get(
        '/student/class/{classId}/projects/{projectId}/tasks/create',
        [TaskController::class, 'create']
    )->name('student.tasks.create');
    Route::post(
        '/student/class/{classId}/projects/{projectId}/tasks',
        [TaskController::class, 'store']
    )->name('student.tasks.store');
    Route::view(
        '/student/class/{classId}/contribution',
        'student.contribution'
    )->name('student.contribution');
    Route::view(
        '/student/class/{classId}/group-status',
        'student.group-status'
    )->name('student.group.status');
    Route::view(
        '/student/class/{classId}/task-manager',
        'student.task-manager'
    )->name('student.task.manager');
    Route::view(
        '/student/class/{classId}/file-repository',
        'student.file-repository'
    )->name('student.file.repository');
    Route::get(
        '/student/class/{classId}/checkin',
        [CheckinRequestController::class, 'index']
    )->name('student.checkin.index');
    Route::post(
        '/student/class/{classId}/checkin',
        [CheckinRequestController::class, 'store']
    )->name('student.checkin.store');
    Route::get(
        '/student/class/{classId}/leader-vote',
        [VoteController::class, 'index']
    )->name('student.vote.index');
    Route::post(
        '/student/class/{classId}/leader-vote',
        [VoteController::class, 'store']
    )->name('student.vote.store');
    Route::get(
    '/student/class/{classId}/projects/{projectId}/tasks/{taskId}',
    [TaskController::class, 'show']
    )->name('student.tasks.show');
    Route::post(
    '/student/class/{classId}/projects/{projectId}/tasks/{taskId}/start',
    [TaskController::class, 'start']
    )->name('student.tasks.start');
    Route::post(
    '/student/class/{classId}/projects/{projectId}/tasks/{taskId}/submit',
    [TaskController::class, 'submit']
    )->name('student.tasks.submit');
    Route::get(
    '/student/class/{classId}/projects/{projectId}/tasks/{taskId}/review',
    [TaskController::class, 'review']
    )->name('student.tasks.review');
    Route::post(
    '/student/class/{classId}/projects/{projectId}/tasks/{taskId}/submissions/{submissionId}/approve',
    [TaskController::class, 'approveSubmission']
    )->name('student.tasks.approve');
    Route::post(
    '/student/class/{classId}/projects/{projectId}/tasks/{taskId}/submissions/{submissionId}/reject',
    [TaskController::class, 'rejectSubmission']
    )->name('student.tasks.reject');
    Route::get(
    '/student/notifications',
    [NotificationController::class, 'index']
    )->name('student.notifications.index');
    Route::post(
    '/student/notifications/{notification}/read',
    [NotificationController::class, 'read']
    )->name('student.notifications.read');
    Route::post(
    '/student/notifications/read-all',
    [NotificationController::class, 'readAll']
    )->name('student.notifications.readAll');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']) ->name('logout');
});
