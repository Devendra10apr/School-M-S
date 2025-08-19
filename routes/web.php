<?php

use App\Http\Controllers\Admin\AssignedSubjectController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\AssignedFeeController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ExamTypeController;
use App\Http\Controllers\FeeCategoryController;
use App\Http\Controllers\FeeTypeController;
use App\Http\Controllers\MarkController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StudentAttendanceController;
use App\Http\Controllers\StudentProfileController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TimetableController;
use App\Http\Controllers\UserController;
use App\Models\FeeCategory;
use App\Models\FeeType;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('/classroom', ClassroomController::class)->names('classroom');
    Route::resource('/sections', SectionController::class)->names('sections');
    Route::resource('/subjects', SubjectController::class)->names('subject');
    Route::resource('/assignedSubject', AssignedSubjectController::class);
    Route::resource('/student-profiles', StudentProfileController::class);
    Route::resource('/teachers', TeacherController::class)->names('teachers');
    Route::resource('/timetables', TimetableController::class)->names('timetables');
    Route::get('/get-sections/{id}', [TimetableController::class, 'getSections'])->name('get.sections');

    Route::get('/get-subjects-teachers', [TimetableController::class, 'getSubjectsAndTeachers'])->name('get.subjects.teachers');
    Route::resource('exam-types', ExamTypeController::class);
    Route::resource('exams', ExamController::class);

    Route::get('/get-students/{classroomId}/{sectionId}', [MarkController::class, 'getStudents']);
    Route::resource('marks', MarkController::class);

    Route::get('/results/generate', [ResultController::class, 'generate'])->name('results.generate');
    Route::get('/results/fetch-students', [ResultController::class, 'fetchStudents'])->name('results.fetch.students');
    Route::get('/results/create', [ResultController::class, 'create'])->name('results.create');
    Route::post('/results/store', [ResultController::class, 'store'])->name('results.srore');
    // fee category
    Route::resource('fee_category', FeeCategoryController::class);
    Route::resource('fee_type', FeeTypeController::class);

    /// ajax auto fetch
    Route::get('/get-sections', [AssignedFeeController::class, 'getSections'])->name('getSections');
    Route::get('/get-students', [AssignedFeeController::class, 'getStudents'])->name('getStudents');
    Route::get('/get-student-rollno', [AssignedFeeController::class, 'getStudentRollNo'])->name('getStudentRollNo');
});

// teacher
Route::middleware(['auth', 'role:teacher'])->prefix('teacher')->name('teacher.')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
});
// student
Route::middleware(['auth', 'role:student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', function () {
        return "Welcome to student";
    })->name('dashboard');
});
// parent
Route::middleware(['auth', 'role:parent'])->prefix('parent')->name('parent.')->group(function () {
    Route::get('/dashboard', function () {
        return "Welcome to parent";
    })->name('dashboard');
});

// student attendance
Route::middleware('auth', 'role:admin|teacher')->group(function () {
    Route::resource('studentAttendance', StudentAttendanceController::class);
    Route::get('student-attendance-view', [StudentAttendanceController::class, 'attendanceView'])->name('student.attendance.view');
});


require __DIR__ . '/auth.php';
