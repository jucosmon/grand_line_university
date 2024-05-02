@extends('layout.layout')

@section('content')
    <!-- ***** Main Banner Area Start ***** -->
    <section class="section main-banner" id="top" data-section="section1">
        <video autoplay muted loop id="bg-video">
            <source src="assets/images/course-video.mp4" type="video/mp4" />
        </video>

        <div class="video-overlay header-text">
            <div class="caption">
                <h6>Management Information System</h6>
                <h2><em>Grand Line</em> University</h2>
                <div class="main-button">
                    <div class="scroll-to-section"><a href="#section4">Welcome Administrator</a></div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Main Banner Area End ***** -->
    <section class="features">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-12">
                    <div class="features-post">
                        <div class="features-content">
                            <div class="content-show">
                                <h4><i class="fa fa-pencil"></i>All Courses</h4>
                            </div>
                            <div class="content-hide">
                                <p>Embark on a journey of academic excellence at Grand Line University, where a rich
                                    tapestry of courses awaits eager minds, offering a vast array of opportunities for
                                    growth and learning./p>
                                <div class="scroll-to-section"><a href="#section2">More Info.</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="features-post second-features">
                        <div class="features-content">
                            <div class="content-show">
                                <h4><i class="fa fa-graduation-cap"></i>Virtual Class</h4>
                            </div>
                            <div class="content-hide">
                                <p>Discover boundless possibilities in our virtual classrooms at Grand Line University,
                                    where dynamic learning environments foster engagement and collaboration.</p>

                                <div class="scroll-to-section"><a href="#section2">Details</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="features-post third-features">
                        <div class="features-content">
                            <div class="content-show">
                                <h4><i class="fa fa-book"></i>Real Meeting</h4>
                            </div>
                            <div class="content-hide">
                                <p>Elevate your learning experience with real-time meetings at Grand Line University, where
                                    interactive discussions and expert guidance propel your academic journey forward.</p>
                                <div class="scroll-to-section"><a href="#section4">More Info</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section courses" data-section="section4">
        <style>
            /* Custom CSS for margin between rows */
            .custom-card-row {
                display: flex;
                flex-wrap: wrap;
                margin: -15px 0;
            }

            .custom-card-col {
                flex: 0 0 calc(25% - 30px);
                /* Adjust the width of each card column */
                margin: 15px 0;
                padding: 0 15px;
            }

            .card {
                width: 100%;
            }
        </style>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading">
                        <h2>Admin Management</h2>
                    </div>
                </div>
            </div>
            <div class="custom-card-row justify-content-center">
                <div class="custom-card-col">
                    <div class="card rounded">
                        <img src="assets/images/courses-01.jpg" class="card-img-top" alt="Course #1">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title flex-fill">Department</h5>
                            <p class="card-text flex-fill">Manage your school's department efficiently.</p>
                            <a href="{{ route('department.manage') }}" class="btn btn-sm btn-warning align-self-end">Manage
                                <i class="fa fa-angle-double-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- Add similar code blocks for other cards -->
                <div class="custom-card-col">
                    <div class="card rounded">
                        <img src="assets/images/courses-01.jpg" class="card-img-top" alt="Course #1">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title flex-fill">Program</h5>
                            <p class="card-text flex-fill">Manage your school's programs efficiently.</p>
                            <a href="{{ route('program.manage') }}" class="btn btn-sm btn-warning align-self-end">Manage
                                <i class="fa fa-angle-double-right"></i></a>
                        </div>
                    </div>
                </div>

                <div class="custom-card-col">
                    <div class="card rounded">
                        <img src="assets/images/courses-01.jpg" class="card-img-top" alt="Course #1">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title flex-fill">Teacher</h5>
                            <p class="card-text flex-fill">Manage your school's teaching staff efficiently.</p>
                            <a href="{{ route('teacher.manage') }}" class="btn btn-sm btn-warning align-self-end">Manage
                                <i class="fa fa-angle-double-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="custom-card-col">
                    <div class="card rounded">
                        <img src="assets/images/courses-02.jpg" class="card-img-top" alt="Course #2">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title flex-fill">Student</h5>
                            <p class="card-text flex-fill">Organize student information effectively.</p>
                            <a href="{{ route('student.manage') }}" class="btn btn-sm btn-warning align-self-end">Manage
                                <i class="fa fa-angle-double-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="custom-card-col">
                    <div class="card rounded">
                        <img src="assets/images/courses-03.jpg" class="card-img-top" alt="Course #3">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title flex-fill">Subject</h5>
                            <p class="card-text flex-fill">Plan and manage subject information seamlessly.</p>
                            <a href="{{ route('subject.manage') }}" class="btn btn-sm btn-warning align-self-end">Manage
                                <i class="fa fa-angle-double-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="custom-card-col">
                    <div class="card rounded">
                        <img src="assets/images/courses-01.jpg" class="card-img-top" alt="Course #1">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title flex-fill">Subject Offering</h5>
                            <p class="card-text flex-fill">Manage your school's course offering.</p>
                            <a href="{{ route('subject_offering.manage') }}"
                                class="btn btn-sm btn-warning align-self-end">Manage
                                <i class="fa fa-angle-double-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="custom-card-col">
                    <div class="card rounded">
                        <img src="assets/images/courses-01.jpg" class="card-img-top" alt="Course #1">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title flex-fill">Enrollment</h5>
                            <p class="card-text flex-fill">Manage your school's enrollment.</p>
                            <a href="" class="btn btn-sm btn-warning align-self-end">Manage
                                <i class="fa fa-angle-double-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
