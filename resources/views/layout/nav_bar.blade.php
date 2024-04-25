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
                    <a class="nav-link text-light" href="{{ route('teacher.manage') }}">Teacher</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="{{ route('student.manage') }}">Student</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="{{ route('subject.manage') }}">Subject</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="#">Room</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="#">Enrollment</a>
                </li>

            </ul>
        </div>
    </div>
</nav>
