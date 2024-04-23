<?php

use App\Http\Controllers\AddStudentController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\StudentsController;
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

