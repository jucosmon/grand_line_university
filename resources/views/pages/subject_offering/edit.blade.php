@extends('layout.layout')

@section('content')
    <section class="section contact" data-section="section6" style="background-color: #132c33; color: white;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="section-heading">
                        <h2>Edit Subject Offered</h2>
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
                    <form id="updateForm" action="{{ route('subject_offering.update', $subject_offering->id) }}"
                        method="POST" class="custom-form">
                        @csrf
                        @method('PUT')
                        {{-- Cancel Button --}}
                        <div class="mb-3">
                            <a href="{{ route('subject_offering.manage') }}" class="btn btn-secondary">
                                <i class="bi bi-x-lg"></i>
                            </a>
                        </div>

                        <div class="mb-3">
                            <label for="subject_id" class="form-label">Program</label>
                            <select class="form-select" id="subject_id" name="subject_id" required>
                                <option value="">Select Subject</option>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}" @if ($subject_offering->subject_id == $subject->id) selected @endif>
                                        {{ $subject->code }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Please select the subject.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="term_id" class="form-label">Select Term</label>
                            <select class="form-select" id="term_id" name="term_id" required>
                                @foreach ($terms as $term)
                                    @if ($term->semester === '1st')
                                        <option value="{{ $term->id }}"
                                            @if ($subject_offering->term_id == $term->id) selected @endif>{{ $term->academic_year }}
                                            (1st Semester)
                                        </option>
                                    @elseif ($term->semester === '2nd')
                                        <option value="{{ $term->id }}"
                                            @if ($subject_offering->term_id == $term->id) selected @endif>{{ $term->academic_year }}
                                            (2nd Semester)</option>
                                    @else
                                        <option value="{{ $term->id }}"
                                            @if ($subject_offering->term_id == $term->id) selected @endif>{{ $term->academic_year }}
                                            (Summer)</option>
                                    @endif
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Please select the term.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="program_id" class="form-label">Program</label>
                            <select class="form-select" id="program_id" name="program_id" required>
                                <option value="">Select Program</option>
                                @foreach ($programs as $program)
                                    <option value="{{ $program->id }}" @if ($subject_offering->program_id == $program->id) selected @endif>
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
                                value="{{ $subject_offering->year_level }}" required>
                            <div class="invalid-feedback">
                                Please enter the offered subject's year level.
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
                if (!confirm("Are you sure you want to update this subject_offering?")) {
                    event.preventDefault(); // Prevent form submission if user cancels
                }
            });
        });
    </script>
@endpush
