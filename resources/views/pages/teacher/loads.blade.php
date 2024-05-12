@extends('layout.layout')

@section('content')
    <section class="section why-us" data-section="section2">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading">
                        <h2>Current Loads</h2>
                    </div>
                </div>
                <div class="card-body">
                    @if ($currentSections->isNotEmpty())
                        <table class="table" style="color: white;">
                            <thead>
                                <tr>
                                    <th>Subject</th>
                                    <th>Section</th>
                                    <th>Program & Year</th>
                                    <th>Schedule</th>
                                    <th>Room</th>
                                    <th>Capacity</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($currentSections as $section)
                                    <tr>

                                        <td>{{ $section->subject_offering->subject->code }}</td>
                                        <td>{{ $section->section_number }}</td>
                                        <td>{{ $section->subject_offering->program->code }}
                                            {{ $section->subject_offering->year_level }}</td>

                                        <td>{{ $section->schedule }}</td>
                                        <td>{{ $section->room }}</td>
                                        <td> {{ $section->student_count }}/{{ $section->capacity }}

                                        </td>
                                        </td>

                                        <td>
                                            <form
                                                action="{{ route('teacher.section.students', ['section_id' => $section->id]) }}"
                                                method="GET">
                                                @csrf
                                                <button type="submit" class="btn btn-primary">View Students</button>
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-center text-white">No current loads found.</p>
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
                        <h2>Past Loads</h2>
                    </div>
                </div>
                <div class="card-body">
                    @if ($pastSections->isNotEmpty())
                        <table class="table" style="color: white;">
                            <thead>
                                <tr>
                                    <th>Subject</th>
                                    <th>Section</th>
                                    <th>Program & Year</th>
                                    <th>Term Offered</th>
                                    <th>Schedule</th>
                                    <th>Room</th>
                                    <th>Capacity</th>
                                    <th>Teacher</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pastSections as $section)
                                    <tr>

                                        <td>{{ $section->subject_offering->subject->code }}</td>
                                        <td>{{ $section->section_number }}</td>
                                        <td>{{ $section->subject_offering->program->code }}
                                            {{ $section->subject_offering->year_level }}</td>
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
                                                action="{{ route('teacher.section.students', ['section_id' => $section->id]) }}"
                                                method="GET">
                                                @csrf
                                                <button type="submit" class="btn btn-primary">View Students</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-center text-white">No past loads found.</p>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
