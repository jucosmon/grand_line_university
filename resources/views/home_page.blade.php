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
                    <div class="scroll-to-section"><a href="#section2">Welcome</a></div>
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

    <section class="section why-us" data-section="section2">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading">
                        <h2>Why choose Grand Line University?</h2>
                    </div>
                </div>
                <div class="col-md-12">
                    <div id='tabs'>
                        <ul>
                            <li><a href='#tabs-1'>Best Education</a></li>
                            <li><a href='#tabs-2'>Top Management</a></li>
                            <li><a href='#tabs-3'>Quality Meeting</a></li>
                        </ul>
                        <section class='tabs-content'>
                            <article id='tabs-1'>
                                <div class="row">
                                    <div class="col-md-6">
                                        <img src="assets/images/choose-us-image-01.png" alt="">
                                    </div>
                                    <div class="col-md-6">
                                        <h4>Best Education</h4>
                                        <p>Grand Line University is where students embark on exciting educational journeys,
                                            inspired by the legendary Grand Line's spirit of adventure. Here, ambition
                                            thrives, and students are encouraged to explore their passions and unlock their
                                            full potential in a vibrant and supportive community.</p>
                                    </div>
                                </div>
                            </article>
                            <article id='tabs-2'>
                                <div class="row">
                                    <div class="col-md-6">
                                        <img src="assets/images/choose-us-image-02.png" alt="">
                                    </div>
                                    <div class="col-md-6">
                                        <h4>Top Level</h4>
                                        <p>At Grand Line University, excellence is not just a goal—it's a way of life. With
                                            a distinguished faculty and visionary leadership, the university sets the
                                            standard for academic excellence and innovation. From top-tier administrators to
                                            dedicated educators, every aspect of the institution is meticulously curated to
                                            ensure the highest quality of education and student experience.</p>
                                    </div>
                                </div>
                            </article>
                            <article id='tabs-3'>
                                <div class="row">
                                    <div class="col-md-6">
                                        <img src="assets/images/choose-us-image-03.png" alt="">
                                    </div>
                                    <div class="col-md-6">
                                        <h4>Quality Meeting</h4>
                                        <p>Grand Line University prides itself on providing top-notch resources and
                                            facilities, ensuring that every student has access to the tools they need to
                                            succeed. From state-of-the-art meeting rooms equipped with the latest technology
                                            to comprehensive research facilities, the university spares no effort in
                                            delivering a high-quality learning environment. With a commitment to excellence
                                            in every aspect, Grand Line University empowers students to thrive and excel in
                                            their academic pursuits.</p>
                                    </div>
                                </div>
                            </article>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="section courses" data-section="section4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading">
                        <h2>Admin Management</h2>
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-md-5 g-4">
                    <div class="col">
                        <div class="card rounded">
                            <img src="assets/images/courses-01.jpg" class="card-img-top" alt="Course #1">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title flex-fill">Teacher</h5>
                                <p class="card-text flex-fill">Manage your school's teaching staff efficiently.</p>
                                <a href="manage_teacher_page" class="btn btn-sm btn-warning align-self-end">Manage <i
                                        class="fa fa-angle-double-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card rounded">
                            <img src="assets/images/courses-02.jpg" class="card-img-top" alt="Course #2">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title flex-fill">Student</h5>
                                <p class="card-text flex-fill">Organize student information effectively.</p>
                                <a href="manage_student_page" class="btn btn-sm btn-warning align-self-end">Manage <i
                                        class="fa fa-angle-double-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card rounded">
                            <img src="assets/images/courses-03.jpg" class="card-img-top" alt="Course #3">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title flex-fill">Subject</h5>
                                <p class="card-text flex-fill">Plan and manage subject information seamlessly.</p>
                                <a href="manage_subject_page" class="btn btn-sm btn-warning align-self-end">Manage <i
                                        class="fa fa-angle-double-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card rounded">
                            <img src="assets/images/courses-04.jpg" class="card-img-top" alt="Course #4">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title flex-fill">Section</h5>
                                <p class="card-text flex-fill">Allocate and manage section information easily.</p>
                                <a href="#" class="btn btn-sm btn-warning align-self-end">Manage <i
                                        class="fa fa-angle-double-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card rounded">
                            <img src="assets/images/courses-05.jpg" class="card-img-top" alt="">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title flex-fill">Enrollment</h5>
                                <p class="card-text flex-fill">Simplify student enrollment processes efficiently.</p>
                                <a href="#" class="btn btn-sm btn-warning align-self-end">Manage <i
                                        class="fa fa-angle-double-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
