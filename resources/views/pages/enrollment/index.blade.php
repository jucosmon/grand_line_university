@extends('layout.layout')

@section('content')
ction('content')
    <div class="container-fluid py-4 nav-covered-area" style="background-color: #f8f9fa; color: #212529;">
        <h1 class="text-center mb-3">Enrollment Page</h1>
        <form action="{{ route('enrollment.search') }}" method="GET" class="mb-4">
            @csrf
            <div class="form-group">
                <label for="student_id">Student ID:</label>
                <input type="text" class="form-control" name="student_id" id="student_id" required>
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        @isset($student)
            <div class="bg-white p-4 mb-4">
                <h2>Student Information:</h2>
                <p><strong>Name:</strong> {{ $student->first_name }} {{ $student->last_name }}</p>
                <p><strong>Status:</strong> {{ $student->status }}</p>
                <p><strong>Program:</strong> {{ $student->program }}</p>
            </div>

            <div class="bg-white p-4 mb-4">
                <h2>Enrolled Sections:</h2>
                @if ($enrolledSections->isNotEmpty())
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Section Number</th>
                                <th>Schedule</th>
                                <th>Room</th>
                                <th>Capacity</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($enrolledSections as $section)
                                <tr>
                                    <td>{{ $section->section_number }}</td>
                                    <td>{{ $section->schedule }}</td>
                                    <td>{{ $section->room }}</td>
                                    <td>{{ $section->capacity }}</td>
                                    <td>
                                        <form action="{{ route('enrollment.delete', ['student_id' => $student->id, 'section_id' => $section->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No enrolled sections found.</p>
                @endif
            </div>

            <div class="bg-white p-4">
                <h2>Available Sections for Enrollment:</h2>
                @foreach ($availableSubjectOfferings as $subjectOffering)
                    <div class="card mb-4">
                        <div class="card-header">{{ $subjectOffering->subject->name }}</div>
                        <div class="card-body">
                            @if ($availableSections[$subjectOffering->id]->isNotEmpty())
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Section Number</th>
                                            <th>Schedule</th>
                                            <th>Room</th>
                                            <th>Capacity</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($availableSections[$subjectOffering->id] as $section)
                                            <tr>
                                                <td>{{ $section->section_number }}</td>
                                                <td>{{ $section->schedule }}</td>
                                                <td>{{ $section->room }}</td>
                                                <td>{{ $section->capacity }}</td>
                                                <td>
                                                    <form action="{{ route('enrollment.enroll') }}" method="GET">
                                                        @csrf
                                                        <input type="hidden" name="student_id" value="{{ $student->id }}">
                                                        <input type="hidden" name="section_id" value="{{ $section->id }}">
                                                        <button type="submit" class="btn btn-success">Enroll</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p>No available sections for enrollment.</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endisset
    </div>
@endsection
