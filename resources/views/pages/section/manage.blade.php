@extends('layout.layout')

@section('content')
    <div class="container-fluid py-4 nav-covered-area" style="background-color: #f8f9fa; color: #212529;">

        <h1 class="text-center mb-3">Manage Sections </h1>


        <div class="row justify-content-center">

            <div class="col-md-10">
                {{-- Cancel Button --}}
                <div class="d-flex justify-content-lg-start mt-3 mb-3">
                    <a href="{{ route('subject_offering.manage') }}" class="btn btn-secondary">
                        <i class="bi bi-x-lg"></i> Back
                    </a>
                </div>
                <div class="table-responsive" style="max-height: 60vh; overflow-y: auto;">
                    <table class="table table-striped table-bordered table-hover" style="color: #212529;">
                        <thead class="thead-light">
                            <tr>
                                <th>Subject Code</th>
                                <th>Section Number</th>
                                <th>Academic Year & Semester</th>
                                <th>Program & Year</th>
                                <th>Schedule</th>
                                <th>Room</th>
                                <th>Capacity</th>
                                <th>Teacher Name</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Display sections --}}
                            @foreach ($sections as $section)
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

                                    <td>{{ $section->subject_offering->program->code }}
                                        {{ $section->subject_offering->year_level }}</td>

                                    <td>{{ $section->schedule }}</td>
                                    <td>{{ $section->room }}</td>
                                    <td>{{ $section->capacity }}</td>
                                    <td>{{ $section->teacher->first_name }} {{ $section->teacher->middle_initial }}
                                        {{ $section->teacher->last_name }}</td>
                                    <td>
                                        <a href="{{ route('subject_offering.section.edit_page', $section->id) }}"
                                            class="btn btn-warning">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                    </td>
                                    <td>
                                        <form action="{{ route('subject_offering.section.delete', $section->id) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this section?');">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>

                                </tr>
                            @endforeach

                            {{-- Add empty rows to fill up --}}
                            @for ($i = count($sections); $i < 10; $i++)
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-end mt-3">
                    <a href="{{ route('subject_offering.section.add_page', ['id' => $subject_offering->id]) }}"
                        class="btn btn-primary">Add Section</a>
                </div>
            </div>
        </div>
    </div>
@endsection
