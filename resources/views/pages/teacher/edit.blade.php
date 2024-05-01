@extends('layout.layout')

@section('content')
    <section class="section contact" data-section="section6" style="background-color: #132c33; color: white;">
        <div class="container">


            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="section-heading">

                        <h2>Edit Teacher</h2>
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
                    <form id="updateForm" action="{{ route('teacher.update', $teacher->id) }}" method="POST"
                        class="custom-form">
                        @csrf
                        @method('PUT')
                        {{-- Cancel Button --}}
                        <div class="mb-3">
                            <a href="{{ route('teacher.manage') }}" class="btn btn-secondary">
                                <i class="bi bi-x-lg"></i>
                            </a>
                        </div>
                        <div class="mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name"
                                value="{{ $teacher->first_name }}" required>
                            <div class="invalid-feedback">
                                Please enter the teacher's first name.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="middle_initial" class="form-label">Middle Initial</label>
                            <input type="text" class="form-control" id="middle_initial" name="middle_initial"
                                value="{{ $teacher->middle_initial }}" required>
                            <div class="invalid-feedback">
                                Please enter the teacher's middle initial.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name"
                                value="{{ $teacher->last_name }}" required>
                            <div class="invalid-feedback">
                                Please enter the teacher's last name.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="degree" class="form-label">Degree</label>
                            <select class="form-select" id="degree" name="degree" required>
                                <option value="">Select Degree</option>
                                <option value="Bachelor in Fine Arts"
                                    {{ $teacher->degree == 'Bachelor in Fine Arts' ? 'selected' : '' }}>Bachelor in Fine
                                    Arts</option>
                                <option value="Bachelor of Science in Information Technology"
                                    {{ $teacher->degree == 'Bachelor of Science in Information Technology' ? 'selected' : '' }}>
                                    Bachelor of Science in Information Technology (BSIT)</option>
                                <option value="Bachelor of Science in Computer Science"
                                    {{ $teacher->degree == 'Bachelor of Science in Computer Science' ? 'selected' : '' }}>
                                    Bachelor of Science in Computer Science (BSCS)</option>
                                <option value="Bachelor of Science in Medical Technology"
                                    {{ $teacher->degree == 'Bachelor of Science in Medical Technology' ? 'selected' : '' }}>
                                    Bachelor of Science in Medical Technology (BSMT)</option>
                                <option value="Bachelor of Science in Nursing"
                                    {{ $teacher->degree == 'Bachelor of Science in Nursing' ? 'selected' : '' }}>Bachelor
                                    of Science in Nursing (BSN)</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a degree.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="birthday" class="form-label">Birthday</label>
                            <input type="date" class="form-control" id="birthday" name="birthday"
                                value="{{ $teacher->birthday }}" required>
                            <div class="invalid-feedback">
                                Please enter the teacher's birthday.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="sex" class="form-label">Sex</label>
                            <select class="form-select" id="sex" name="sex" required>
                                <option value="">Select Sex</option>
                                <option value="F" {{ $teacher->sex == 'F' ? 'selected' : '' }}>Female</option>
                                <option value="M" {{ $teacher->sex == 'M' ? 'selected' : '' }}>Male</option>
                                <option value="O" {{ $teacher->sex == 'O' ? 'selected' : '' }}>Others</option>
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
                                    <option value="{{ $department->id }}"
                                        {{ $teacher->department_id == $department->id ? 'selected' : '' }}>
                                        {{ $department->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Please select the teacher's department.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="is_active" class="form-label">Active Status</label>
                            <select class="form-select" id="is_active" name="is_active" required>
                                <option value="">Select</option>
                                <option value="1" {{ $teacher->is_active == 1 ? 'selected' : '' }}>Active
                                </option>
                                <option value="0" {{ $teacher->is_active == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select the teacher's enrollment status.
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

<!-- Scripts -->
@push('scripts')
    <script>
        // Add event listener to the form submit event
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("updateForm").addEventListener("submit", function(event) {
                // Display confirmation dialog before submitting the form
                if (!confirm("Are you sure you want to update this teacher?")) {
                    event.preventDefault(); // Prevent form submission if user cancels
                }
            });
        });
    </script>
@endpush
