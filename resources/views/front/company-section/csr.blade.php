@if ($csr_section_ones->count() > 0)
    <!-- CSR Philossphy Section -->
    <section class="csr-philosophy-sec default-padding bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="site-heading headings">
                        <h4>Skipper Pipes</h4>
                        <h2>CSR Philosophy</h2>
                    </div>
                </div>
            </div>
            <div class="row align-center">
                <div class="col-md-6 p-md-0 pr-md-5">
                    {!! $csr_section_ones[0]->description ?? '' !!}

                </div>
                <div class="col-md-6">
                    <img src="{{ asset('storage/' . $csr_section_ones[0]->image ?? '') }}" alt="">
                </div>
            </div>
        </div>
    </section>
    <!-- CSR Philossphy Section ends-->
@endif
@if ($csr_section_twos->count() > 0)
    <!-- CSR Key Areas Philosophy  -->
    <section class="csr-key-areas-sec default-padding">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="site-heading headings">
                        <h4>CSR</h4>
                        <h2>Key Focus Areas</h2>
                    </div>
                </div>
            </div>
            <div class="row philosophy-wrapper text-center mt-5">
                @foreach ($csr_section_twos as $csr)
                    <div class="col-12 col-md philosophy-col px-3 px-md-0">
                        <img src="{{ asset('storage/' . $csr->icon) }}" alt="{{ $csr->name ?? '' }}">
                        <h4>{{ $csr->title ?? '' }}</h4>
                        <p>{!! $csr->description ?? '' !!}</p>
                    </div>
                @endforeach


            </div>
        </div>
    </section>
    <!-- Our Philosophy ends -->
@endif
@if ($csr_section_threes->count() > 0)
    <!-- Ongoing Initatives Section -->
    <section class="ongoing-initatives-sec default-padding bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="site-heading headings">
                        <h4>CSR</h4>
                        <h2>Ongoing Initatives</h2>
                    </div>
                </div>
            </div>
            @foreach ($csr_section_threes as $csr)
                @if ($loop->index % 2 == 0)
                    <div class="row initatives-card">
                        <div class="col-md-5">
                            <img src="{{ asset('storage/' . $csr->image ?? '') }}" alt="">
                        </div>
                        <div class="col-md-7">
                            {!! $csr->description ?? '' !!}
                        </div>
                    </div>
                @else
                    <div class="row initatives-card">
                        <div class="col-md-7">
                            {!! $csr->description ?? '' !!}
                        </div>
                        <div class="col-md-5">
                            <img src="{{ asset('storage/' . $csr->image ?? '') }}" alt="">
                        </div>

                    </div>
                @endif
            @endforeach


        </div>
    </section>
    <!-- Business Directors Section emds -->
@endif

<!-- product cta -->
<section class="product-cta bg-theme text-white default-padding">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h2 class="text-white mb-4">Join us in shaping safer, healthier communities.</h2>
                <a class="btn btn-light effect btn-md" href="{{ url('contact-us') }}">Contact Us</a>
            </div>
        </div>
    </div>
</section>
<!-- product cta ends -->
