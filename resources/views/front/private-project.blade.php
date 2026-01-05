@extends('front.layouts.app')

@section('og-tags')
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="Skipper Pipes">
    <meta property="og:title" content="Private Projects by Skipper Pipes – CPVC, UPVC, HDPE & SWR Infrastructure Pipes">
    <meta property="og:description" content="Skipper Pipes Private Projects – contact experts for specialized piping systems, from plumbing to agriculture and infrastructure applications. Engineered for strength, durability, and leak-proof performance.">
    <meta property="og:image" content="{{ asset('assets/img/final2/private-project-og-img.jpg') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="Private Projects by Skipper Pipes – CPVC, UPVC, HDPE & SWR Infrastructure Pipes">
    <meta name="twitter:description" content="Skipper Pipes Private Projects – contact experts for specialized piping systems, from plumbing to agriculture and infrastructure applications. Engineered for strength, durability, and leak-proof performance.">
    <meta name="twitter:image" content="{{ asset('assets/img/final2/private-project-og-img.jpg') }}">

@endsection

@section('styles')
    <style>
        /* HERO SECTION */
        .pp-hero-sec {
            width: 100%;

        }

        .pp-hero-wrapper {
            position: relative;
            width: 100%;
            height: 70vh;
            overflow: hidden;
        }

        /* Background Image */
        .pp-hero-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .pp-hero-bg-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(20, 67, 114, 0.6);
            /* adjust darkness */
            z-index: 1;
        }


        .pp-hero-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: #fff;
            z-index: 2;
        }

        .pp-hero-content h1 {
            font-weight: 700;
            font-size: 68px;
            color: white;
        }

        .pp-hero-content p {
            font-size: 28px;
            color: white;
        }

        .pp-hero-content .contact-wrap {
            font-size: 24px;
            font-weight: 600;
        }

        .pp-hero-content .pp-contact {
            font-weight: 600;
            color: white;
            font-size: 24px;
        }

        /* FORM & PRODUCT RANGE SECTION */
        .pp-sec2 {
            position: relative;
        }

        .pp-sec2 h2 {
            font-weight: 700;
        }

        .pp-sec2 h3 {
            font-weight: 600;
            margin-bottom: 10px;
            font-size: 24px;
        }

        .pp-sec2 img {
            width: 300px;
        }



        .product-wrapper .product-col.first {
            padding: 30px 0;
            border-bottom: 1px solid #144372;
            border-top: 1px solid #144372;
        }

        .product-wrapper .product-col {
            padding: 30px 0;
            border-bottom: 1px solid #144372;
        }


        /* Enquire Form Column */
        .pp-form .partner-application-form {
            position: sticky;
            top: 115px;
        }

        html {
            scroll-behavior: smooth;
        }

        /* Back to top button */
        #scrollBtn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 999;

            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: none;

            background-color: #144372;
            color: #fff;
            font-size: 22px;
            cursor: pointer;

            display: none;
            align-items: center;
            justify-content: center;

            transition: opacity 0.3s ease, transform 0.3s ease;
        }

        #scrollBtn:hover {
            background-color: #0d3052;
            transform: translateY(-3px);
        }

        @media (max-width: 576px) {


            .pp-hero-wrapper {
                height: 65vh;
            }

            .pp-hero-content {
                width: 90%;

            }

            .pp-hero-content h1 {
                font-size: 48px;
            }

            .pp-hero-content p {
                font-size: 20px;
                color: white;
            }

            .pp-hero-content .pp-contact {
                font-weight: 600;
                font-size: 17px;
                margin-bottom: 5px;
            }

            .pp-hero-content .contact-wrap {
                font-size: 17px;
                font-weight: 600;
            }

            .pp-sec2 img {
                width: 100%;
            }

        }
    </style>
