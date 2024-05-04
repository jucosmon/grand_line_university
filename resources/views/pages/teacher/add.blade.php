@extends('layout.layout')

@section('content')
    <section class="section contact" data-section="section6" style="background-color: #132c33; color: white;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="section-heading">
                        <h2>Add Teacher</h2>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('teacher.create') }}" method="get" class="custom-form">
                        @csrf
                        {{-- Cancel Button --}}
                        <div class="mb-3">
                            <a href="{{ route('teacher.manage') }}" class="btn btn-secondary">
                                <i class="bi bi-x-lg"></i>
                            </a>
                        </div>

                        <div class="mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" required>
                            <div class="invalid-feedback">
                                Please enter the teacher's first name.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="middle_initial" class="form-label">Middle Initial</label>
                            <input type="text" class="form-control" id="middle_initial" name="middle_initial" required>
                            <div class="invalid-feedback">
                                Please enter the teacher's middle initial.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" required>
                            <div class="invalid-feedback">
                                Please enter the teacher's last name.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="degree" class="form-label">Degree</label>
                            <select class="form-select" id="degree" name="degree" required>
                                <option value="">Select Degree</option>
                                <option value="Bachelor in Fine Arts">Bachelor in Fine Arts</option>
                                <option value="Bachelor of Science in Information Technology">Bachelor of Science in
                                    Information Technology (BSIT)</option>
                                <option value="Bachelor of Science in Computer Science">Bachelor of Science in
                                    Computer Science (BSCS)</option>
                                <option value="Bachelor of Science in Medical Technology">Bachelor of Science in
                                    Medical Technology (BSMT)</option>
                                <option value="Bachelor of Science in Nursing">Bachelor of Science in Nursing (BSN)
                                </option>
                                <option value="Bachelor of Science in Accountancy">Bachelor of Science in Accountancy (BSA)
                                </option>
                                <option value="Bachelor of Science in Financial Management">Bachelor of Science in Financial
                                    Management (BSFM)
                                </option>
                            </select>
                            <div class="invalid-feedback">
                                Please select teacher's degree.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="birthday" class="form-label">Birthday</label>
                            <input type="date" class="form-control" id="birthday" name="birthday" required>
                            <div class="invalid-feedback">
                                Please enter the teacher's birthday.
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
                                Please select the teacher's sex.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="department_id" class="form-label">Department</label>
                            <select class="form-select" id="department_id" name="department_id" required>
                                <option value="">Select Department</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Please select the teacher's department.
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
