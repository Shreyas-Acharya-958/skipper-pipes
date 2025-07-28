    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ul class="breadcrumb">
                        <li><a href="{{ route('front.home') }}"><i class="fas fa-home"></i> Home</a></li>
                        <li class="active">manufacturing </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @if ($manufacturing_section_ones->count() > 0)
        <!-- Manufacturing Overview -->
        <section class="manufacturing-overview default-padding">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <div class="site-heading headings" >
                            <h4 data-aos="fade-up" data-aos-duration="1000">SKipper Pipes</h4>
                            <h2 data-aos="fade-up" data-aos-duration="1000">{{ $manufacturing_section_ones_head->title }} </h2>
                            <p data-aos="fade-left" data-aos-duration="1000" data-aos-delay="100">{!! $manufacturing_section_ones_head->description !!}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="manufacturing-container" data-aos="fade-up" data-aos-duration="1000">
                        <div class="swiper location-swiper">
                            <div class="swiper-wrapper">
                                @foreach ($manufacturing_section_ones as $manufacturing)
                                    <div class="swiper-slide location-slide">
                                        <div class="location-img">
                                            <img src="{{ asset('storage/' . $manufacturing->image) }}"
                                                alt="{{ $manufacturing->title ?? '' }}">
                                        </div>
                                        <span class="location-title">{{ $manufacturing->title ?? '' }}</span>
                                        <span class="location-work">{{ $manufacturing->description ?? '' }}</span>
                                    </div>
                                @endforeach

                            </div>

                            <!-- Arrows -->
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>

                            <!-- Pagination (optional) -->
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if ($manufacturing_section_twos->count() > 0)
        <!-- Technology & Machinery Sectino -->
        <section class="technology-machinery-sec default-padding bg-gray">
            <div class="container">
                <div class="row" data-aos="fade-up" data-aos-duration="1000">
                    <div class="col-12 text-center">
                        <div class="site-heading headings">
                            <h4>Manufacturing</h4>
                            <h2>Technology & Machinery</h2>
                        </div>
                    </div>
                </div>
                <div class="row align-center">
                    <div class="col-md-5" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="100">
                        <img src="{{ asset('storage/' . $manufacturing_section_twos[0]->image) }}" alt="">
                    </div>
                    <div class="col-md-7 pl-md-5 pt-4 pt-md-0 " data-aos="fade-left" data-aos-duration="1000" data-aos-delay="100">
                        {!! $manufacturing_section_twos[0]->description ?? '' !!}

                    </div>
                </div>
            </div>
        </section>
    @endif

    @if ($manufacturing_section_threes->count() > 0)
        <!-- Our Philosophy  -->
        <section class="philosophy-sec default-padding">
            <div class="container">
                <div class="row" data-aos="fade-up" data-aos-duration="1000">
                    <div class="col-12 text-center">
                        <div class="site-heading headings">
                            <h4>Manufacturing</h4>
                            <h2>Quality Control</h2>
                            <p class="site-description">Quality is embedded at every stage, from raw-material inspection
                                to final dispatch.</p>
                        </div>
                    </div>
                </div>
                <div class="row philosophy-wrapper text-center mt-5 px-3 px-md-0">
                    @foreach ($manufacturing_section_threes as $manufacturing)
                        <div class="col-12 col-md-6 col-lg-3 philosophy-col" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                            <img src="{{ asset('storage/' . $manufacturing->icon) }}"
                                alt="{{ $manufacturing->name ?? '' }}">

                            <h4>{{ $manufacturing->title ?? '' }}</h4>
                            <p>{!! $manufacturing->description ?? '' !!}</p>
                        </div>
                    @endforeach


                </div>
            </div>
        </section>
        <!-- Our Philosophy ends -->
    @endif

    @if ($manufacturing_section_fours->count() > 0)
        <!-- Sustainability pratices Sectino -->
        <section class="sustainability-practice-sec default-padding bg-gray">
            <div class="container">
                <div class="row" data-aos="fade-up" data-aos-duration="1000">
                    <div class="col-12 text-center">
                        <div class="site-heading headings">
                            <h4>Manufacturing</h4>
                            <h2>Sustainability Practices</h2>
                        </div>
                    </div>
                </div>
                <div class="row align-center">
                    <div class="col-md-7 pr-5 order-2 order-md-1 pt-4 pt-md-0" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="100">
                        {!! $manufacturing_section_fours[0]->description ?? '' !!}

                    </div>
                    <div class="col-md-5 order-1 order-md-2" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="100">
                        <img src="{{ asset('storage/' . $manufacturing_section_fours[0]->image) }}" alt="">
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- product cta -->
    <section class="product-cta bg-theme text-white default-padding">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h2 class="text-white mb-4">Discover how Skipper Pipes contribute to building tomorrow.</h2>
                    <a class="btn btn-light effect btn-md" href="{{ url('company/csr') }}">Explore CSR Initiatives</a>
                </div>
            </div>
        </div>
    </section>
    <!-- product cta ends -->
