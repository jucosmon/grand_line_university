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
                        <p><strong>teacher ID:</strong> {{ $teacher->id }} </p>
                        <p><strong>Name:</strong> {{ $teacher->first_name }} {{ $teacher->middle_initial }}
                            {{ $teacher->last_name }}
                        </p>
                        <p><strong>Email:</strong> {{ $teacher->email }} </p>
                        <p><strong>Status:</strong> {{ $teacher->is_active ? 'Active' : 'Inactive' }}</p>
                        <p><strong>Degree:</strong> {{ $teacher->degree }}
                        <p>
                        <p><strong>Sex:</strong> {{ $teacher->sex }} </p>
                    </div>

                    @if (Auth::user() && Auth::user()->id == $teacher->id)
                        <div class="row justify-content-end">
                            <div class="col-md-6">
                                <a href="{{ route('teacher.edit_profile_form', $teacher->id) }}"
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
