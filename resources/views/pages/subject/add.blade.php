@extends('layout.layout')

@section('content')
    <section class="section contact" data-section="section6" style="background-color: #132c33; color: white;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="section-heading">
                        <h2>Add Subject</h2>
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
                    <form action="{{ route('subject.create') }}" method="get" class="custom-form">
                        @csrf
                        {{-- Cancel Button --}}
                        <div class="mb-3">
                            <a href="{{ route('subject.manage') }}" class="btn btn-secondary">
                                <i class="bi bi-x-lg"></i>
                            </a>
                        </div>
                        <div class="mb-3">
                            <label for="code" class="form-label">Subject Code</label>
                            <input type="text" class="form-control" id="code" name="code" required>
                            <div class="invalid-feedback">
                                Please enter the subject code.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Subject Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                            <div class="invalid-feedback">
                                Please enter the subject name.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                            <div class="invalid-feedback">
                                Please enter the description of the subject.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="credits" class="form-label">Credits</label>
                            <input type="number" class="form-control" id="credits" name="credits" required>
                            <div class="invalid-feedback">
                                Please enter the number of units of the subject.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="prerequisites" class="form-label">Pre-requisite</label>
                            <input type="text" class="form-control" id="prerequisites" name="prerequisites">
                            <div class="invalid-feedback">
                                Please enter the pre-requisite course of this subject if applicable.
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
