<!-- Our mission  -->
<section class="mission-sec default-padding bg-gray">
    <div class="container">
        <div class="row align-items-start">
            <div class="col-md-5 title text-center mission-left-col">
                <img src="{{ asset('assets/img/final/skipper-pipes-s-logo.png') }}" class="w-50 mb-4" alt="Skipper Logo">
                <div class="site-heading text-center">
                    <h2>Mission</h2>
                </div>
            </div>

            <div class="col-md-7">
                <div class="mission-sec--content-wrapper">
                    <div class="row justify-content-end flex-column align-items-end">
                        <div class="col-10 mission-card-wrapper">
                            <div class="mission-card">
                                <div class="mission-inner">
                                    <div class="mission-icon">
                                        <i class="fas fa-microchip"></i>
                                    </div>
                                    <h4>Expand Value-Driven Portfolio</h4>
                                    <p>Continuously introduce innovative, high-quality products and services that add
                                        measurable value for customers and stakeholders.</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-10 mission-card-wrapper">
                            <div class="mission-card">
                                <div class="mission-inner">
                                    <div class="mission-icon">
                                        <i class="fas fa-microchip"></i>
                                    </div>
                                    <h4>Advance Power & Water Solutions</h4>
                                    <p>Focus on critical power and water sectors, addressing contemporary global
                                        infrastructure demands with safe, reliable piping systems.</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-10 mission-card-wrapper">
                            <div class="mission-card">
                                <div class="mission-inner">
                                    <div class="mission-icon">
                                        <i class="fas fa-microchip"></i>
                                    </div>
                                    <h4>Grow Geographical Reach</h4>
                                    <p>Enter new markets and strengthen existing ones, delivering trusted Skipper
                                        solutions wherever infrastructure is advancing.</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-10 mission-card-wrapper">
                            <div class="mission-card">
                                <div class="mission-inner">
                                    <div class="mission-icon">
                                        <i class="fas fa-microchip"></i>
                                    </div>
                                    <h4>Scale with Future-Ready Technology</h4>
                                    <p>Adopt cutting-edge manufacturing and materials science to extend product
                                        longevity, efficiency, and performance.</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-10 mission-card-wrapper">
                            <div class="mission-card">
                                <div class="mission-inner">
                                    <div class="mission-icon">
                                        <i class="fas fa-microchip"></i>
                                    </div>
                                    <h4>Sustainability & Low Carbon</h4>
                                    <p>Aggressively reduce our carbon footprint by lowering hydrocarbon dependence and
                                        embracing renewable energy and practices.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Our Philosophy  -->
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
            <div class="col-12 col-md philosophy-col">
                <i class="fas fa-hard-hat icon"></i>
                <h4>Performance Always</h4>
                <p>Advanced polymers, precision extrusion, and strict ASTM/BIS compliance.</p>
            </div>
            <div class="col-12 col-md philosophy-col">
                <i class="fas fa-hard-hat icon"></i>
                <h4>Safety First</h4>
                <p>100% lead-free formulations and rigorous quality audits.</p>
            </div>
            <div class="col-12 col-md philosophy-col">
                <i class="fas fa-hard-hat icon"></i>
                <h4>Progress Together</h4>
                <p>Collaborating with dealers, plumbers, and communities to build a resilient nation.</p>
            </div>
        </div>
    </div>
</section>

<!-- Timeline carousel - Journey -->
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
                        <!-- Timeline slides -->
                        @foreach ($timelineEvents as $event)
                            <div class="swiper-slide timeline-slide">
                                <div class="timeline-year">{{ $event['year'] }}</div>
                                <h4 class="timeline-title">{{ $event['title'] }}</h4>
                                <p class="timeline-desc">{!! $event['description'] !!}</p>
                                <div class="timeline-img">
                                    <img src="{{ asset('assets/img/final/HDPE-pipes.jpeg') }}"
                                        alt="{{ $event['year'] }} Event">
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </div>
</section>

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
                @foreach ($statistics as $stat)
                    <div class="pan-india-col overview-counters">
                        <div class="counter">
                            <div class="timer" data-to="{{ $stat['value'] }}" data-speed="1500">{{ $stat['value'] }}
                            </div>
                            <div class="operator">+</div>
                        </div>
                        <span class="counter-text">{{ $stat['label'] }}</span>
                    </div>
                @endforeach
            </div>
            <div class="col-md-6 pan-india-img">
                <img src="{{ asset('assets/img/final/map.jpeg') }}" alt="Pan India Map">
            </div>
            <div class="col"></div>
        </div>
    </div>
</section>
