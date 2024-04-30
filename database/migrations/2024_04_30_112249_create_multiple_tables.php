<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        // creating department table
        Schema::create('departments', function (Blueprint $table){
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->timestamps();
            $table->integer('is_active')->default(1);
        });

        // creating program table
        Schema::create('programs', function(Blueprint $table){
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->integer('is_active')->default(1);
            $table->timestamps();
            $table->foreignId('department_id')->constrained()->onDelete('restrict');
        });
        //creating teacher table
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->char('middle_initial')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->date('birthday')->nullable();
            $table->char('sex');
            $table->string('degree');
            $table->integer('is_active')->default(1);
            $table->foreignId('department_id')->constrained()->onDelete('restrict');
            $table->timestamps();
        });

        // creating student's table
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->char('middle_initial')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('year_level');
            $table->date('birthday')->nullable();
            $table->char('sex');
            $table->integer('is_active')->default(1);
            $table->timestamps();
            $table->foreignId('program_id')->constrained()->onDelete('restrict');
        });

        //creating subject table
        Schema::create('subjects', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->string('code')->unique(); // Subject Code
            $table->string('name');
            $table->text('description')->nullable();
            $table->float('credits');
            $table->string('prerequisites')->nullable();
            $table->integer('is_active')->default(1);
            $table->timestamps();
        });

        Schema::create('subject_offerings', function (Blueprint $table){
            $table->id();
            $table->string('academic_year');
            $table->integer('semester');
            $table->integer('year_level');
            $table->timestamps();
            $table->foreignId('program_id')->constrained()->onDelete('cascade');
            $table->foreignId('subject_id')->constrained()->onDelete('cascade');
        });

        Schema::create('sections', function (Blueprint $table){
            $table->id();
            $table->integer('section_number');
            $table->string('schedule')->nullable();
            $table->string('room')->nullable();
            $table->integer('capacity')->default('40');
            $table->timestamps();
            $table->foreignId('offering_id')->constrained()->onDelete('cascade');
            $table->foreignId('teacher_id')->nullable()->constrained()->onDelete('set null');
        });

        Schema::create('enrollments', function (Blueprint $table){
            $table->id();
            $table->timestamps();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('section_id')->constrained()->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('department');
        Schema::dropIfExists('program');
        Schema::dropIfExists('teacher');
        Schema::dropIfExists('student');
        Schema::dropIfExists('subject');
        Schema::dropIfExists('subject_offering');
        Schema::dropIfExists('section');
        Schema::dropIfExists('enrollment');
    }
};
