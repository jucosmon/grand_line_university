<?php

use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\TeacherMiddleware;
use App\Http\Middleware\StudentMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DepartmentsController;
use App\Http\Controllers\EnrollmentsController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\ProgramsController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\SubjectOfferingsController;
use App\Http\Controllers\SubjectsController;
use App\Http\Controllers\TeachersController;
use App\Http\Controllers\TermsController;

// Login and logout routes
Route::get('/login_page', [LoginController::class, 'showLoginPage'])->name('login');
Route::get('/login', [LoginController::class, 'login'])->name('store_login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Homepage route with session check middleware
Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomePageController::class, 'index'])->name('home_page');

});


// Student routes
Route::middleware(['auth', 'student'])->group(function () {
    Route::get('/student', [HomePageController::class, 'studentHome'])->name('student.home_page');
    Route::get('/enrollment', [StudentsController::class, 'enrollmentPage'])->name('student.enrollment_page');
    Route::get('/enroll', [StudentsController::class, 'enroll'])->name('student.enroll');
    Route::delete('/{section_id}/delete', [StudentsController::class, 'deleteEnrollment'])->name('student.enrollment.delete');
    Route::get('/academics', [StudentsController::class, 'academics'])->name('student.academics');
    Route::get('/student/profile', [StudentsController::class, 'showProfile'])->name('student.profile');
    Route::get('/student/edit_form/{id}', [StudentsController::class, 'editProfileForm'])->name('student.edit_profile_form');
    Route::put('/student/edit/{id}', [StudentsController::class, 'editProfile'])->name('student.edit_profile');


});

// Teacher routes
Route::middleware(['auth', 'teacher'])->group(function () {
        Route::get('/teacher', [HomePageController::class, 'teacherHome'])->name('teacher.home_page');
        Route::get('/teacher/loads', [TeachersController::class, 'viewLoads'])->name('teacher.loads');
        Route::get('/teacher/view-students/{section_id}', [TeachersController::class, 'viewStudents'])->name('teacher.section.students');
        Route::get('/teacher/profile', [TeachersController::class, 'showProfile'])->name('teacher.profile');
        Route::get('/teacher/edit_form/{id}', [TeachersController::class, 'editProfileForm'])->name('teacher.edit_profile_form');
        Route::put('/teacher/edit/{id}', [TeachersController::class, 'editProfile'])->name('teacher.edit_profile');
    });

