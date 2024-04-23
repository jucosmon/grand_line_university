<?php

use App\Http\Controllers\AddStudentController;
use App\Http\Controllers\AddTeacherController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\TeachersController;
use Illuminate\Support\Facades\Route;

/*
Route::get('/', function () {
    return view('home_page');
});
*/

Route::get('/', [HomePageController::class, 'index'])->name('home_page');;
Route::get('/manage_student_page', [StudentsController::class, 'index'])->name('manage_student_page');
Route::get('/add-student', [AddStudentController::class, 'store'])->name('student.create');
Route::get('/add_student_page', function () {
    return view('add_student_page');
});

Route::get('/manage_teacher_page', [TeachersController::class, 'index'])->name('manage_teacher_page');
Route::get('/add-teacher', [AddTeacherController::class, 'store'])->name('teacher.create');
Route::get('/add_teacher_page', function () {
    return view('add_teacher_page');
});
