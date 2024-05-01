@extends('layout.layout')

@section('content')
    <section class="section contact" data-section="section6" style="background-color: #132c33; color: white;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="section-heading">
                        <h2>Edit Department</h2>
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
                    <form id="updateForm" action="{{ route('department.update', $department->id) }}" method="POST"
                        class="custom-form">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="code" class="form-label">Department Code</label>
                            <input type="text" class="form-control" id="code" name="code"
                                value="{{ $department->code }}" required>
                            <div class="invalid-feedback">
                                Please enter the department's code.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Deparment Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $department->name }}" required>
                            <div class="invalid-feedback">
                                Please enter the department's name.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="is_active" class="form-label">Active Status</label>
                            <select class="form-select" id="is_active" name="is_active" required>
                                <option value="">Select</option>
                                <option value="1" {{ $department->is_active == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $department->is_active == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select the department's status.
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
                if (!confirm("Are you sure you want to update this department?")) {
                    event.preventDefault(); // Prevent form submission if user cancels
                }
            });
        });
    </script>
@endpush
