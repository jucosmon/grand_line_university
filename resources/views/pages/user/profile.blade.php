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
                        <p><strong>user ID:</strong> {{ $user->id }} </p>
                        <p><strong>Name:</strong> {{ $user->name }}</p>
                        <p><strong>Email:</strong> {{ $user->email }} </p>
                        <p><strong>Status:</strong> {{ $user->is_active ? 'Active' : 'Inactive' }}</p>
                    </div>

                    @if (Auth::user() && Auth::user()->id == $user->id)
                        <div class="row justify-content-end" style="margin-bottom: 20%; margin-top:5%;">
                            <div class="col-md-6">
                                <a href="{{ route('user.edit_profile_form', $user->id) }}" class="btn btn-primary">Edit
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
