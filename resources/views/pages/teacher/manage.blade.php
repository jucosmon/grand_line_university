@extends('layout.layout')

@section('content')
    <div class="container-fluid py-4 nav-covered-area" style="background-color: #f8f9fa; color: #212529;">
        <h1 class="text-center mb-3">Manage Teachers</h1>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="d-flex justify-content-end mt-3 mb-lg-3">
                    <form action="{{ route('teacher.manage') }}" method="GET">
                        @csrf
                        <select name="department" onchange="this.form.submit()">
                            <option value="view_all" {{ $selectedDepartment == 'view_all' ? 'selected' : '' }}>View All
                            </option>
                            @foreach ($departments as $id => $code)
                                <option value="{{ $id }}" {{ $selectedDepartment == $id ? 'selected' : '' }}>
                                    {{ $code }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
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
                                <th>Department</th>
                                <th>Enrolled</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Display up to 10 teachers --}}
                            @foreach ($teachers as $teacher)
                                <tr>
                                    <td>{{ $teacher['id'] }}</td>
                                    <td>{{ $teacher['first_name'] }} {{ $teacher['middle_initial'] }}
                                        {{ $teacher['last_name'] }}</td>
                                    <td>{{ $teacher['degree'] }}</td>
                                    <td>{{ $teacher['birthday'] }}</td>
                                    <td>{{ $teacher['sex'] }}</td>
                                    <td>{{ $teacher['email'] }}</td>
                                    <td>{{ $teacher->department->code }}</td>

                                    <td>{{ $teacher->is_active ? 'Active' : 'Inactive' }}</td>
                                    <td>
                                        <a href="{{ route('teacher.edit_page', $teacher['id']) }}" class="btn btn-warning">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{ route('teacher.delete', $teacher['id']) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this teacher?');">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
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
