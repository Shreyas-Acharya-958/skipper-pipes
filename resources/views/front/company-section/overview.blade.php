<section class="who-we-are-sec default-padding">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <div class="site-heading headings">
                    <h4>Skipper Pipes</h4>
                    <h2>Who We Are!</h2>
                </div>
            </div>
        </div>
        <div class="row align-center">
            <div class="col-md-6 p-md-0">
                <p>{!! $overview_section_ones[0]->description ?? '' !!}</p>
            </div>
            <div class="col-md-6">
                <img src="{{ asset('storage/' . $overview_section_ones[0]->image) }}" alt="">

            </div>
        </div>



    </div>
</section>

<!-- Our Vision -->
<section class="vision-sec">
    <img src="{{ asset('storage/' . $overview_section_twos[0]->image) }}" alt="skipper vision">
    <div class="img-overlay"></div>
    <div class="vision-sec-content">
        <h2>{{ $overview_section_twos[0]->title ?? '' }}</h2>
        <p>{{ $overview_section_twos[0]->description ?? '' }}</p>
    </div>
</section>
<!-- Our Vision ends -->

<!-- Our mission  -->
@if ($overview_section_threes->count() > 0)
    <section class="mission-sec default-padding bg-gray">
        <div class="container">
            <div class="row align-items-start">
                <div class="col-md-5 title text-center mission-left-col">

                    <img src="{{ asset('/assets/img/final/skipper-pipes-s-logo.png') }}" class="w-50 mb-4"
                        alt="">
                    <div class="site-heading text-center">
                        <h2>Mission</h2>
                    </div>
                </div>

                <div class="col-md-7">
                    <div class="mission-sec--content-wrapper">
                        <div class="row justify-content-end flex-column align-items-end">

                            @foreach ($overview_section_threes as $overview)
                                @if ($overview->type == 'Mission')
                                    <div class="col-10 mission-card-wrapper">
                                        <div class="mission-card">
                                            <div class="mission-inner">
                                                <div class="mission-icon">

                                                    <img style="width: 50px; height: 50px;"
                                                        src="{{ asset('storage/' . $overview->icon) }}"
                                                        alt="{{ $overview->name ?? '' }}">
                                                </div>
                                                <h4>{{ $overview->title }}</h4>
                                                <p>{!! $overview->description !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
<!-- Our mission ends -->

<!-- Our Philosophy  -->
@if ($overview_section_threes->count() > 0)
    <section class="philosophy-sec default-padding">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="site-heading headings">
                        <h4>Skipper Pipes</h4>
                        <h2>Philosophy</h2>
                    </div>
                </div>
            </div>
            <div class="row philosophy-wrapper text-center">
                @foreach ($overview_section_threes as $overview)
                    @if ($overview->type == 'Philosophy')
                        <div class="col-12 col-md philosophy-col">
                            <img style="width: 50px; height: 50px;" src="{{ asset('storage/' . $overview->icon) }}"
                                alt="{{ $overview->title ?? '' }}">

                            <h4>{{ $overview->title }}</h4>
                            <p>{!! $overview->description !!}</p>
                        </div>
                    @endif
                @endforeach


            </div>
        </div>
    </section>
@endif
<!-- Our Philosophy ends -->

<!-- timeline carousel - Journery -->
@if ($overview_section_fives->count() > 0)
    <section class="timeline-carousel bg-gray default-padding">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="site-heading headings">
                        <h4>Skipper Pipes</h4>
                        <h2>Journey So Far!</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="timeline-container">
                    <div class="swiper timeline-swiper">
                        <div class="swiper-wrapper">
                            <!-- Slide: 2009 -->
                            @foreach ($overview_section_fours as $overview)
                                <div class="swiper-slide timeline-slide">
                                    <div class="timeline-year">{{ $overview->year }}</div>
                                    <h4 class="timeline-title">{{ $overview->title }}</h4>
                                    <p class="timeline-desc">{!! $overview->description !!}</p>
                                    <div class="timeline-img">
                                        <img src="{{ asset('storage/' . $overview->image) }}"
                                            alt="{{ $overview->title }}">
                                    </div>
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
    <!-- timeline carousel - Journery  ends-->
@endif

<!-- Pan-India section -->
<section class="pan-india-sec default-padding">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <div class="site-heading headings">
                    <h4>Skipper Pipes</h4>
                    <h2>Pan-India Presence</h2>
                </div>
            </div>
        </div>
        <div class="row align-center">
            <div class="col"></div>
            <div class="col-md-3 pan-india-wrapper">
                {!! $overview_section_fives[0]->description ?? '' !!}

            </div>
            <div class="col-md-6 pan-india-img">
                <img src="{{ asset('storage/' . $overview_section_fives[0]->image) }}" alt="">
            </div>
            <div class="col"></div>
        </div>


    </div>
</section>
<!-- Pan-India section ends -->


<!-- product cta -->
<section class="product-cta bg-theme text-white default-padding">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h2 class="text-white mb-4">Ready to meet the people driving our vision?</h2>
                <a class="btn btn-light effect btn-md" href="leadership.html">Meet Our Leadership</a>
            </div>
        </div>
    </div>
</section>
<!-- product cta ends -->
