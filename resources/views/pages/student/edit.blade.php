@extends('layout.layout')

@section('content')
    <section class="section contact" data-section="section6" style="background-color: #132c33; color: white;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="section-heading">
                        <h2>Edit Student</h2>
                    </div>
                    <form id="updateForm" action="{{ route('student.update', $student->id) }}" method="POST"
                        class="custom-form">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name"
                                value="{{ $student->first_name }}" required>
                            <div class="invalid-feedback">
                                Please enter the student's first name.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="middle_initial" class="form-label">Middle Initial</label>
                            <input type="text" class="form-control" id="middle_initial" name="middle_initial"
                                value="{{ $student->middle_initial }}" required>
                            <div class="invalid-feedback">
                                Please enter the student's middle initial.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name"
                                value="{{ $student->last_name }}" required>
                            <div class="invalid-feedback">
                                Please enter the student's last name.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="program_id" class="form-label">Program</label>
                            <select class="form-select" id="program_id" name="program_id" required>
                                <option value="">Select Program</option>
                                @foreach ($programs as $program)
                                    <option value="{{ $program->id }}" @if ($student->program_id == $program->id) selected @endif>
                                        {{ $program->name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Please select a program.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="year_level" class="form-label">Year Level</label>
                            <input type="number" class="form-control" id="year_level" name="year_level"
                                value="{{ $student->year_level }}" required>
                            <div class="invalid-feedback">
                                Please enter the student's year level.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="birthday" class="form-label">Birthday</label>
                            <input type="date" class="form-control" id="birthday" name="birthday"
                                value="{{ $student->birthday }}" required>
                            <div class="invalid-feedback">
                                Please enter the student's birthday.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="sex" class="form-label">Sex</label>
                            <select class="form-select" id="sex" name="sex" required>
                                <option value="">Select Sex</option>
                                <option value="F" {{ $student->sex == 'F' ? 'selected' : '' }}>Female</option>
                                <option value="M" {{ $student->sex == 'M' ? 'selected' : '' }}>Male</option>
                                <option value="O" {{ $student->sex == 'O' ? 'selected' : '' }}>Others</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select the student's sex.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="is_active" class="form-label">Currently Enrolled?</label>
                            <select class="form-select" id="is_active" name="is_active" required>
                                <option value="">Select</option>
                                <option value="1" {{ $student->is_active == 1 ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ $student->is_active == 0 ? 'selected' : '' }}>No</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select the student's enrollment status.
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
                if (!confirm("Are you sure you want to update this student?")) {
                    event.preventDefault(); // Prevent form submission if user cancels
                }
            });
        });
    </script>
@endpush
