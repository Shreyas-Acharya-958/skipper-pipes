 <!-- MD Directors message -->


 @if ($leadership_section_ones->count() > 0)
     <section class="md-message default-padding bg-gray">
         <div class="container">
             <div class="row">
                 <div class="col-12 text-center">
                     <div class="site-heading headings">
                         <h4>SKipper Pipes</h4>
                         <h2>Words from the Top!</h2>
                     </div>
                 </div>
             </div>
             <div class="row align-center">
                 <div class="col-md-5">
                     <img src="{{ asset('storage/' . $leadership_section_ones[0]->image ?? '') }}" alt="">
                 </div>
                 <div class="col-md-7 pl-5 md-message-content">
                     {!! $leadership_section_ones[0]->description ?? '' !!}
                 </div>
             </div>
         </div>
     </section>
 @endif


 @if ($leadership_section_twos->count() > 0)
     <!-- Our Philosophy  -->
     <section class="philosophy-sec default-padding">
         <div class="container">
             <div class="row">
                 <div class="col-12 text-center">
                     <div class="site-heading headings">
                         <h4>Skipper Pipes</h4>
                         <h2>Leadership Philosophy</h2>
                         <p class="site-description">At Skipper Pipes, leadership is defined by three enduring
                             principles:
                         </p>
                     </div>
                 </div>
             </div>
             <div class="row philosophy-wrapper text-center mt-5">
                 @foreach ($leadership_section_twos as $leadership)
                     <div class="col-12 col-md philosophy-col">
                         <i class="{{ $leadership->icon ?? 'fas fa-hard-hat' }} icon"></i>
                         <h4>{{ $leadership->title ?? '' }}</h4>
                         <p>{!! $leadership->description ?? '' !!}</p>
                     </div>
                 @endforeach

             </div>
         </div>
     </section>
     <!-- Our Philosophy ends -->
 @endif
 <!-- Business Directors Section -->
 @if ($leadership_section_threes->count() > 0)
     <section class="business-directors-sec default-padding bg-gray">
         <div class="container">
             <div class="row">
                 <div class="col-12 text-center">
                     <div class="site-heading headings">
                         <h4>Skipper Pipes</h4>
                         <h2>Business Directors</h2>
                     </div>
                 </div>
             </div>
             <div class="row">
                 <!-- Business Director 1 -->
                 @foreach ($leadership_section_threes as $leadership)
                     <div class="col-md-3">
                         <div class="business-dir-card">
                             <div class="business-dir-img">
                                 <img src="{{ asset('storage/' . $leadership->image ?? '') }}" alt="">
                             </div>
                             <div class="business-dir-content">
                                 <h3 class="dir-name">{{ $leadership->name ?? '' }}</h3>
                                 <span class="dir-designation">{{ $leadership->role ?? '' }}</span>
                                 <a href="#team-popup-siddarth" class="dir-link view-profile-popup">View Profile <i
                                         class="far fa-arrow-right"></i></a>
                             </div>
                         </div>

                         <!-- Popup Content (hidden) -->
                         <div id="team-popup-siddarth" class="mfp-hide team-popup">
                             <button title="Close" class="mfp-close">&times;</button>
                             <img src="{{ asset('storage/' . $leadership->image ?? '') }}"
                                 alt="{{ $leadership->name ?? '' }}">
                             <h4>{{ $leadership->name ?? '' }}</h4>
                             <p class="designation">{{ $leadership->role ?? '' }}</p>
                             <p>{!! $leadership->description ?? '' !!}</p>
                         </div>
                     </div>
                 @endforeach

             </div>
         </div>
     </section>
     <!-- Business Directors Section emds -->
 @endif


 <!-- Business Directors Section -->
 <section class="business-heads-sec default-padding">
     <div class="container">
         <div class="row">
             <div class="col-12 text-center">
                 <div class="site-heading headings">
                     <h4>Skipper Pipes</h4>
                     <h2>Business Heads</h2>
                 </div>
             </div>
         </div>
         <div class="row">
             @foreach ($leadership_section_fours as $leadership)
                 <!-- Business Head 1 -->
                 <div class="col-md-3">
                     <div class="business-heads-card">
                         <div class="business-heads-img">
                             <img src="{{ asset('storage/' . $leadership->image) }}" alt="">
                         </div>
                         <div class="business-heads-content">
                             <h3 class="heads-name">{{ $leadership->name }} </h3>
                             <span class="heads-designation">{{ $leadership->role }}</span>
                             <a href="#team-popup-siddarth31" class="heads-link view-profile-popup">View Profile <i
                                     class="far fa-arrow-right"></i></a>
                         </div>
                     </div>
                     <!-- Popup Content (hidden) -->
                     <div id="team-popup-siddarth31" class="mfp-hide team-popup">
                         <button title="Close" class="mfp-close">&times;</button>
                         <img src="assets/img/final/anirban-paul.png" alt="Mr. Siddharth Bansal">
                         <h4>Mr. Anirban P</h4>
                         <p class="designation">CMO</p>
                         <p>{!! $leadership->description ?? '' !!}</p>
                     </div>
                 </div>
             @endforeach

         </div>
     </div>
 </section>
 <!-- Business Directors Section emds -->








 <!-- product cta -->
 <section class="product-cta bg-theme text-white default-padding">
     <div class="container">
         <div class="row">
             <div class="col-12 text-center">
                 <h2 class="text-white mb-4">See how our vision translates into world-class manufacturing.</h2>
                 <a class="btn btn-light effect btn-md" href="manufacturing.html">Know Our Facilities</a>
             </div>
         </div>
     </div>
 </section>
 <!-- product cta ends -->
