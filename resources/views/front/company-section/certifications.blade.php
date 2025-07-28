  <div class="breadcrumb-area">
      <div class="container">
          <div class="row">
              <div class="col-12">
                  <ul class="breadcrumb">
                      <li><a href="{{ route('front.home') }}"><i class="fas fa-home"></i> Home</a></li>
                      <li class="active">certifications </li>
                  </ul>
              </div>
          </div>
      </div>
  </div>
  <!-- Manufacturing Overview -->
  <section class="certifications-overview default-padding">
      <div class="container">
          <div class="row">
              <div class="col-12 text-center">
                  <div class="site-heading headings">
                      <h4 data-aos="fade-up" data-aos-duration="1000">SKipper Pipes</h4>
                      <h2 data-aos="fade-up" data-aos-duration="1000">{{ $certifications_section_head->title }}</h2>
                      <p data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100"> {!! $certifications_section_head->description !!}</p>
                  </div>
              </div>
          </div>

      </div>
  </section>



  <!-- Certifications Section -->
  <section class="certifications-sec default-padding bg-gray">
      <div class="container">
          <div class="row" data-aos="fade-up" data-aos-duration="1000">
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
                              <img src="{{ asset('storage/' . $certification->image ?? '') }}" alt="{{ $certification->title }}">
                          </div>
                          <h3 class="certificate-name">{{ $certification->title ?? '' }}</h3>
                          <span class="certificate-type">{{ $certification->short_description ?? '' }}</span>
                          <span class="certificate-desc">{!! $certification->long_description ?? '' !!}</span>
                          @if ($certification->link)
                              <a class="certificate-link" href="{{ asset('storage/' . $certification->link) }}"
                                  target="_blank">Download PDF</a>
                          @endif
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
                  <a class="btn btn-light effect btn-md" href="{{ url('contact-us') }}">Contact us</a>
              </div>
          </div>
      </div>
  </section>
  <!-- product cta ends -->
