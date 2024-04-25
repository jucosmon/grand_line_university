@extends('layout.layout')

@section('content')
    <div class="container-fluid py-4 nav-covered-area" style="background-color: #f8f9fa; color: #212529;">
        <h1 class="text-center mb-3">Manage Teachers</h1>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="table-responsive" style="max-height: 60vh; overflow-y: auto;">
                    <table class="table table-striped table-bordered table-hover" style="color: #212529;">
                        <thead class="thead-light">
                            <tr>
                                <th>Teacher ID</th>
                                <th>Teacher Name</th>
                                <th>Degree</th>
                                <th>Birthday</th>
                                <th>Sex</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Display up to 10 students --}}
                            @foreach ($teachers as $teacher)
                                <tr>
                                    <td>{{ $teacher['id'] }}</td>
                                    <td>{{ $teacher['first_name'] }} {{ $teacher['middle_initial'] }}
                                        {{ $teacher['last_name'] }}</td>
                                    <td>{{ $teacher['degree'] }}</td>
                                    <td>{{ $teacher['birthday'] }}</td>
                                    <td>{{ $teacher['sex'] }}</td>
                                    <td>{{ $teacher['email'] }}</td>
                                </tr>
                            @endforeach

                            {{-- Add empty rows to fill up to 10 --}}
                            @for ($i = count($teachers); $i < 10; $i++)
                                <tr>
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
                    <a href="{{ route('teacher.add_page') }}" class="btn btn-primary">Add Teacher</a>
                </div>
            </div>
        </div>
    </div>
@endsection
