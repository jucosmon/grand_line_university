@extends('layout.layout')

@section('content')
    <section class="section contact" data-section="section6" style="background-color: #132c33; color: white;">
        <div class="container">

            <div class="row justify-content-center align-items-center">
                <div class="col-md-6">
                    <div class="section-heading">
                        <h2>Profile:</h2>
                    </div>
                    <div class="mb-3" style="margin-right: 5%;margin-left:5%; margin:25%;">
                        <p><strong>Student ID:</strong> {{ $student->id }} </p>
                        <p><strong>Name:</strong> {{ $student->first_name }} {{ $student->middle_initial }}
                            {{ $student->last_name }}
                        </p>
                        <p><strong>Email:</strong> {{ $student->email }} </p>
                        <p><strong>Status:</strong> {{ $student->is_active ? 'Enrolled' : 'Unenrolled' }}</p>
                        <p><strong>Program & Year Level:</strong> {{ $student->program->code }}
                            {{ $student->year_level }}</p>
                        <p><strong>Sex:</strong> {{ $student->sex }} </p>
                    </div>

                    @if (Auth::user() && Auth::user()->id == $student->id)
                        <div class="row justify-content-end">
                            <div class="col-md-6">
                                <a href="{{ route('student.edit_profile_form', $student->id) }}"
                                    class="btn btn-primary">Edit
                                    Profile</a>

                            </div>
                        </div>
                    @endif

                </div>
            </div>

        </div>

        </div>
    </section>
@endsection
