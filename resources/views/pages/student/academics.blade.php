@extends('layout.layout')

@section('content')
    @isset($student)
        <section class="section why-us" data-section="section2">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-heading">
                            <h2>Past Enrollments</h2>
                        </div>
                    </div>

                    <div class="card-body">
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
                                        @if ($section->subject_offering->term->status == 'done')
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
                                                        action="{{ route('student.enrollment.delete', ['student_id' => $student->id, 'section_id' => $section->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Unenroll</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="text-center text-white" style="margin-bottom: 27%">No past enrollments found.</p>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    @endisset
@endsection
