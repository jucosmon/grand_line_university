@extends('layout.layout')

@section('content')
    <section class="section contact" data-section="section6" style="background-color: #132c33; color: white;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="section-heading">
                        <h2>Edit Term</h2>
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
                    <form id="updateForm" action="{{ route('term.update', $term->id) }}" method="POST" class="custom-form">
                        @csrf
                        @method('PUT')
                        {{-- Cancel Button --}}
                        <div class="mb-3">
                            <a href="{{ route('term.manage') }}" class="btn btn-secondary">
                                <i class="bi bi-x-lg"></i>
                            </a>
                        </div>
                        <div class="mb-3">
                            <label for="academic_year" class="form-label">Academic Year</label>
                            <select class="form-select" id="academic_year" name="academic_year" required>
                                <option value="2023-2024" {{ $term->academic_year === '2023-2024' ? 'selected' : '' }}>
                                    2023-2024</option>
                                <option value="2024-2025" {{ $term->academic_year === '2024-2025' ? 'selected' : '' }}>
                                    2024-2025</option>
                                <option value="2025-2026" {{ $term->academic_year === '2025-2026' ? 'selected' : '' }}>
                                    2024-2025</option>
                                <!-- Add more options as needed -->
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="semester" class="form-label">Semester</label>
                            <select class="form-select" id="semester" name="semester" required>
                                <option value="1st" {{ $term->semester === '1st' ? 'selected' : '' }}>1st</option>
                                <option value="2nd" {{ $term->semester === '2nd' ? 'selected' : '' }}>2nd</option>
                                <option value="summer" {{ $term->semester === 'summer' ? 'selected' : '' }}>Summer</option>
                                <!-- Add more options as needed -->
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date"
                                value="{{ $term->start_date }}">
                        </div>
                        <div class="mb-3">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" class="form-control" id="end_date" name="end_date"
                                value="{{ $term->end_date }}">
                        </div>
                        <div class="mb-3">
                            <label for="enroll_start" class="form-label">Enrollment Start</label>
                            <input type="date" class="form-control" id="enroll_start" name="enroll_start"
                                value="{{ $term->enroll_start }}">
                        </div>
                        <div class="mb-3">
                            <label for="enroll_end" class="form-label">Enrollment End</label>
                            <input type="date" class="form-control" id="enroll_end" name="enroll_end"
                                value="{{ $term->enroll_end }}">
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="upcoming" {{ $term->status === 'upcoming' ? 'selected' : '' }}>Upcoming
                                </option>
                                <option value="active" {{ $term->status === 'active' ? 'selected' : '' }}>Active</option>
                                <option value="done" {{ $term->status === 'done' ? 'selected' : '' }}>Done</option>
                                <!-- Add more options as needed -->
                            </select>
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
                if (!confirm("Are you sure you want to update this term?")) {
                    event.preventDefault(); // Prevent form submission if user cancels
                }
            });
        });
    </script>
@endpush
