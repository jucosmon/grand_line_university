@extends('layout.layout')

@section('content')
    <section class="section contact" data-section="section6" style="background-color: #132c33; color: white;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="section-heading">
                        <h2>Add New Section</h2>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('subject_offering.section.create', ['id' => $subject_offering->id]) }}"
                        method="get" class="custom-form">
                        @csrf

                        {{-- Cancel Button --}}
                        <div class="mb-3">
                            <a href="{{ route('subject_offering.section.manage', ['id' => $subject_offering->id]) }}"
                                class="btn btn-secondary">
                                <i class="bi bi-x-lg"></i> Cancel
                            </a>
                        </div>
                        {{--
                    <div class="mb-3">
                        <label for="section_number" class="form-label">Section Number</label>
                        <input type="text" class="form-control" id="section_number" name="section_number" required>
                        <div class="invalid-feedback">
                            Please enter the section number.
                        </div>
                    </div>
                    --}}

                        <div class="mb-3">
                            <label for="teacher_id" class="form-label">Select Teacher</label>
                            <select class="form-select" id="teacher_id" name="teacher_id" required>
                                <option value="">Select Teacher</option>
                                @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->id }}">{{ $teacher->first_name }}
                                        {{ $teacher->middle_initial }} {{ $teacher->last_name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Please select a teacher.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="schedule" class="form-label">Schedule</label>
                            <input type="text" class="form-control" id="schedule" name="schedule" required>
                            <div class="invalid-feedback">
                                Please enter the schedule.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="room" class="form-label">Room</label>
                            <input type="text" class="form-control" id="room" name="room" required>
                            <div class="invalid-feedback">
                                Please enter the room.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="capacity" class="form-label">Capacity</label>
                            <input type="number" class="form-control" id="capacity" name="capacity">
                            <div class="invalid-feedback">
                                Please enter the capacity.
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Add Section</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
