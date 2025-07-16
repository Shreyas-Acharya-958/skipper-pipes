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
            <img src="assets/img/final/blogs-banner-final1.jpg" alt="">
        </div>
        <div class="hero-banner2-overlay"></div>
        <div class="hero-banner2-content">
            <h1>Contact Us</h1>
        </div>
    </section>

    <section class="hero-banner2-responsive">
        <div class="hero-banner2-content-responsive">
            <h1>Contact Us</h1>
        </div>
        <div class="hero-banner2-img-responsive">
            <img src="assets/img/final/blogs-banner1.jpg" alt="">
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
            <div class="row">
                <div class="col-12 text-center">
                    <div class="site-heading headings">
                        <h4>SKipper Pipes</h4>
                        <h2>Lorem ipsum dolor sit amet.</h2>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <!-- Left: City List -->
                <div class="col-md-3 mb-5 mb-md-0">
                    <ul class="list-group city-list">
                        <li class="list-group-item active" data-city="west-bengal">West Bengal</li>
                        <li class="list-group-item" data-city="uttar-pradesh">Uttar Pradesh</li>
                        <li class="list-group-item" data-city="assam">Assam</li>
                        <li class="list-group-item" data-city="telangana">Telangana</li>
                    </ul>
                </div>

                <!-- Center: Location Details -->
                <div class="col-md-5 mb-5 mb-md-0">
                    <div class="location-info" id="info-west-bengal">
                        <h4>Registered & Corporate Office, Ahmedabad, West Bengal</h4>
                        <p>12th Floor, Tirumala Building, 22, E Topsia Rd, East Topsia, Tiljala, Kolkata, West Bengal 700046
                        </p>
                        <a>📞 +91-123456789</a>
                        <a>📧 westbengal@company.com</a>
                    </div>
                    <div class="location-info d-none" id="info-uttar-pradesh">
                        <h4>Branch Office, Uttar Pradesh</h4>
                        <p>12th Floor, Tirumala Building, 22, E Topsia Rd, East Topsia, Tiljala, Kolkata, West Bengal 700046
                        </p>
                        <p>📞 +91-123456789</p>
                        <p>📧 uttarpradesh@company.com</p>
                    </div>
                    <div class="location-info d-none" id="info-assam">
                        <h4>Branch Office, Assam</h4>
                        <p>12th Floor, Tirumala Building, 22, E Topsia Rd, East Topsia, Tiljala, Kolkata, West Bengal 700046
                        </p>
                        <p>📞 +91-123456789</p>
                        <p>📧 assam@company.com</p>
                    </div>
                    <div class="location-info d-none" id="info-telangana">
                        <h4>Branch Office, Telangana</h4>
                        <p>12th Floor, Tirumala Building, 22, E Topsia Rd, East Topsia, Tiljala, Kolkata, West Bengal 700046
                        </p>
                        <p>📞 +91-123456789</p>
                        <p>📧 telangana@company.com</p>
                    </div>
                </div>

                <!-- Right: India Map -->
                <div class="col-md-4 position-relative mb-5 mb-md-0 overflow-hidden">
                    <img src="assets/img/final2/Map.svg" class="img-fluid" alt="India Map" />

                    <!-- Pins -->
                    <div class="map-pin pin-west-bengal">
                        <span>West Bengal</span>
                        <img src="assets/img/final2/gray-pin.svg" data-city="west-bengal" />
                    </div>
                    <div class="map-pin pin-uttar-pradesh">
                        <span>Uttar Pradesh</span>
                        <img src="assets/img/final2/gray-pin.svg" data-city="uttar-pradesh" />
                    </div>
                    <div class="map-pin pin-assam">
                        <span>Assam</span>
                        <img src="assets/img/final2/gray-pin.svg" data-city="assam" />
                    </div>
                    <div class="map-pin pin-telangana">
                        <span>Telangana</span>
                        <img src="assets/img/final2/gray-pin.svg" data-city="telangana" />
                    </div>

                    <!-- <img src="assets/img/final2/gray-pin.svg" class="map-pin pin-uttar-pradesh" data-city="uttar-pradesh" />
                                                                                <img src="assets/img/final2/gray-pin.svg" class="map-pin pin-assam" data-city="assam" />
                                                                                <img src="assets/img/final2/gray-pin.svg" class="map-pin pin-telangana" data-city="telangana" /> -->

                    <!-- Active Pin Overlay -->
                    <div class="map-pin active-pin pin-west-bengal d-block">
                        <span>West Bengal</span>
                        <img src="assets/img/final2/blue-pin.svg" />
                    </div>
                    <div class="map-pin active-pin pin-uttar-pradesh d-none">
                        <span>Uttar Pradesh</span>
                        <img src="assets/img/final2/blue-pin.svg" />
                    </div>
                    <div class="map-pin active-pin pin-assam d-none">
                        <span>Assam</span>
                        <img src="assets/img/final2/blue-pin.svg" />
                    </div>
                    <div class="map-pin active-pin pin-telangana d-none">
                        <span>Telangana</span>
                        <img src="assets/img/final2/blue-pin.svg" />
                    </div>
                    <!-- <img src="assets/img/final2/blue-pin.svg" class="map-pin active-pin pin-uttar-pradesh d-none" />
                                                                                <img src="assets/img/final2/blue-pin.svg" class="map-pin active-pin pin-assam d-none" />
                                                                                <img src="assets/img/final2/blue-pin.svg" class="map-pin active-pin pin-telangana d-none" /> -->
                </div>
            </div>
        </div>

    </section>

    <section class="contact-details-wrapper default-padding ">
        <div class="container">
            <div class="row">
                <div class="col-md-6 contact-details-content">
                    <h3>Get In Touch !</h3>
                    <p class="contact-desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae, nulla eum.
                        Expedita aliquam voluptas voluptate.</p>
                    <ul>
                        <li>
                            <h4>Media Queries</h4>
                            <p>For Media Queries reach out to us on:</p>
                            <a href="#">promit.sinha@skipperlimited.com</a>
                        </li>
                        <li>
                            <h4>Advertiser Queries</h4>
                            <p>For any Advertising Query reach out to us on:</p>
                            <a href="#">promit.sinha@skipperlimited.com</a>
                        </li>
                        <li>
                            <h4>Investor Queries</h4>
                            <p>For any Investors Query reach out to us on:</p>
                            <a href="#">promit.sinha@skipperlimited.com</a>
                        </li>
                    </ul>
                </div>
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

                        <div id="alertBox" class="alert d-none mt-3"></div>

                        <button type="submit" class="btn btn-dark theme theme2 btn-md mt-2">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
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
                    $.ajax({
                        url: "{{ route('front.contact.store') }}",
                        type: "POST",
                        data: $(form).serialize(),
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            $('#alertBox')
                                .removeClass('d-none alert-danger')
                                .addClass('alert-success')
                                .text('Thank you! We will contact you shortly.');

                            form.reset();
                        },
                        error: function(xhr) {
                            let message = 'An error occurred. Please try again.';
                            if (xhr.responseJSON?.errors) {
                                message = Object.values(xhr.responseJSON.errors).join(' ');
                            }
                            $('#alertBox')
                                .removeClass('d-none alert-success')
                                .addClass('alert-danger')
                                .text(message);
                        }
                    });
                    return false;
                }
            });
        });
    </script>
@endsection
