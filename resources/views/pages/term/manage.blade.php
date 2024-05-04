@extends('layout.layout')

@section('content')
    <div class="container-fluid py-4 nav-covered-area" style="background-color: #f8f9fa; color: #212529;">
        <h1 class="text-center mb-3">Manage Terms</h1>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="table-responsive" style="max-height: 60vh; overflow-y: auto;">
                    <table class="table table-striped table-bordered table-hover" style="color: #212529;">
                        <thead class="thead-light">
                            <tr>
                                <th>Academic Year</th>
                                <th>Semester</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Enrollment Start</th>
                                <th>Enrollment End</th>
                                <th>Status</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Display up to 10 terms --}}
                            @foreach ($terms as $term)
                                <tr>
                                    <td>{{ $term->academic_year }}</td>
                                    <td>{{ $term->semester }}</td>
                                    <td>{{ $term->start_date }}</td>
                                    <td>{{ $term->end_date }}</td>
                                    <td>{{ $term->enroll_start }}</td>
                                    <td>{{ $term->enroll_end }}</td>
                                    <td>{{ $term->status }}</td>

                                    <td>
                                        <a href="{{ route('term.edit_page', $term->id) }}" class="btn btn-warning">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{ route('term.delete', $term->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this term?');">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            {{-- Add empty rows to fill up to 10 --}}
                            @for ($i = count($terms); $i < 10; $i++)
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
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end mt-3">
                    <a href="{{ route('term.add_page') }}" class="btn btn-primary">Add Term</a>
                </div>
            </div>
        </div>
    </div>
@endsection
