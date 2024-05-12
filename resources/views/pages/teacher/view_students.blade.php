@extends('layout.layout')

@section('content')
    <div class="container-fluid py-4 nav-covered-area" style="background-color: #f8f9fa; color: #212529;">
        <h1 class="text-center mb-3">{{ $section->subject_offering->subject->code }} Section
            {{ $section->section_number }}
            ({{ $section->subject_offering->term->academic_year }}
            @if ($section->subject_offering->term->semester == '1st')
                1st Semester
            @elseif ($section->subject_offering->term->semester == '2nd')
                2nd Semester
            @else
                Summer
            @endif
            )
        </h1>
        <div class="row justify-content-center">
            <div class="col-md-10">
                {{-- Cancel Button --}}
                <div class="d-flex justify-content-lg-start  mb-3">
                    <a href="{{ route('teacher.loads') }}" class="btn btn-secondary">
                        <i class="bi bi-x-lg"></i> Back
                    </a>
                </div>
                <div class="table-responsive" style="max-height: 60vh; overflow-y: auto;">
                    <table class="table table-striped table-bordered table-hover" style="color: #212529;">
                        <thead class="thead-light">
                            <tr>
                                <th>Student ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Sex</th>
                                <th>Program & Year Level</th>

                            </tr>
                        </thead>
                        <tbody>
                            {{-- Display students for the selected section --}}
                            @if ($students && count($students) > 0)
                                @foreach ($students as $student)
                                    <tr>
                                        <td>{{ $student->id }}</td>
                                        <td>{{ $student->first_name }} {{ $student->middle_initial }}
                                            {{ $student->last_name }}</td>
                                        <td>{{ $student->email }}</td>
                                        <td>{{ $student->is_active ? 'Enrolled' : 'Unenrolled' }}</td>
                                        <td>{{ $student->sex }}</td>

                                        <td>{{ $student->program->code }} {{ $student->year_level }}</td>

                                    </tr>
                                @endforeach
                                {{-- Add empty rows to fill up to 10 --}}
                                @for ($i = count($students); $i < 10; $i++)
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                @endfor
                            @else
                                {{-- Add empty rows to fill up to 10 --}}
                                @for ($i = 0; $i < 10; $i++)
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                @endfor
                            @endif
                        </tbody>


                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
