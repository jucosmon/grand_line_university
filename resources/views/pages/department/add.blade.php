@extends('layout.layout')

@section('content')
    <section class="section contact" data-section="section6" style="background-color: #132c33; color: white;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="section-heading">
                        <h2>Add New Department</h2>
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
                    <form action="{{ route('department.create') }}" method="get" class="custom-form">
                        @csrf
                        <div class="mb-3">
                            <label for="code" class="form-label">Department Code</label>
                            <input type="text" class="form-control" id="code" name="code" required>
                            <div class="invalid-feedback">
                                Please enter the department code e.g COECS.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Department Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                            <div class="invalid-feedback">
                                Please enter the department code e.g College of Engineering....
                            </div>
                            <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