// Admin routes
Route::middleware(['auth', 'admin'])->group(function () {

    // Manage student as an admin
    Route::prefix('/students')->group(function () {
        Route::get('/manage', [StudentsController::class, 'index'])->name('student.manage');
        Route::get('/add', [StudentsController::class, 'store'])->name('student.create');
        Route::get('/add_form', [StudentsController::class, 'addForm'])->name('student.add_page');
        Route::get('/{id}/edit_form', [StudentsController::class, 'editForm'])->name('student.edit_page');
        Route::put('/{id}/update', [StudentsController::class, 'update'])->name('student.update');
        Route::delete('/{id}/delete', [StudentsController::class, 'destroy'])->name('student.delete');
    });


    // Manage teacher as an admin
    Route::prefix('/teachers')->group(function () {
        Route::get('/manage', [TeachersController::class, 'index'])->name('teacher.manage');
        Route::get('/add', [TeachersController::class, 'store'])->name('teacher.create');
        Route::get('/add_form', [TeachersController::class, 'addForm'])->name('teacher.add_page');
        Route::get('/{id}/edit_form', [TeachersController::class, 'editForm'])->name('teacher.edit_page');
        Route::put('/{id}/update', [TeachersController::class, 'update'])->name('teacher.update');
        Route::delete('/{id}/delete', [TeachersController::class, 'destroy'])->name('teacher.delete');
    });


    // Manage subject as an admin
    Route::prefix('/subjects')->group(function () {
        Route::get('/manage', [SubjectsController::class, 'index'])->name('subject.manage');
        Route::get('/add', [SubjectsController::class, 'store'])->name('subject.create');
        Route::get('/add_form', [SubjectsController::class, 'addForm'])->name('subject.add_page');
        Route::get('/{id}/edit_form', [SubjectsController::class, 'editForm'])->name('subject.edit_page');
        Route::put('/{id}/update', [SubjectsController::class, 'update'])->name('subject.update');
        Route::delete('/{id}/delete', [SubjectsController::class, 'destroy'])->name('subject.delete');
    });

    // Manage Department as an admin
    Route::prefix('/departments')->group(function () {
        Route::get('/manage', [DepartmentsController::class, 'index'])->name('department.manage');
        Route::get('/add', [DepartmentsController::class, 'store'])->name('department.create');
        Route::get('/add_form', [DepartmentsController::class, 'addForm'])->name('department.add_page');
        Route::get('/{id}/edit_form', [DepartmentsController::class, 'editForm'])->name('department.edit_page');
        Route::put('/{id}/update', [DepartmentsController::class, 'update'])->name('department.update');
        Route::delete('/{id}/delete', [DepartmentsController::class, 'destroy'])->name('department.delete');
    });

    // Manage Program as an admin
    Route::prefix('/programs')->group(function () {
        Route::get('/manage', [ProgramsController::class, 'index'])->name('program.manage');
        Route::get('/add', [ProgramsController::class, 'store'])->name('program.create');
        Route::get('/add_form', [ProgramsController::class, 'addForm'])->name('program.add_page');
        Route::get('/{id}/edit_form', [ProgramsController::class, 'editForm'])->name('program.edit_page');
        Route::put('/{id}/update', [ProgramsController::class, 'update'])->name('program.update');
        Route::delete('/{id}/delete', [ProgramsController::class, 'destroy'])->name('program.delete');
    });

    // Manage Subject Offering as an admin
    Route::prefix('/subject-offerings')->group(function () {
        Route::get('/manage', [SubjectOfferingsController::class, 'index'])->name('subject_offering.manage');
        Route::get('/add', [SubjectOfferingsController::class, 'store'])->name('subject_offering.create');
        Route::get('/add_form', [SubjectOfferingsController::class, 'addForm'])->name('subject_offering.add_page');
        Route::get('/{id}/edit_form', [SubjectOfferingsController::class, 'editForm'])->name('subject_offering.edit_page');
        Route::put('/{id}/update', [SubjectOfferingsController::class, 'update'])->name('subject_offering.update');
        Route::delete('/{id}/delete', [SubjectOfferingsController::class, 'destroy'])->name('subject_offering.delete');

        //Manage Sections under each subject as an admin
        Route::prefix('/sections')->group(function () {
            Route::get('/{id}/manage', [SubjectOfferingsController::class, 'viewSections'])->name('subject_offering.section.manage');
            Route::get('/{id}/add', [SubjectOfferingsController::class, 'storeSection'])->name('subject_offering.section.create');
            Route::get('/{id}/add_form', [SubjectOfferingsController::class, 'addSectionForm'])->name('subject_offering.section.add_page');
            Route::get('/{id}/edit_form', [SubjectOfferingsController::class, 'editSectionForm'])->name('subject_offering.section.edit_page');
            Route::put('/{id}/update', [SubjectOfferingsController::class, 'updateSection'])->name('subject_offering.section.update');
            Route::delete('/{id}/delete', [SubjectOfferingsController::class, 'deleteSection'])->name('subject_offering.section.delete');
        });

    });

    // Manage Program as an admin
    Route::prefix('/enrollment')->group(function () {
        // routes/web.php
        Route::get('/index', [EnrollmentsController::class, 'index'])->name('enrollment.index');
        Route::get('/search', [EnrollmentsController::class, 'search'])->name('enrollment.search');
        Route::get('/enroll', [EnrollmentsController::class, 'enroll'])->name('enrollment.enroll');
        Route::delete('/{student_id}/{section_id}/delete', [EnrollmentsController::class, 'delete'])->name('enrollment.delete');

    });


    // Manage Department as an admin
    Route::prefix('/terms')->group(function () {
        Route::get('/manage', [TermsController::class, 'index'])->name('term.manage');
        Route::get('/add', [TermsController::class, 'store'])->name('term.create');
        Route::get('/add_form', [TermsController::class, 'addForm'])->name('term.add_page');
        Route::get('/{id}/edit_form', [TermsController::class, 'editForm'])->name('term.edit_page');
        Route::put('/{id}/update', [TermsController::class, 'update'])->name('term.update');
        Route::delete('/{id}/delete', [TermsController::class, 'destroy'])->name('term.delete');
    });

     Route::get('/chair/profile', [AdminController::class, 'showProfile'])->name('user.profile');
        Route::get('/chair/edit_form/{id}', [AdminController::class, 'editProfileForm'])->name('user.edit_profile_form');
        Route::put('/chair/edit/{id}', [AdminController::class, 'editProfile'])->name('user.edit_profile');

});
