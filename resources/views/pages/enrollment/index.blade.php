@extends('layout.layout')

@section('content')
    <section class="section contact" data-section="section6" style="background-color: #132c33; color: white;">
        <div class="container">
            <div class="row mb-5 justify-content-center">
                <div class="col-md-6 m-lg-4">
                    <div class="section-heading">
                        <h2>Enrollment Page</h2>
                    </div>

                    <form action="{{ route('enrollment.search') }}" method="GET" class="mb-4 custom-form">
                        @csrf

                        <div class="form-group">
                            <label for="student_id">Student ID:</label>
                            <input type="text" class="form-control" name="student_id" id="student_id" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Search</button>
                    </form>


                </div>
            </div>
            @if (session()->has('error'))
                <div class="row mb-5 justify-content-center">
                    <div class="col-md-6 m-lg-4">
                        <div class="alert alert-danger text-center">
                            {{ session()->get('error') }}
                        </div>
                    </div>
                </div>
            @endif
            @isset($student)
                <div class="row justify-content-center align-items-center">
                    <div class="col-md-6">
                        <div class="section-heading">
                            <h2>Student Information:</h2>
                        </div>

                        <div class="mb-3" style="margin-right: 5%;margin-left:5%; margin:10%;">
                            <p><strong>Student ID:</strong> {{ $student->id }} </p>
                            <p><strong>Name:</strong> {{ $student->first_name }} {{ $student->middle_initial }}
                                {{ $student->last_name }}
                            </p>
                            <p><strong>Email:</strong> {{ $student->email }} </p>
                            <p><strong>Status:</strong> {{ $student->is_active ? 'Enrolled' : 'Unenrolled' }}</p>
                            <p><strong>Program & Year Level:</strong> {{ $student->program->code }}
                                {{ $student->year_level }}</p>
                            <p><strong>Sex:</strong> {{ $student->sex }} </p>
                        </div>
                    </div>
                </div>
                @if ($student->is_active == 0)
                    <div class="row justify-content-center">
                        <div class="section-heading">
                            <h2>Cannot access enrollment because student isn't enrolled yet.</h2>
                        </div>
                    </div>
                @endif
            @endisset
        </div>
    </section>
    @isset($student)
        @if ($student->is_active == 1)
            <section class="section why-us" data-section="section2">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-heading">
                                <h2>Enrolled Subjects: </h2>
                            </div>
                        </div>
                        <div class="col-md-12">

                            <div class="row justify-content-center" style="color: #ffffff;">
                                <div class="col-md-10">

                                    @if ($enrolledSections->isNotEmpty())
                                        <table class="table" style="color: white;">
                                            <thead>
                                                <tr>
                                                    <th>Subject</th>
                                                    <th>Section</th>
                                                    <th>Term</th>
                                                    <th>Schedule</th>
                                                    <th>Room</th>
                                                    <th>Capacity</th>
                                                    <th>Teacher</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($enrolledSections as $section)
                                                    <tr>
                                                        <td>{{ $section->subject_offering->subject->code }}</td>
                                                        <td>{{ $section->section_number }}</td>
                                                        <td>{{ $section->subject_offering->term->academic_year }} &lpar;
                                                            @if ($section->subject_offering->term->semester == '1st')
                                                                1st Semester
                                                            @elseif ($section->subject_offering->term->semester == '2nd')
                                                                2nd Semester
                                                            @else
                                                                Summer
                                                            @endif
                                                            &rpar;
                                                        </td>
                                                        <td>{{ $section->schedule }}</td>

                                                        <td>{{ $section->room }}</td>
                                                        <td>{{ $section->capacity }}</td>
                                                        <td>{{ $section->teacher->first_name }}
                                                            {{ $section->teacher->middle_initial }}
                                                            {{ $section->teacher->last_name }}</td>

                                                        <td>
                                                            <form
                                                                action="{{ route('enrollment.delete', ['student_id' => $student->id, 'section_id' => $section->id]) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">Unenroll</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <p class="text-center">No enrolled subjects found for this term.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="section why-us" data-section="section2">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-heading">
                                <h2>Available subjects for {{ $student->program->code }} {{ $student->year_level }}
                                    students for Enrollment: </h2>
                            </div>
                        </div>
                        <div class="col-md-12">

                            <div class="row justify-content-center">
                                <div class="col-md-10">
                                    @if ($availableSubjectOfferings->isEmpty())
                                        <p class="text-center text-white">No available subjects for this term.</p>
                                    @else
                                        @foreach ($availableSubjectOfferings as $subjectOffering)
                                            <div class="card mb-4">
                                                <div class="card-header">{{ $subjectOffering->subject->name }}</div>
                                                <div class="card-body">
                                                    @if ($availableSections[$subjectOffering->id]->isNotEmpty())
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Subject</th>
                                                                    <th>Section</th>
                                                                    <th>Term</th>
                                                                    <th>Schedule</th>
                                                                    <th>Room</th>
                                                                    <th>Capacity</th>
                                                                    <th>Teacher</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($availableSections[$subjectOffering->id] as $section)
                                                                    <tr>
                                                                        <td>{{ $section->subject_offering->subject->code }}
                                                                        </td>
                                                                        <td>{{ $section->section_number }}</td>
                                                                        <td>{{ $section->subject_offering->term->academic_year }}
                                                                            &lpar;
                                                                            @if ($section->subject_offering->term->semester == '1st')
                                                                                1st Semester
                                                                            @elseif ($section->subject_offering->term->semester == '2nd')
                                                                                2nd Semester
                                                                            @else
                                                                                Summer
                                                                            @endif
                                                                            &rpar;
                                                                        </td>
                                                                        <td>{{ $section->schedule }}</td>

                                                                        <td>{{ $section->room }}</td>
                                                                        <td>{{ $section->capacity }}</td>
                                                                        <td>{{ $section->teacher->first_name }}
                                                                            {{ $section->teacher->middle_initial }}
                                                                            {{ $section->teacher->last_name }}</td>
                                                                        <td>
                                                                            <form action="{{ route('enrollment.enroll') }}"
                                                                                method="GET">
                                                                                @csrf
                                                                                <input type="hidden" name="student_id"
                                                                                    value="{{ $student->id }}">
                                                                                <input type="hidden" name="section_id"
                                                                                    value="{{ $section->id }}">
                                                                                <button type="submit"
                                                                                    class="btn btn-success">Enroll</button>
                                                                            </form>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    @else
                                                        <p>No available subjects for enrollment.</p>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
    @endisset

@endsection
