<?php
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DepartmentsController;
use App\Http\Controllers\EnrollmentsController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\ProgramsController;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\SubjectOfferingsController;
use App\Http\Controllers\SubjectsController;
use App\Http\Controllers\TeachersController;
use Illuminate\Support\Facades\Route;

// just deleting cookies
Route::get('/deleteCookie', [LoginController::class, 'deleteCookies'])->name('deleteCookies');
Route::get('/', [HomePageController::class, 'index'])->name('home_page');

// Manage student routes
Route::prefix('/students')->group(function () {
    Route::get('/manage', [StudentsController::class, 'index'])->name('student.manage');
    Route::get('/add', [StudentsController::class, 'store'])->name('student.create');
    Route::get('/add_form', [StudentsController::class, 'addForm'])->name('student.add_page');
    Route::get('/{id}/edit_form', [StudentsController::class, 'editForm'])->name('student.edit_page');
    Route::put('/{id}/update', [StudentsController::class, 'update'])->name('student.update');
    Route::delete('/{id}/delete', [StudentsController::class, 'destroy'])->name('student.delete');
});


// Manage teacher
Route::prefix('/teachers')->group(function () {
    Route::get('/manage', [TeachersController::class, 'index'])->name('teacher.manage');
    Route::get('/add', [TeachersController::class, 'store'])->name('teacher.create');
    Route::get('/add_form', [TeachersController::class, 'addForm'])->name('teacher.add_page');
    Route::get('/{id}/edit_form', [TeachersController::class, 'editForm'])->name('teacher.edit_page');
    Route::put('/{id}/update', [TeachersController::class, 'update'])->name('teacher.update');
    Route::delete('/{id}/delete', [TeachersController::class, 'destroy'])->name('teacher.delete');
});


// Manage subject
Route::prefix('/subjects')->group(function () {
    Route::get('/manage', [SubjectsController::class, 'index'])->name('subject.manage');
    Route::get('/add', [SubjectsController::class, 'store'])->name('subject.create');
    Route::get('/add_form', [SubjectsController::class, 'addForm'])->name('subject.add_page');
    Route::get('/{id}/edit_form', [SubjectsController::class, 'editForm'])->name('subject.edit_page');
    Route::put('/{id}/update', [SubjectsController::class, 'update'])->name('subject.update');
    Route::delete('/{id}/delete', [SubjectsController::class, 'destroy'])->name('subject.delete');
});

// Manage Department
Route::prefix('/departments')->group(function () {
    Route::get('/manage', [DepartmentsController::class, 'index'])->name('department.manage');
    Route::get('/add', [DepartmentsController::class, 'store'])->name('department.create');
    Route::get('/add_form', [DepartmentsController::class, 'addForm'])->name('department.add_page');
    Route::get('/{id}/edit_form', [DepartmentsController::class, 'editForm'])->name('department.edit_page');
    Route::put('/{id}/update', [DepartmentsController::class, 'update'])->name('department.update');
    Route::delete('/{id}/delete', [DepartmentsController::class, 'destroy'])->name('department.delete');
});

// Manage Program
Route::prefix('/programs')->group(function () {
    Route::get('/manage', [ProgramsController::class, 'index'])->name('program.manage');
    Route::get('/add', [ProgramsController::class, 'store'])->name('program.create');
    Route::get('/add_form', [ProgramsController::class, 'addForm'])->name('program.add_page');
    Route::get('/{id}/edit_form', [ProgramsController::class, 'editForm'])->name('program.edit_page');
    Route::put('/{id}/update', [ProgramsController::class, 'update'])->name('program.update');
    Route::delete('/{id}/delete', [ProgramsController::class, 'destroy'])->name('program.delete');
});

// Manage Subject Offering
Route::prefix('/subject-offerings')->group(function () {
    Route::get('/manage', [SubjectOfferingsController::class, 'index'])->name('subject_offering.manage');
    Route::get('/add', [SubjectOfferingsController::class, 'store'])->name('subject_offering.create');
    Route::get('/add_form', [SubjectOfferingsController::class, 'addForm'])->name('subject_offering.add_page');
    Route::get('/{id}/edit_form', [SubjectOfferingsController::class, 'editForm'])->name('subject_offering.edit_page');
    Route::put('/{id}/update', [SubjectOfferingsController::class, 'update'])->name('subject_offering.update');
    Route::delete('/{id}/delete', [SubjectOfferingsController::class, 'destroy'])->name('subject_offering.delete');

    //Manage Sections under each subject
    Route::prefix('/sections')->group(function () {
        Route::get('/{id}/manage', [SubjectOfferingsController::class, 'viewSections'])->name('subject_offering.section.manage');
        Route::get('/{id}/add', [SubjectOfferingsController::class, 'storeSection'])->name('subject_offering.section.create');
        Route::get('/{id}/add_form', [SubjectOfferingsController::class, 'addSectionForm'])->name('subject_offering.section.add_page');
        Route::get('/{id}/edit_form', [SubjectOfferingsController::class, 'editSectionForm'])->name('subject_offering.section.edit_page');
        Route::put('/{id}/update', [SubjectOfferingsController::class, 'updateSection'])->name('subject_offering.section.update');
        Route::delete('/{id}/delete', [SubjectOfferingsController::class, 'deleteSection'])->name('subject_offering.section.delete');
    });

});

// Manage Program
Route::prefix('/enrollment')->group(function () {
    // routes/web.php
    Route::get('/index', [EnrollmentsController::class, 'index'])->name('enrollment.index');
    Route::get('/search', [EnrollmentsController::class, 'search'])->name('enrollment.search');
    Route::get('/enroll', [EnrollmentsController::class, 'enroll'])->name('enrollment.enroll');
    Route::delete('/{student_id}/{section_id}/delete', [EnrollmentsController::class, 'delete'])->name('enrollment.delete');

});
