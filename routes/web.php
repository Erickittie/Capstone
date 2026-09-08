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
use App\Http\Controllers\TaskController;
use App\Http\Controllers\InstructorProjectController;
use App\Http\Controllers\InstructorTaskLedgerController;

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

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']) ->name('logout');
});
