@extends('front.layouts.app')

@section('title', 'Skipper Pipes - Become Distributor')
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
            <img src="{{ asset('storage/' . $partner->page_image) }}" alt="">
        </div>
        <div class="hero-banner2-overlay"></div>
        <div class="hero-banner2-content">
            <h1>{{ $partner->short_description }}</h1>
            <p>{{ $partner->long_description }}</p>
        </div>
    </section>

    <section class="hero-banner2-responsive">
        <div class="hero-banner2-content-responsive">
            <h1>{{ $partner->short_description }}</h1>
            <p>{{ $partner->long_description }}</p>
        </div>
        <div class="hero-banner2-img-responsive">
            <img src="{{ asset('storage/' . $partner->page_image) }}" alt="">
        </div>
    </section>
    <!-- Hero banner-section ends -->
    <!-- Breadcrumb  -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12 p-0">
                    <ul class="breadcrumb">
                        <li><a href="{{ url('/') }}"><i class="fas fa-home"></i> Home</a></li>
                        <li>Partner</li>
                        <li class="active">{{ $partner->title }}</li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
    <!-- Become a Distributor form -->
    <section class="partner-form-sec default-padding">
        <div class="container">
            <div class="row" data-aos="fade-up" data-aos-duration="1000">
                <div class="col-12 text-center">
                    <div class="site-heading text-center">
                        <h4>Skipper Pipes</h4>
                        <h2>Join Skipper Family</h2>
                        <p>Fill the form below to become a Distributor.</p>
                    </div>
                </div>
            </div>
            <div class="row" data-aos="fade-up" data-aos-duration="1000">
                <div class="col-12">
                    <form id="partnerForm" action="{{ route('front.partner.enquiry') }}" method="post"
                        class="partner-application-form">
                        @csrf
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <input type="hidden" name="partner_id" value="{{ $partner->id ?? '' }}">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="full-name">Name <span>*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="full-name" name="name" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="email">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="phone">Mobile Number <span>*</span></label>
                                <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                    id="phone" name="phone" required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="firm-name">Firm Name</label>
                                <input type="text" class="form-control @error('firm_name') is-invalid @enderror"
                                    id="firm-name" name="firm_name">
                                @error('firm_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="gst">GST Number</label>
                                <input type="text" class="form-control @error('gst') is-invalid @enderror" id="gst"
                                    name="gst">
                                @error('gst')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="pincode">Pincode <span>*</span></label>
                                <input type="text" class="form-control @error('pincode') is-invalid @enderror"
                                    id="pincode" name="pincode" required>
                                @error('pincode')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="occupation">Current Occupation <span>*</span></label>
                                <input type="text" class="form-control @error('occupation') is-invalid @enderror"
                                    id="occupation" name="occupation" required>
                                @error('occupation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="experience">Experience:</label>
                                <select id="experience" class="form-control @error('experience') is-invalid @enderror"
                                    name="experience">
                                    <option value="">Select Experience...</option>
                                    <option value="1-5">1 to 5 Years</option>
                                    <option value="6-10">6 to 10 Years</option>
                                    <option value="10+">10+ Years</option>
                                </select>
                                @error('experience')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="dealership-interest">Select Option of Interest:</label>
                                <select id="dealership-interest"
                                    class="form-control @error('dealership_type') is-invalid @enderror"
                                    name="dealership_type">
                                    <option value="">Choose...</option>
                                    <option value="pipes">Pipes</option>
                                    <option value="tank">Tank</option>
                                    <option value="bathware">Bathware</option>
                                    <option value="all of the above">All of the above</option>
                                </select>
                                @error('dealership_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-12 form-desc">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" cols="100%" rows="3"
                                    class="form-control @error('description') is-invalid @enderror"></textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-dark theme theme2 btn-md mt-2">
                            Submit Distributor Enquiry
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Become a Distributor form ends -->
    <!-- Why become a Skipper distributor Section -->
    <section class="default-padding">
        <div class="container">
            <div class="row" data-aos="fade-up" data-aos-duration="1000">
                <div class="col-12">
                    <div class="site-heading text-center">
                        <h4>Skipper Pipes</h4>
                        <h2>Why Become a Skipper Distributor?</h2>
                    </div>
                </div>
            </div>
            <div class="row align-center">
                <div class="col-md-6" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        @if ($partner && $partner->sectionOne && $partner->sectionOne->image)
                            @php
                                $images = explode(',', $partner->sectionOne->image);
                            @endphp
                            <ol class="carousel-indicators">
                                @foreach ($images as $key => $image)
                                    <li data-target="#carouselExampleIndicators" data-slide-to="{{ $key }}"
                                        class="{{ $key == 0 ? 'active' : '' }}"></li>
                                @endforeach
                            </ol>
                            <div class="carousel-inner">
                                @foreach ($images as $key => $image)
                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                        <img class="d-block w-100" src="{{ asset('storage/' . trim($image)) }}"
                                            alt="Slide {{ $key + 1 }}">
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img class="d-block w-100" src="/assets/img/final/skipper-banner1.jpg"
                                        alt="First slide">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="/assets/img/final/skipper-banner2.jpeg"
                                        alt="Second slide">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="/assets/img/final/skipper-banner3.jpeg"
                                        alt="Third slide">
                                </div>
                            </div>
                        @endif
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
                </div>
                <div class="col-md-6 pt-3 pt-md-0" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                    <p>{{ $partner->sectionOne->description ?? 'With a vast and growing network of distributors, dealers, and plumbers across India, Skipper Pipes has become a trusted force in the piping industry. Our consistent brand visibility, advanced manufacturing capabilities, and deep-rooted technical know-how equip our partners with a strong foundation for success. Whether it\'s navigating competitive markets or meeting evolving customer needs, we ensure that every stakeholder benefits from seamless support, timely delivery, and product excellence — enabling long-term growth, loyalty, and shared success across the value chain.' }}
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- Why Skipper Section ends -->

    <!-- What Skipper Pipes offers -->
    <section class="left-img-col default-padding bg-gray">
        <div class="container">
            <div class="row" data-aos="fade-up" data-aos-duration="1000">
                <div class="col-12 text-center">
                    <div class="site-heading text-center">
                        <h4>Offers</h4>
                        <h2>What Skipper Pipes Offers?</h2>
                        <p>Strategic support, product diversity, and shared success.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="partners-tabs col-md-6" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                    @php
                        $initialImage = asset('assets/img/final/12344.jpg');
                    @endphp
                    @if ($partner && $partner->sectionTwo)
                        @php
                            $titles = json_decode($partner->sectionTwo->title, true);
                            $descriptions = json_decode($partner->sectionTwo->description, true);
                            $images = json_decode($partner->sectionTwo->image, true);
                            $initialImage = !empty($images[0])
                                ? url('storage/' . $images[0])
                                : asset('assets/img/final/12344.jpg');
                        @endphp

                        @foreach ($titles as $key => $title)
                            @php
                                $imageUrl = !empty($images[$key])
                                    ? url('storage/' . $images[$key])
                                    : asset('assets/img/final/12344.jpg');
                            @endphp
                            <div class="partners-tab {{ $key == 0 ? 'active' : '' }}" data-image="{{ $imageUrl }}">
                                <h3>{{ $title }}</h3>
                                <p>{{ $descriptions[$key] }}</p>
                            </div>
                        @endforeach
                    @else
                    @endif
                </div>
                <div class="image-display col-md-6" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                    <img src="{{ $initialImage }}" id="tab-image" alt="Image" class="img-fluid shadow" />
                </div>
            </div>
        </div>
    </section>
    <!-- What Skipper Pipes offers ends -->
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.partners-tab');
            const imageDisplay = document.getElementById('tab-image');

            // Add click event to all tabs
            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    // Remove active class from all tabs
                    tabs.forEach(t => t.classList.remove('active'));

                    // Add active class to clicked tab
                    this.classList.add('active');

                    // Update image
                    const imageUrl = this.getAttribute('data-image');
                    if (imageUrl && imageDisplay) {
                        imageDisplay.src = imageUrl;
                    }
                });
            });
        });
    </script>
