@extends('layout.layout')

@section('content')
    <div class="container-fluid py-4 nav-covered-area" style="background-color: #f8f9fa; color: #212529;">
        <h1 class="text-center mb-3">Manage Subjects</h1>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="table-responsive" style="max-height: 60vh; overflow-y: auto;">
                    <table class="table table-striped table-bordered table-hover" style="color: #212529;">
                        <thead class="thead-light">
                            <tr>
                                <th>Subject Code</th>
                                <th>Subject Name</th>
                                <th>Description</th>
                                <th>Credits</th>
                                <th>Status</th>
                                <th>Pre-requisites</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Display up to 10 subjects --}}
                            @foreach ($subjects as $subject)
                                <tr>
                                    <td>{{ $subject['code'] }}</td>
                                    <td>{{ $subject['name'] }}</td>
                                    <td>{{ $subject['description'] }}</td>
                                    <td>{{ $subject['credits'] }}</td>
                                    <td>{{ $subject['status'] }}</td>
                                    <td>{{ $subject['prerequisites'] }}</td>
                                    <td>
                                        <a href="{{ route('subject.edit_page', $subject->id) }}" class="btn btn-warning">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{ route('subject.delete', $subject->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this subject?');">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            {{-- Add empty rows to fill up to 10 --}}
                            @for ($i = count($subjects); $i < 10; $i++)
                                <tr>
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
                    <a href="{{ route('subject.add_page') }}" class="btn btn-primary">Add Subject</a>
                </div>
            </div>
        </div>
    </div>
@endsection
