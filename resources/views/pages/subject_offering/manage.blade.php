@extends('layout.layout')

@section('content')
    <div class="container-fluid py-4 nav-covered-area" style="background-color: #f8f9fa; color: #212529;">
        <h1 class="text-center mb-3">Manage Subject Offerings</h1>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="table-responsive" style="max-height: 60vh; overflow-y: auto;">
                    <table class="table table-striped table-bordered table-hover" style="color: #212529;">
                        <thead class="thead-light">
                            <tr>
                                <th>Code</th>
                                <th>Subject</th>
                                <th>Academic Year & Semester Offered</th>
                                <th>Program & Year</th>
                                <th>Sections</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Display up to 10 subject_offerings --}}
                            @foreach ($subject_offerings as $subject_offering)
                                <tr>
                                    <td>{{ $subject_offering->subject->code }}</td>
                                    <td>{{ $subject_offering->subject->name }}</td>
                                    <td>{{ $subject_offering->term->academic_year }} &lpar;
                                        @if ($subject_offering->term->semester == '1st')
                                            1st Semester
                                        @elseif ($subject_offering->term->semester == '2nd')
                                            2nd Semester
                                        @else
                                            Summer
                                        @endif
                                        &rpar;
                                    </td>
                                    <td>{{ $subject_offering->program->code }} {{ $subject_offering->year_level }}</td>

                                    <td>
                                        <a href="{{ route('subject_offering.section.manage', $subject_offering->id) }}"
                                            class="btn btn-info">
                                            [ {{ $subject_offering->sections()->count() }} ]
                                        </a>
                                    </td>

                                    <td>
                                        <a href="{{ route('subject_offering.edit_page', $subject_offering->id) }}"
                                            class="btn btn-warning">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                    </td>
                                    <td>
                                        <form action="{{ route('subject_offering.delete', $subject_offering->id) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this subject_offering?');">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>



                                </tr>
                            @endforeach

                            {{-- Add empty rows to fill up to 10 --}}
                            @for ($i = count($subject_offerings); $i < 10; $i++)
                                <tr>
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
                    <a href="{{ route('subject_offering.add_page') }}" class="btn btn-primary">Offer New Subject</a>
                </div>
            </div>
        </div>
    </div>
@endsection
