@extends('layout.layout')

@section('content')
    <div class="container-fluid py-4 nav-covered-area" style="background-color: #f8f9fa; color: #212529;">
        <h1 class="text-center mb-3">Manage Students</h1>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="d-flex justify-content-end mt-3 mb-lg-3">
                    <form action="{{ route('student.manage') }}" method="GET" class="d-flex">
                        @csrf

                        <div class="mr-2">
                            <select name="program" onchange="this.form.submit()" class="form-control">
                                <option value="view_all" {{ $selectedProgram == 'view_all' ? 'selected' : '' }}>View All
                                </option>
                                @foreach ($programs as $id => $name)
                                    <option value="{{ $id }}" {{ $selectedProgram == $id ? 'selected' : '' }}>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mr-2">
                            <select name="year" onchange="this.form.submit()" class="form-control">
                                <option value="view_all" {{ $selectedYear == 'view_all' ? 'selected' : '' }}>View All
                                </option>
                                @foreach ($years as $year)
                                    <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>


                <div class="table-responsive" style="max-height: 60vh; overflow-y: auto;">
                    <table class="table table-striped table-bordered table-hover" style="color: #212529;">
                        <thead class="thead-light">
                            <tr>
                                <th>Student ID</th>
                                <th>Student Name</th>
                                <th>Program & Year</th>
                                <th>Birthday</th>
                                <th>Sex</th>
                                <th>Email</th>
                                <th>Enrolled</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Display up to 10 students --}}
                            @foreach ($students as $student)
                                <tr>
                                    <td>{{ $student->id }}</td>
                                    <td>{{ $student->first_name }} {{ $student->middle_initial }}
                                        {{ $student->last_name }}
                                    </td>
                                    <td>{{ $student->program->code }} {{ $student->year_level }}</td>
                                    <td>{{ $student->birthday }}</td>
                                    <td>{{ $student->sex }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td>{{ $student->is_active ? 'Yes' : 'No' }}</td>
                                    <td>
                                        <a href="{{ route('student.edit_page', $student->id) }}" class="btn btn-warning">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                    </td>
                                    <td>
                                        <form action="{{ route('student.delete', $student->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this student?');">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>



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
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end mt-3">
                    <a href="{{ route('student.add_page') }}" class="btn btn-primary">Add Student</a>
                </div>
            </div>
        </div>
    </div>
@endsection
