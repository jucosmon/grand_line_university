@extends('layout.layout')

@section('content')
    <section class="section contact" data-section="section6" style="background-color: #132c33; color: white;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="section-heading">
                        <h2>Edit Subject</h2>
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
                    <form id="updateForm" action="{{ route('subject.update', $subject->id) }}" method="POST"
                        class="custom-form">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="code" class="form-label">Subject Code</label>
                            <input type="text" class="form-control" id="code" name="code"
                                value="{{ $subject->code }}" required>
                            <div class="invalid-feedback">
                                Please enter the subject code.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Subject Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $subject->name }}" required>
                            <div class="invalid-feedback">
                                Please enter the subject name.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3">{{ $subject->description }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="credits" class="form-label">Credits</label>
                            <input type="number" class="form-control" id="credits" name="credits"
                                value="{{ $subject->credits }}" required>
                            <div class="invalid-feedback">
                                Please enter the credits for the subject.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="prerequisites" class="form-label">Prerequisites</label>
                            <input type="text" class="form-control" id="prerequisites" name="prerequisites"
                                value="{{ $subject->prerequisites }}">
                        </div>
                        <div class="mb-3">
                            <label for="is_active" class="form-label">Status</label>
                            <select class="form-select" id="is_active" name="is_active" required>
                                <option value="">Select Status</option>
                                <option value="1" {{ $subject->is_active == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $subject->is_active == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select the status of the subject.
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                </div>

                </form>
            </div>
        </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Add event listener to the form submit event
            document.getElementById("updateForm").addEventListener("submit", function(event) {
                // Display confirmation dialog before submitting the form
                if (!confirm("Are you sure you want to update this subject?")) {
                    event.preventDefault(); // Prevent form submission if user cancels
                }
            });
        });
    </script>
@endpush
