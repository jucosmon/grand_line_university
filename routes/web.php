<?php
//use App\Http\Middleware\CheckUserType;
use App\Http\Controllers\AddStudentController;
use App\Http\Controllers\AddSubjectController;
use App\Http\Controllers\AddTeacherController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\SubjectsController;
use App\Http\Controllers\TeachersController;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\Auth\LoginController;
//use App\Http\Controllers\StudentHomePage;

/* Login routes
Route::get('/login', [LoginController::class, 'showLoginPage'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
*/

// just deleting cookies
Route::get('/deleteCookie', [LoginController::class, 'deleteCookies'])->name('deleteCookies');

Route::get('/', [HomePageController::class, 'index'])->name('home_page');

// Manage student
Route::get('/manage_student_page', [StudentsController::class, 'index'])->name('manage_student_page');
Route::get('/add-student', [StudentsController::class, 'store'])->name('student.create');
Route::get('/add_student_page', [StudentsController::class, 'addForm'])->name('add_student_page');

// Manage teacher
Route::get('/manage_teacher_page', [TeachersController::class, 'index'])->name('manage_teacher_page');
Route::get('/add-teacher', [TeachersController::class, 'store'])->name('teacher.create');
Route::get('/add_teacher_page', [TeachersController::class, 'addForm'])->name('add_teacher_page');

// Manage subject
Route::get('/manage_subject_page', [SubjectsController::class, 'index'])->name('manage_subject_page');
Route::get('/add-subject', [SubjectsController::class, 'store'])->name('subject.create');
Route::get('/add_subject_page', [SubjectsController::class, 'addForm'])->name('add_subject_page');

/* Redirect unauthenticated users to login page
Route::get('/home', function () {
    return redirect()->route('login');
});

Route::get('/login_page', function () {
    return view('login_page');
});

Route::get('/login_page', function () {
    return view('login_page');
});

// Student Homepage
Route::get('/student_home_page', [StudentsController::class, 'showHomePage'])->name('student_home_page');

*/

