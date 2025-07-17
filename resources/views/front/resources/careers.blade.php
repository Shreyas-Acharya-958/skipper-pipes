@extends('front.layouts.app')
@section('styles')
    <style>
        .error {
            color: red;
            font-size: 12px;
            margin-top: 5px;
        }
    </style>
@endsection
@section('content')
    @if ($careers)
        <!-- Hero banner-section -->
        <section class="hero-banner2">
            <div class="hero-banner2-bg">
                @if (!empty($careers->images) && isset($careers->images[0]))
                    <img src="{{ asset('storage/' . $careers->images[0]) }}" alt="">
                @endif
            </div>
            <div class="hero-banner2-overlay"></div>
            <div class="hero-banner2-content">
                <h1>{{ $careers->title }}</h1>
                <p>{{ $careers->description }}</p>
            </div>
        </section>

        <section class="hero-banner2-responsive">
            <div class="hero-banner2-content-responsive">
                <h1>{{ $careers->title }}</h1>
                <p>{{ $careers->description }}</p>
            </div>
            <div class="hero-banner2-img-responsive">
                @if (!empty($careers->images) && isset($careers->images[0]))
                    <img src="{{ asset('storage/' . $careers->images[0]) }}" alt="">
                @endif
            </div>
        </section>
        <!-- Hero banner-section ends -->
    @endif
    <!-- Why Skipper Section -->
    @if ($career_why_skippers)
        <section class=" default-padding">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="site-heading text-center">
                            <h4>Why Skipper</h4>
                            <h2>Powered by People, Driven by Purpose</h2>
                        </div>
                    </div>
                </div>
                <div class="row align-center">
                    <div class="col-md-6">
                        @if ($career_why_skippers->images)
                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

                                <ol class="carousel-indicators">
                                    @foreach ($career_why_skippers->images as $image)
                                        <li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->index }}"
                                            class="{{ $loop->first ? 'active' : '' }}"></li>
                                    @endforeach
                                </ol>
                                <div class="carousel-inner">
                                    @foreach ($career_why_skippers->images as $image)
                                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                            <img class="d-block w-100" src="{{ asset('storage/' . $image) }}"
                                                alt="First slide">
                                        </div>
                                    @endforeach
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                    data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                    data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-6 pt-3 pt-md-0">
                        <!-- <h2>Product Overview</h2> -->
                        <p>{{ $career_why_skippers->description }}</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- Why Skipper Section ends -->
    @endif
    @if ($career_life_at_skippers)
        <!-- Life at Skipper section -->
        <section class="left-img-col default-padding bg-gray">
            <div class="container py-5">
                <div class="row">
                    <div class="col-12 text-center">
                        <div class="site-heading text-center">
                            <h4>Life at Skipper</h4>
                            <h2>Culture That Builds Careers</h2>
                        </div>
                    </div>
                </div>

                <div class="row align-items-center text-center text-md-left">
                    <!-- LEFT: Tab Content -->
                    <div class="col-lg-4 col-md-6 skipper-tab-content-area order-3 order-md-2 order-lg-1 mt-4 mt-md-0">
                        @foreach ($career_life_at_skippers as $key => $item)
                            <div class="culture-tab-pane-content {{ $loop->first ? '' : 'd-none' }}"
                                id="content-{{ $key }}">
                                <p>{{ $item->description }}</p>
                            </div>
                        @endforeach
                    </div>

                    <!-- CENTER: Tabs -->
                    <div class="col-lg-3 col-md-12 order-1 order-lg-2 mb-md-4 mb-lg-0">
                        <div class="nav flex-column nav-pills culture-tab-buttons" role="tablist">
                            @foreach ($career_life_at_skippers as $key => $item)
                                <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-target="{{ $key }}">
                                    {{ $item->title }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- RIGHT: Tab Images -->
                    <div class="col-lg-5 col-md-6 tab-image-area order-2 order-md-3 order-lg-3">
                        @foreach ($career_life_at_skippers as $key => $item)
                            <img src="{{ asset('storage/' . $item->image) }}"
                                class="img-fluid shadow culture-tab-image {{ $loop->first ? '' : 'd-none' }}"
                                id="img-{{ $key }}" alt="{{ $item->title }}">
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        <!-- Life at Skipper section ends -->

        <!-- OPTIONAL: Tab Switch Script -->
    @endif
    <!-- What we offer section  -->
    @if ($career_skipper_pipes)
        <section class="company-icon-sec default-padding">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <div class="site-heading headings">
                            <h4>Skipper Pipes</h4>
                            <h2>What We Offer</h2>
                        </div>
                    </div>
                </div>
                <div class="row philosophy-wrapper text-center px-3 px-md-0">
                    @foreach ($career_skipper_pipes as $item)
                        <div class="col-md-4 col-md company-icon-col">
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}">
                            <h4>{{ $item->title }}</h4>
                            <p>{{ $item->description }}</p>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>
    @endif
    <!-- What we offer section ends -->

    <!-- Apply online form -->
    <section class="career-form-sec default-padding bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="site-heading text-center">
                        <h4>Skipper Pipes</h4>
                        <h2>Apply Online</h2>
                        <p>If you're passionate about infrastructure, innovation, and impact — we would love to hear from
                            you.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <form id="careerForm" action="{{ route('front.careers.store') }}" method="post"
                        class="career-application-form" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="full-name">Name</label>
                                <input type="text" class="form-control" id="full-name" name="name" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="subject">Subject</label>
                                <input type="text" class="form-control" id="subject" name="subject">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="phone">Mobile Number</label>
                                <input type="tel" class="form-control" id="phone" name="phone" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="dob">Date of Birth</label>
                                <input type="date" class="form-control" id="dob" name="dob">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12 form-resume-upload">
                                <label for="resume">Upload Resume</label>
                                <input type="file" class="form-control" id="resume" name="resume" required>
                            </div>
                            <div class="form-group col-md-12 form-address">
                                <label for="address">Address</label>
                                <textarea name="address" id="address" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-dark theme theme2 btn-md mt-2">Submit Application</button>
                    </form>

                </div>
            </div>
        </div>
    </section>
    <!-- Apply online form ends -->


    <!-- product cta -->
    <section class="product-cta bg-theme text-white default-padding">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h2 class="text-white mb-2">Join Skipper Pipes as a dealer or distributor and </h2>
                    <p class="text-white mb-md-4 pb-md-2">Unlock business growth with trusted products, strong support, and
                        nationwide reach.</p>
                    <a class="btn btn-light effect btn-md mb-3 mb-md-0" href="#">Become Dealer</a>
                    <a class="btn btn-light effect btn-md ml-md-3" href="#">Become Distributor</a>
                </div>
            </div>
        </div>
    </section>
    <!-- product cta ends -->
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.culture-tab-buttons .nav-link');
            const contents = document.querySelectorAll('.culture-tab-pane-content');
            const images = document.querySelectorAll('.culture-tab-image');

            tabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    // Remove active class from all tabs
                    tabs.forEach(t => t.classList.remove('active'));
                    tab.classList.add('active');

                    const target = tab.getAttribute('data-target');

                    // Show content
                    contents.forEach(c => {
                        c.classList.toggle('d-none', c.id !== `content-${target}`);
                    });

                    // Show image
                    images.forEach(img => {
                        img.classList.toggle('d-none', img.id !== `img-${target}`);
                    });
                });
            });
        });


        $(document).ready(function() {
            $('#careerForm').validate({
                rules: {
                    name: {
                        required: true
                    },
                    email: {
                        email: true
                    },
                    phone: {
                        required: true
                    },
                    resume: {
                        required: true
                    }
                },
                submitHandler: function(form) {
                    // Show loading state
                    Swal.fire({
                        title: 'Submitting...',
                        text: 'Please wait while we process your application.',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    let formData = new FormData(form);

                    $.ajax({
                        url: "{{ route('front.careers.store') }}",
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Application Submitted!',
                                text: response.message ||
                                    'Your application has been submitted successfully!',
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#28a745'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    form.reset();
                                    // Reset form validation
                                    $('#careerForm').validate().resetForm();
                                    // Remove any validation classes
                                    $('#careerForm .form-control').removeClass(
                                        'is-valid is-invalid');
                                }
                            });
                        },
                        error: function(xhr) {
                            let message = 'Something went wrong. Please check your inputs.';
                            if (xhr.responseJSON?.errors) {
                                message = Object.values(xhr.responseJSON.errors).join(' ');
                            } else if (xhr.responseJSON?.message) {
                                message = xhr.responseJSON.message;
                            }

                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: message,
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#dc3545'
                            });
                        }
                    });

                    return false;
                }
            });
        });
    </script>
@endsection