@endpush
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#partnerForm').validate({
                rules: {
                    name: {
                        required: true
                    },
                    phone: {
                        required: true,
                        digits: true,
                        minlength: 10,
                        maxlength: 10
                    },
                    pincode: {
                        required: true,
                        digits: true,
                        minlength: 6,
                        maxlength: 6
                    },
                    occupation: {
                        required: true
                    },
                    email: {
                        email: true
                    }
                },
                messages: {
                    phone: {
                        required: "Please enter your phone number",
                        digits: "Phone number must contain only digits",
                        minlength: "Phone number must be exactly 10 digits",
                        maxlength: "Phone number must be exactly 10 digits"
                    },
                    pincode: {
                        required: "Please enter your pincode",
                        digits: "Pincode must contain only digits",
                        minlength: "Pincode must be exactly 6 digits",
                        maxlength: "Pincode must be exactly 6 digits"
                    },
                    email: {
                        email: "Please enter a valid email address"
                    }
                },
                submitHandler: function(form) {
                    // Show loading state
                    Swal.fire({
                        title: 'Submitting...',
                        text: 'Please wait while we process your enquiry.',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    $.ajax({
                        url: "{{ route('front.partner.enquiry') }}",
                        type: "POST",
                        data: $(form).serialize(),
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            // Direct redirect if redirect URL is provided
                            if (response.redirect) {
                                window.location.href = response.redirect;
                            } else {
                                form.reset();
                                // Reset form validation
                                $('#partnerForm').validate().resetForm();
                                // Remove any validation classes
                                $('#partnerForm .form-control').removeClass(
                                    'is-valid is-invalid');
                            }
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
