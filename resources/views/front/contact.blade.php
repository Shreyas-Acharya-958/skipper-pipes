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
    <!-- Hero banner-section -->
    <section class="hero-banner2">
        <div class="hero-banner2-bg">
            <img src="assets/img/final/contact-hero-section1.jpg" alt="contact-us-banner">
        </div>
        <div class="hero-banner2-overlay"></div>
        <div class="hero-banner2-content">
            <h1>Contact Us</h1>
            <p>For assistance, dealership queries, technical support, or more details.</p>
        </div>
    </section>

    <section class="hero-banner2-responsive">
        <div class="hero-banner2-content-responsive">
            <h1>Contact Us</h1>
            <p>For assistance, dealership queries, technical support, or more details.</p>
        </div>
        <div class="hero-banner2-img-responsive">
            <img src="assets/img/final/blogs-banner1.jpg" alt="contact-us-banner">
        </div>
    </section>
    <!-- Hero banner-section ends -->

    <!-- Breadcrumb  -->
    <div class="breadcrumb-area bg-white">
        <div class="container">
            <div class="row">
                <div class="col-12 p-0">
                    <ul class="breadcrumb">
                        <li><a href="{{ url('/') }}"><i class="fas fa-home"></i> Home</a></li>
                        <li class="active">Contact Us</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <section class="map-wrapper default-padding bg-gray">
        <div class="container py-5">
            <div class="row" data-aos="fade-up" data-aos-duration="1000">
                <div class="col-12 text-center">
                    <div class="site-heading headings">
                        <h4>SKipper Pipes</h4>
                        <h2>Talk to Our Support Team</h2>
                    </div>
                </div>
            </div>
            <div class="row mt-5" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                <!-- Left: City List -->
                {!! $contact_us_section_one->section1 !!}

                <!-- Center: Location Details -->
                {!! $contact_us_section_one->section2 !!}

                <!-- Right: India Map -->
                {!! $contact_us_section_one->section3 !!}
            </div>
        </div>

        </div>

    </section>

    <section class="contact-details-wrapper default-padding ">
        <div class="container">
            <div class="row" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                {!! $contact_us_section_one->section4 !!}
                <div class="col-md-6 contact-details-form">
                    <form id="contactForm" class="partner-application-form">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="full-name">Name <span>*</span></label>
                                <input type="text" class="form-control" id="full-name" name="name" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="email">Email <span>*</span></label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="phone">Mobile Number <span>*</span></label>
                                <input type="tel" class="form-control" id="phone" name="phone" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="subject">Subject</label>
                                <input type="text" class="form-control" id="subject" name="subject">
                            </div>
                            <div class="form-group col-md-12 form-desc">
                                <label for="message">Message</label>
                                <textarea name="message" id="message" class="form-control" rows="3" required></textarea>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-dark theme theme2 btn-md mt-2">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#contactForm').validate({
                rules: {
                    name: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    phone: {
                        required: true
                    },
                    message: {
                        required: true
                    }
                },
                submitHandler: function(form) {
                    // Show loading state
                    Swal.fire({
                        title: 'Sending...',
                        text: 'Please wait while we send your message.',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    $.ajax({
                        url: "{{ route('front.contact.store') }}",
                        type: "POST",
                        data: $(form).serialize(),
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Message Sent!',
                                text: response.message ||
                                    'Thank you! We will contact you shortly.',
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#28a745'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    form.reset();
                                    // Reset form validation
                                    $('#contactForm').validate().resetForm();
                                    // Remove any validation classes
                                    $('#contactForm .form-control').removeClass(
                                        'is-valid is-invalid');
                                }
                            });
                        },
                        error: function(xhr) {
                            let message = 'An error occurred. Please try again.';
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
