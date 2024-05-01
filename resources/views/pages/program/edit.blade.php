@extends('layout.layout')

@section('content')
    <section class="section contact" data-section="section6" style="background-color: #132c33; color: white;">
        <div class="container">


            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="section-heading">

                        <h2>Edit Program</h2>
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
                    <form id="updateForm" action="{{ route('program.update', $program->id) }}" method="POST"
                        class="custom-form">
                        @csrf
                        @method('PUT')
                        {{-- Cancel Button --}}
                        <div class="mb-3">
                            <a href="{{ route('program.manage') }}" class="btn btn-secondary">
                                <i class="bi bi-x-lg"></i>
                            </a>
                        </div>
                        <div class="mb-3">
                            <label for="code" class="form-label">Program Code</label>
                            <input type="text" class="form-control" id="code" name="code"
                                value="{{ $program->code }}" required>
                            <div class="invalid-feedback">
                                Please enter the program's code e.g. BSIT.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Program Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $program->name }}" required>
                            <div class="invalid-feedback">
                                Please enter the program's name e.g. Bachelor of Science in Information Technology.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="department_id" class="form-label">Department</label>
                            <select class="form-select" id="department_id" name="department_id" required>
                                <option value="">Select Department</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}"
                                        {{ $program->department_id == $department->id ? 'selected' : '' }}>
                                        {{ $department->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Please select the program's department.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="is_active" class="form-label">Active Status</label>
                            <select class="form-select" id="is_active" name="is_active" required>
                                <option value="">Select</option>
                                <option value="1" {{ $program->is_active == 1 ? 'selected' : '' }}>Active
                                </option>
                                <option value="0" {{ $program->is_active == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select the program's status.
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
                if (!confirm("Are you sure you want to update this program?")) {
                    event.preventDefault(); // Prevent form submission if user cancels
                }
            });
        });
    </script>
@endpush
