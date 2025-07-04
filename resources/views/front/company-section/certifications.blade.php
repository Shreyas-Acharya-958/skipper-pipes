    <!-- Manufacturing Overview -->
    <section class="certifications-overview default-padding">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="site-heading headings">
                        <h4>SKipper Pipes</h4>
                        <h2>Why Certifications Matter</h2>
                        <p>At Skipper Pipes, certifications are more than badges—they are <b>promises of performance,
                                safety, and regulatory compliance.</b> Aligning with national (BIS, IS) and
                            international (ASTM, ISO) standards ensures our customers—engineers, contractors, and
                            homeowners—receive products they can trust in the most critical installations.</p>
                    </div>
                </div>
            </div>

        </div>
    </section>



    <!-- Certifications Section -->
    <section class="certifications-sec default-padding bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="site-heading headings">
                        <h4>Skipper Pipes</h4>
                        <h2>Our Certifications</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($certifications_section_ones as $certification)
                    <div class="col-md-4">
                        <div class="certificate-col">
                            <div class="certificate-img">
                                <img src="{{ asset('storage/' . $certification->image ?? '') }}" alt="">
                            </div>
                            <h3 class="certificate-name">{{ $certification->title ?? '' }}</h3>
                            <span class="certificate-type">{{ $certification->short_description ?? '' }}</span>
                            <span class="certificate-desc">{!! $certification->long_description ?? '' !!}</span>
                            <a class="certificate-link" href="{{ $certification->link ?? '' }}"
                                target="_blank">Download</a>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>
    <!-- Certifications Section emds -->



    <!-- product cta -->
    <section class="product-cta bg-theme text-white default-padding">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h2 class="text-white mb-4">Need a certificate not listed?</h2>
                    <a class="btn btn-light effect btn-md" href="#">Contact us</a>
                </div>
            </div>
        </div>
    </section>
    <!-- product cta ends -->
