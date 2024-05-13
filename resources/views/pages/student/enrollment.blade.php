@extends('layout.layout')

@section('content')

    @isset($student)
        @if ($student->is_active == 0)
            <div class="row justify-content-center">
                <div class="section-heading">
                    <h2>Cannot access enrollment because you're not enrolled for this term.</h2>
                </div>
            </div>
        @endif
        @if ($student->is_active == 1)
            <section class="section why-us" data-section="section2">
                <div class="container">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="section-heading">
                                <h2>Enrollment Page</h2>
                            </div>
                        </div>

                        <div class="card-body">
                            @if (session()->has('error'))
                                <div class="row mb-5 justify-content-center">
                                    <div class="col-md-6 m-lg-4">
                                        <div class="alert alert-danger text-center">
                                            {{ session()->get('error') }}
                                        </div>
                                    </div>
                                </div>
                            @endif
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
                                            @if ($section->subject_offering->term->status == 'active')
                                                <tr>

                                                    <td>{{ $section->subject_offering->subject->code }}</td>
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
                                                        <form
                                                            action="{{ route('student.enrollment.delete', ['section_id' => $section->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Unenroll</button>
                                                        </form>
                                                    </td>
                                                @else
                                                    <p class="text-center text-white">You haven't enrolled any subject for this
                                                        sem</p>

                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p class="text-center text-white">You haven't enrolled any subjects.</p>
                            @endif
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
                                    students: </h2>
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
                                                    @if ($availableSections->has($subjectOffering->id) && $availableSections[$subjectOffering->id]->isNotEmpty())
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
                                                                        <td>{{ $subjectOffering->subject->code }}</td>
                                                                        <td>{{ $section->section_number }}</td>
                                                                        <td>{{ $section->subject_offering->term->academic_year }}
                                                                            (@if ($section->subject_offering->term->semester == '1st')
                                                                                1st Semester
                                                                            @elseif ($section->subject_offering->term->semester == '2nd')
                                                                                2nd Semester
                                                                            @else
                                                                                Summer
                                                                            @endif)
                                                                        </td>
                                                                        <td>{{ $section->schedule }}</td>
                                                                        <td>{{ $section->room }}</td>
                                                                        <td>{{ $section->capacity }}</td>
                                                                        <td>{{ $section->teacher->first_name }}
                                                                            {{ $section->teacher->last_name }}</td>
                                                                        <td>
                                                                            <form action="{{ route('student.enroll') }}"
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
                                                        <p>No available sections for enrollment.</p>
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
