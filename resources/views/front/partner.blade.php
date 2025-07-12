@extends('front.layouts.app')

@section('title', 'Skipper Pipes - Partner')

@section('content')
    <!-- Why become a Skipper dealer Section -->
    <section class="default-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="site-heading text-center">
                        <h4>Skipper Pipes</h4>
                        <h2>Why Become a Skipper Distributor?</h2>
                    </div>
                </div>
            </div>
            <div class="row align-center">
                <div class="col-md-6">
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
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 pt-3 pt-md-0">
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
            <div class="row">
                <div class="col-12 text-center">
                    <div class="site-heading text-center">
                        <h4>Offers</h4>
                        <h2>What Skipper Pipes Offers?</h2>
                        <p>Strategic support, product diversity, and shared success.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="partners-tabs col-md-6">
                    @if ($partner && $partner->sectionTwo)
                        @php
                            $titles = json_decode($partner->sectionTwo->title, true);
                            $descriptions = json_decode($partner->sectionTwo->description, true);
                            $images = json_decode($partner->sectionTwo->image, true);
                        @endphp
                        @foreach ($titles as $key => $title)
                            <div class="partners-tab {{ $key == 0 ? 'active' : '' }}"
                                data-image="{{ !empty($images[$key]) ? url('storage/' . $images[$key]) : asset('assets/img/final/12344.jpg') }}">
                                <h3>{{ $title }}</h3>
                                <p>{{ $descriptions[$key] }}</p>
                            </div>
                        @endforeach

                    @endif
                </div>
                <div class="image-display col-md-6">
                    <img src="" alt="Partner Image" class="img-fluid">
                </div>
            </div>
        </div>
    </section>
    <!-- What Skipper Pipes offers ends -->

    <!-- Become a Dealer form -->
    <section class="partner-form-sec default-padding">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="site-heading text-center">
                        <h4>Skipper Pipes</h4>
                        <h2>Join Skipper Family</h2>
                        <p>Fill the form below to become a Distributor.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('front.partner.enquiry') }}" method="post" class="partner-application-form">
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
                                <input type="text" class="form-control @error('gst') is-invalid @enderror"
                                    id="gst" name="gst">
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
                                <label for="dealership-interest">Select Dealership Option of Interest:</label>
                                <select id="dealership-interest"
                                    class="form-control @error('dealership_type') is-invalid @enderror"
                                    name="dealership_type">
                                    <option value="">Choose...</option>
                                    <option value="pipes">Pipes</option>
                                    <option value="tank">Tank</option>
                                    <option value="bathware">Bathware</option>
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
                        <button type="submit" class="btn btn-dark theme theme2 btn-md mt-2">Submit Distributor
                            Enquiry</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Become a Dealer form ends -->
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.partners-tab');
            const imageDisplay = document.querySelector('.image-display img');

            // Set initial image from active tab
            const activeTab = document.querySelector('.partners-tab.active');
            if (activeTab) {
                imageDisplay.src = activeTab.getAttribute('data-image');
            }

            // Add click event to all tabs
            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    // Remove active class from all tabs
                    tabs.forEach(t => t.classList.remove('active'));

                    // Add active class to clicked tab
                    this.classList.add('active');

                    // Update image
                    const imageUrl = this.getAttribute('data-image');
                    if (imageUrl) {
                        imageDisplay.src = imageUrl;
                    }
                });
            });
        });
    </script>
@endpush
