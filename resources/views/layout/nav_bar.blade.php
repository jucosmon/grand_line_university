<nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #152036;">
    <div class="container">
        <div
            style="color: #f5a425 !important; font-family: 'Montserrat', sans-serif; font-weight: bold; font-size: 28px;">
            <a href="/" aria-current="page">GLU MIS</a>
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav" style="font-family: 'Montserrat', sans-serif; font-weight: 600">
                <li class="nav-item">
                    <a class="nav-link text-light active" aria-current="page" href="/">Home</a>
                </li>

                <!-- ========== This part is for admin only ========== -->
                @if (session('user_type') === 'admin')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-light" href="#" id="menuDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Management
                        </a>
                        <div class="dropdown-menu" aria-labelledby="menuDropdown">
                            <a class="dropdown-item" href="{{ route('department.manage') }}">Department</a>
                            <a class="dropdown-item" href="{{ route('program.manage') }}">Program</a>
                            <a class="dropdown-item" href="{{ route('term.manage') }}">Term</a>

                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('teacher.manage') }}">Teacher</a>
                            <a class="dropdown-item" href="{{ route('student.manage') }}">Student</a>
                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item" href="{{ route('subject.manage') }}">Subject</a>
                            <a class="dropdown-item" href="{{ route('subject_offering.manage') }}">Subjects Offered &
                                Section</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('enrollment.index') }}">Enrollment</a>
                        </div>
                    </li>
                    <!-- ========== End of admin functionality ========== -->
                @elseif(session('user_type') === 'student')
                    <li class="nav-item">
                        <a class="nav-link text-light" href="{{ route('student.enrollment_page') }}">Enrollment</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="{{ route('student.academics') }}">Academics</a>
                    </li>
                @elseif(session('user_type') === 'teacher')
                    <li class="nav-item">
                        <a class="nav-link text-light" href="{{ route('teacher.loads') }}">Loads</a>
                    </li>
                @endif

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-light" href="#" id="menuDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Account
                    </a>
                    <div class="dropdown-menu" aria-labelledby="menuDropdown">
                        @if (session('user_type') === 'admin')
                            <a class="dropdown-item" href="{{ route('user.profile') }}">Profile</a>
                        @elseif(session('user_type') === 'student')
                            <a class="dropdown-item" href="{{ route('student.profile') }}">Profile</a>
                        @elseif(session('user_type') === 'teacher')
                            <a class="dropdown-item" href="{{ route('teacher.profile') }}">Profile</a>
                        @endif

                        <form action="{{ route('logout') }}" method="POST">
                            @csrf <!-- Include CSRF token -->
                            <button type="submit" class="dropdown-item">Logout</button>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
