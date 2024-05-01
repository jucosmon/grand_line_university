@extends('layout.layout')

@section('content')
    <section class="section contact" data-section="section6" style="background-color: #132c33; color: white;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="section-heading">
                        <h2>Offer a New Subject</h2>
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
                    <form action="{{ route('subject_offering.create') }}" method="get" class="custom-form">
                        @csrf

                        {{-- Cancel Button --}}
                        <div class="mb-3">
                            <a href="{{ route('subject_offering.manage') }}" class="btn btn-secondary">
                                <i class="bi bi-x-lg"></i>
                            </a>
                        </div>
                        <div class="mb-3">
                            <label for="subject_id" class="form-label">Subject to be offered</label>
                            <select class="form-select" id="subject_id" name="subject_id" required>
                                <option value="">Select Subject</option>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Please select a subject.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="academic_year" class="form-label">Academic Year</label>
                            <input type="text" class="form-control" id="academic_year" name="academic_year" required>
                            <div class="invalid-feedback">
                                Please enter the what Academic Year the subject will be offered.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="semester" class="form-label">Semester</label>
                            <select class="form-select" id="semester" name="semester" required>
                                <option value="1">1st Semester</option>
                                <option value="2">2nd Semester</option>
                                <option value="3">Summer</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select the semester.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="program_id" class="form-label">Program</label>
                            <select class="form-select" id="program_id" name="program_id" required>
                                <option value="">Select Program</option>
                                @foreach ($programs as $program)
                                    <option value="{{ $program->id }}">{{ $program->name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Please select a program.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="year_level" class="form-label">Year Level</label>
                            <input type="number" class="form-control" id="year_level" name="year_level" required>
                            <div class="invalid-feedback">
                                Please enter what year level the subject will be offered.
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Add</button>

                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