@endsection
@section('content')
    <section class="pp-hero-sec">
        <div class="container-fluid">
            <div class="row p-0">
                <div class="col-12 p-0">
                    <div class="pp-hero-wrapper">
                        <img src="{{ asset('assets/img/final2/private-project-hero-bg.jpg') }}" alt="Private Project Banner">
                        <div class="pp-hero-bg-overlay"></div>

                        <div class="pp-hero-content">
                            <h1>Private Projects</h1>
                            <p class="mb-2 mb-md-4">Contact for Requirements:</p>
                            <p class="pp-contact">Partha Sarathi Chakraborty</p>
                            <a class="pp-contact"
                                href="mailto:parthasarathi.c@skipperlimited.com">parthasarathi.c@skipperlimited.com</a>
                            <div class="mt-md-2 contact-wrap">
                                <a class="pp-contact" href="tel:+919147711352">+91 914-7711-352</a> /
                                <a class="pp-contact" href="tel:+919831495499">+91 9831-495-499</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pp-sec2 default-padding" id="product-range">
        <div class="container">
            <div class="row">
                <div class="col-md-7 order-2 order-md-1 pr-md-5" id="product-range">
                    <h2 class="mb-2">Skipper Pipes Products Range</h2>

                    <div class="product-wrapper">
                        <div class="product-col first mt-5">
                            <img src="{{ asset('assets/img/final2/Our-Product/OurProduct-CPVC.png') }}"
                                alt="CPVC Pipes and Fittings">
                            <h3 class="mt-4">CPVC Pipes and Fittings</h3>
                            <p>Skipper CPVC pipes are NSF-certified and 100% lead-free, making them one of the safest
                                plumbing solutions for modern water systems. Engineered for both hot and cold water
                                applications, they can reliably withstand temperatures up to 93°C, ensuring high thermal
                                stability and long-term performance.</p>
                        </div>
                        <div class="product-col">
                            <img src="{{ asset('assets/img/final2/Our-Product/OurProduct-UPVC.png') }}"
                                alt="UPVC Pipes and Fittings">
                            <h3 class="mt-4">UPVC Pipes and Fittings</h3>
                            <p>Skipper UPVC pipes have an economical installation, uptake, down-take lines, terrace looping,
                                and concealed pipe work. Made of thermoplastic material welded by solvent cement, these
                                fire-resistant products do not contaminate water passing through them. Being 100% lead-free,
                                India's safest pipes ensure overall hygiene.</p>
                        </div>
                        <div class="product-col">
                            <img src="{{ asset('assets/img/final2/Our-Product/OurProduct-SWR.png') }}"
                                alt="SWR Pipes and Fittings">
                            <h3 class="mt-4">SWR Pipes and Fittings</h3>
                            <p>Skipper SWR (Soil, Waste, and Rainwater) pipes offer a reliable solution for efficient waste
                                discharge and drainage across residential, commercial, and industrial infrastructures.
                                Engineered for performance, these pipes are lightweight yet robust, offering exceptional
                                resistance to chemicals, corrosion, and UV radiation.</p>
                        </div>
                        <div class="product-col">
                            <img src="{{ asset('assets/img/final2/Our-Product/OurProduct-Agriculture.png') }}"
                                alt="Agriculture Pipes and Fittings">
                            <h3 class="mt-4">Agriculture Pipes and Fittings</h3>
                            <p>Skipper Agriculture Pipes are a trusted choice for farmers across India, designed to deliver
                                consistent water supply for farming operations. Engineered with high-performance PVC, these
                                pipes are easy to install, come in both ring-fit and push-fit variants, and are known for
                                their superior durability. Pipes below 110mm can be joined by hand, while larger sizes are
                                installed using a pipe jack.</p>
                        </div>
                        <div class="product-col">
                            <img src="{{ asset('assets/img/final2/Our-Product/OurProduct-Borewell.png') }}" alt="SWR Pipes">
                            <h3 class="mt-4">Borewell Pipes and Fittings</h3>
                            <p>Skipper Casing Pipes ensure safe, durable borewell protection. Column Pipes support efficient
                                submersible pumping with smooth flow. Ribbed Strainer Pipes deliver reliable underground
                                filtration, strength, and long-lasting performance for clean, uninterrupted water
                                extraction.</p>
                        </div>
                        <div class="product-col">
                            <img src="{{ asset('assets/img/final2/Our-Product/OurProduct-Tanks.png') }}"
                                alt="Water Storage Tanks">
                            <h3 class="mt-4">Water Storage Tanks</h3>
                            <p>As the need for clean, potable water continues to rise, Skipper brings you the Marina Tank—a
                                premium-grade, hygienic water storage solution built for Indian homes, institutions, and
                                industries. Crafted with advanced Roto Moulding technology, Marina Tanks are built tough,
                                with added ribs for superior structural integrity. </p>
                        </div>
                        <div class="product-col">
                            <img src="{{ asset('assets/img/final2/Our-Product/OurProduct-BathFittings.png') }}"
                                alt="Bath Fittings Collections">
                            <h3 class="mt-4">Bath Fittings Collections</h3>
                            <p>Skipper Pipes presents a beautiful series of Bath fittings that brings to you design innovations, powered by flawless functionality. The products combine futuristic science and modern design to create unique features that are tailored to the specific needs of your bathroom. </p>
                        </div>
                    </div>


                </div>
                <div class="col-md-5 pp-form order-1 order-md-2 mb-5 mb-md-0" id="enquire">
                    <form action="{{ route('front.private-project.enquiry') }}" method="post"
                        class="partner-application-form" id="privateProjectForm">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="name">Your Name <span>*</span></label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="project_name">Project Name/Company Details</label>
                                <input type="text" class="form-control" id="project_name" name="project_name">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="phone">Your Phone Number <span>*</span></label>
                                <input type="tel" class="form-control" id="phone" name="phone" required>
                            </div>


                        </div>

                        <button type="submit" class="btn btn-dark theme theme2 btn-md mt-2">Enquire Now</button>
                    </form>
                </div>
            </div>
            <button id="scrollBtn" aria-label="Back to Top"> ↑ </button>
        </div>
    </section>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#privateProjectForm').on('submit', function(e) {
                e.preventDefault();
            });

            $('#privateProjectForm').validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 2,
                        maxlength: 255
                    },
                    project_name: {
                        maxlength: 255
                    },
                    phone: {
                        required: true,
                        minlength: 10,
                        maxlength: 20
                    }
                },
                messages: {
                    name: {
                        required: "Please enter your name",
                        minlength: "Name must be at least 2 characters long",
                        maxlength: "Name cannot exceed 255 characters"
                    },
                    phone: {
                        required: "Please enter your phone number",
                        minlength: "Phone number must be at least 10 digits",
                        maxlength: "Phone number cannot exceed 20 characters"
                    }
                },
                errorElement: 'div',
                errorPlacement: function(error, element) {
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid').removeClass('is-valid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid').addClass('is-valid');
                },
                submitHandler: function(form) {
                    $.ajax({
                        url: $(form).attr('action'),
                        type: "POST",
                        data: $(form).serialize(),
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            // Redirect directly to thank you page
                            window.location.href =
                                '{{ route('front.private-projects.thankyou') }}';
                        },
                        error: function(xhr) {
                            let errorMessage = 'Something went wrong. Please try again.';
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                errorMessage = xhr.responseJSON.message;
                            } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                                const errors = xhr.responseJSON.errors;
                                const firstError = Object.values(errors)[0];
                                errorMessage = Array.isArray(firstError) ? firstError[0] :
                                    firstError;
                            }
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: errorMessage,
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#144372'
                            });
                        }
                    });
                }
            });
        });
    </script>
    <script>
        // Back to top button
        window.addEventListener('scroll', function() {
            const scrollBtn = document.getElementById('scrollBtn');
            if (window.pageYOffset > 300) {
                scrollBtn.style.display = 'flex';
            } else {
                scrollBtn.style.display = 'none';
            }
        });

        document.getElementById('scrollBtn').addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    </script>
@endsection
