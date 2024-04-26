@extends('layout.layout')

@section('content')
    <section class="section contact" data-section="section6" style="background-color: #132c33; color: white;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="section-heading">
                        <h2>Add Student</h2>
                    </div>
                    <form action="{{ route('student.create') }}" method="get" class="custom-form">
                        @csrf
                        <div class="mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" required>
                            <div class="invalid-feedback">
                                Please enter the student's first name.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="middle_initial" class="form-label">Middle Initial</label>
                            <input type="text" class="form-control" id="middle_initial" name="middle_initial" required>
                            <div class="invalid-feedback">
                                Please enter the student's middle initial.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" required>
                            <div class="invalid-feedback">
                                Please enter the student's last name.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="program" class="form-label">Program</label>
                            <select class="form-select" id="program" name="program" required>
                                <option value="">Select Program</option>
                                <option value="Bachelor in Fine Arts">Bachelor in Fine Arts</option>
                                <option value="Bachelor of Science in Information Technology">Bachelor of Science in
                                    Information Technology (BSIT)</option>
                                <option value="Bachelor of Science in Computer Science">Bachelor of Science in
                                    Computer Science (BSCS)</option>
                                <option value="Bachelor of Science in Medical Technology">Bachelor of Science in
                                    Medical Technology (BSMT)</option>
                                <option value="Bachelor of Science in Nursing">Bachelor of Science in Nursing (BSN)
                                </option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a program.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="year" class="form-label">Year</label>
                            <input type="number" class="form-control" id="year" name="year" required>
                            <div class="invalid-feedback">
                                Please enter the student's year.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="birthday" class="form-label">Birthday</label>
                            <input type="date" class="form-control" id="birthday" name="birthday" required>
                            <div class="invalid-feedback">
                                Please enter the student's birthday.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="sex" class="form-label">Sex</label>
                            <select class="form-select" id="sex" name="sex" required>
                                <option value="">Select Sex</option>
                                <option value="F">Female</option>
                                <option value="M">Male</option>
                                <option value="O">Others</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select the student's sex.
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection