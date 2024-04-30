@extends('layout.layout')

@section('content')
    <div class="card text-center">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="true" href="#">Teacher</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Student</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" aria-disabled="true" href="#">Department</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            @yield('card-body')
        </div>
    </div>
@endsection
