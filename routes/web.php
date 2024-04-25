<?php
//use App\Http\Middleware\CheckUserType;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\SubjectsController;
use App\Http\Controllers\TeachersController;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\Auth\LoginController;


/* Login routes
Route::get('/login', [LoginController::class, 'showLoginPage'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
*/

// just deleting cookies
Route::get('/deleteCookie', [LoginController::class, 'deleteCookies'])->name('deleteCookies');
Route::get('/', [HomePageController::class, 'index'])->name('home_page');

// Manage student
Route::prefix('/students')->group(function () {
    Route::get('/manage', [StudentsController::class, 'index'])->name('student.manage');
    Route::get('/create', [StudentsController::class, 'store'])->name('student.create');
    Route::get('/add_form', [StudentsController::class, 'addForm'])->name('student.add_page');
});

// Manage teacher
Route::prefix('/teachers')->group(function () {
    Route::get('/manage', [TeachersController::class, 'index'])->name('teacher.manage');
    Route::get('/create', [TeachersController::class, 'store'])->name('teacher.create');
    Route::get('/add_form', [TeachersController::class, 'addForm'])->name('teacher.add_page');
});


// Manage subject
Route::prefix('/subjects')->group(function () {
    Route::get('/manage', [SubjectsController::class, 'index'])->name('subject.manage');
    Route::get('/create', [SubjectsController::class, 'store'])->name('subject.create');
    Route::get('/add_form', [SubjectsController::class, 'addForm'])->name('subject.add_page');
});
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

