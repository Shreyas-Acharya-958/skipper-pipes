/* ===================================================================
    
    Author          : Valid Theme
    Template Name   : Dustra - Factory & Industrial Template
    Version         : 1.0
    
* ================================================================= */
!function(e){"use strict";e(document).ready((function(){
/* ==================================================
            # Banner Animation
        ===============================================*/
function doAnimations(a){a.each((function(){var a=e(this),t=a.data("animation");a.addClass(t).one("webkitAnimationEnd animationend",(function(){a.removeClass(t)}))}))}
//Variables on page load
new WOW({boxClass:"wow",// animated element css class (default is wow)
animateClass:"animated",// animation css class (default is animated)
offset:0,// distance to the element when triggering the animation (default is 0)
mobile:!0,// trigger animations on mobile devices (default is true)
live:!0}).init();var a=e(".animate_text"),t=a.find(".item:first").find("[data-animation ^= 'animated']");
//Initialize carousel
a.carousel(),
//Animate captions in first slide on page load
doAnimations(t),
//Other slides to be animated on carousel slide event
a.on("slide.bs.carousel",(function(a){doAnimations(e(a.relatedTarget).find("[data-animation ^= 'animated']"))})),
/* ==================================================
            # imagesLoaded active
        ===============================================*/
e("#portfolio-grid,.blog-masonry").imagesLoaded((function(){
/* Filter menu */
e(".mix-item-menu").on("click","button",(function(){var t=e(this).attr("data-filter");a.isotope({filter:t})})),
/* filter menu active class  */
e(".mix-item-menu button").on("click",(function(a){e(this).siblings(".active").removeClass("active"),e(this).addClass("active"),a.preventDefault()}));
/* Filter active */
var a=e("#portfolio-grid").isotope({itemSelector:".pf-item",percentPosition:!0,masonry:{columnWidth:".pf-item"}});
/* Filter active */e(".blog-masonry").isotope({itemSelector:".blog-item",percentPosition:!0,masonry:{columnWidth:".blog-item"}})})),
/* ==================================================
            # Fun Factor Init
        ===============================================*/
e(".timer").countTo(),e(".fun-fact").appear((function(){e(".timer").countTo()}),{accY:-100}),
/* ==================================================
            # Load More
        ===============================================*/
e(".portfolio-list").simpleLoadMore({item:".pf-item",count:3,counterInBtn:!0,btnText:"View More {showing}/{total}"}),
/* ==================================================
            # Magnific popup init
         ===============================================*/
e(".popup-link").magnificPopup({type:"image"}),e(".popup-gallery").magnificPopup({type:"image",gallery:{enabled:!0}}),e(".popup-youtube, .popup-vimeo, .popup-gmaps").magnificPopup({type:"iframe",mainClass:"mfp-fade",removalDelay:160,preloader:!1,fixedContentPos:!1}),e(".magnific-mix-gallery").each((function(){var a=e(this).find(".item"),t=[];a.each((function(){var a=e(this),i="image";a.hasClass("magnific-iframe")&&(i="iframe");var s={src:a.attr("href"),type:i};s.title=a.data("title"),t.push(s)})),a.magnificPopup({mainClass:"mfp-fade",items:t,gallery:{enabled:!0,tPrev:e(this).data("prev-text"),tNext:e(this).data("next-text")},type:"image",callbacks:{beforeOpen:function(){var e=a.index(this.st.el);-1!==e&&this.goTo(e)}}})})),
/* ==================================================
            # Services Carousel
         ===============================================*/
e(".services-carousel").owlCarousel({loop:!1,margin:30,nav:!1,navText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],dots:!0,autoplay:!1,responsive:{0:{items:1},800:{items:2},1e3:{items:3}}}),
/* ==================================================
            # Portfolio Carousel
         ===============================================*/
e(".portfolio-carousel").owlCarousel({loop:!0,margin:30,nav:!1,navText:["<i class='fal fa-long-arrow-left'></i>","<i class='fal fa-long-arrow-right'></i>"],dots:!1,autoplay:!0,responsive:{0:{items:1},800:{items:2},1300:{items:3,margin:15}}}),
/* ==================================================
            # Clients Carousel
        ===============================================*/
e(".clients-items").owlCarousel({loop:!1,margin:30,nav:!1,navText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],dots:!1,autoplay:!0,responsive:{0:{items:2},600:{items:2},1e3:{items:3}}}),
/* ==================================================
            # Team Carousel
        ===============================================*/
e(".team-carousel").owlCarousel({loop:!1,margin:30,nav:!1,navText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],dots:!0,autoplay:!0,responsive:{0:{items:1},700:{items:2},1e3:{items:3}}}),
/* ==================================================
            # Car Services Carousel
        ===============================================*/
e(".car-ser-carousel").owlCarousel({loop:!0,margin:1,nav:!1,navText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],dots:!1,autoplay:!0,responsive:{0:{items:1},800:{items:2}}}),
/* ==================================================
            # Projects Carousel
         ===============================================*/
e(".projects-carousel").owlCarousel({loop:!1,nav:!0,dots:!1,items:1,autoplay:!0,navText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"]}),
/* ==================================================
            # Default One Colums Carousel
         ===============================================*/
e(".default-one-col-carousel").owlCarousel({loop:!1,nav:!0,dots:!1,items:1,autoplay:!0,navText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"]}),
/* ==================================================
            # Testimonials Carousel
         ===============================================*/
e(".testimonials-carousel").owlCarousel({loop:!0,nav:!0,dots:!1,items:1,autoplay:!0,navText:["<i class='fas fa-long-arrow-alt-left'></i>","<i class='fas fa-long-arrow-alt-right'></i>"]}),
/* ==================================================
            Contact Form Validations
        ================================================== */
e(".contact-form").each((function(){e(this).submit((function(){var a=e(this).attr("action");return e("#message").slideUp(750,(function(){e("#message").hide(),e("#submit").after('<img src="assets/img/ajax-loader.gif" class="loader" />').attr("disabled","disabled"),e.post(a,{name:e("#name").val(),email:e("#email").val(),phone:e("#phone").val(),comments:e("#comments").val()},(function(a){document.getElementById("message").innerHTML=a,e("#message").slideDown("slow"),e(".contact-form img.loader").fadeOut("slow",(function(){e(this).remove()})),e("#submit").removeAttr("disabled")}))})),!1}))}))})),// end document ready function
/* ==================================================
        # Smooth Scroll
    ===============================================*/
e("body").scrollspy({target:".navbar-collapse",offset:200}),e("a.smooth-menu").on("click",(function(a){var t=e(this);e("html, body").stop().animate({scrollTop:e(t.attr("href")).offset().top-"75"+"px"},1500,"easeInOutExpo"),a.preventDefault()})),
/* ==================================================
        Navbar Logo
     ===============================================*/
e(window).on("scroll",(function(){var a=e("nav.navbar.bootsnav.nav-full");e(this).scrollTop()>10?(a.addClass("scrolled"),a.removeClass("no-background")):(a.removeClass("scrolled"),a.addClass("no-background"))})),
/* ==================================================
        Preloader Init
     ===============================================*/
e(window).on("load",(function(){
// Animate loader off screen
e(".se-pre-con").fadeOut("slow")})),
// home products carousel/swiper - homepage 
e(".tabs-box").length&&e(".tabs-box .tab-buttons .tab-btn").on("click",(function(a){a.preventDefault();var t=e(e(this).attr("data-tab"));if(e(t).is(":visible"))return!1;t.parents(".tabs-box").find(".tab-buttons").find(".tab-btn").removeClass("active-btn"),e(this).addClass("active-btn"),t.parents(".tabs-box").find(".tabs-content").find(".tab").fadeOut(0),t.parents(".tabs-box").find(".tabs-content").find(".tab").removeClass("active-tab"),e(t).fadeIn(300),e(t).addClass("active-tab")})),
// HOME PRODUCTS CAROUSEL - Owl Carousel
e(".home-products__carousel").each((function(){var a=e(this),t=a.find(".item").length;a.owlCarousel({items:1,margin:30,smartSpeed:700,loop:t>1,// ✅ Enable loop only if more than 1 item
autoplay:6e3,nav:!0,dots:!0,responsive:{0:{items:1},768:{items:Math.min(2,t)},992:{items:Math.min(2,t)},1200:{items:Math.min(2,t)}}}),t<=1&&a.addClass("single-item-carousel")})),e(window).on("load",(function(){
// home products carousel/swiper
!
// home products carousel/swiper - homepage
function thmOwlInit(){
// owl slider
e(".thm-owl__carousel").length&&e(".thm-owl__carousel").each((function(){let a=e(this),t=a.data("owl-options");a.owlCarousel(t)})),e(".thm-owl__carousel--custom-nav").length&&e(".thm-owl__carousel--custom-nav").each((function(){let a=e(this),t=a.data("owl-nav-prev"),i=a.data("owl-nav-next");e(t).on("click",(function(e){a.trigger("prev.owl.carousel"),e.preventDefault()})),e(i).on("click",(function(e){a.trigger("next.owl.carousel"),e.preventDefault()}))}))}()})),
// Homepage - video section popup
e(".video-popup").length&&e(".video-popup").magnificPopup({type:"iframe",mainClass:"mfp-fade",removalDelay:160,preloader:!0,fixedContentPos:!1}),
// Careers page - culture section
e(".culture-tab-buttons .nav-link").click((function(){e(".culture-tab-buttons .nav-link").removeClass("active"),e(this).addClass("active");let a=e(this).data("target");
// Show correct content
e(".culture-tab-pane-content").addClass("d-none"),e("#content-"+a).removeClass("d-none"),
// Show correct image
e(".culture-tab-image").addClass("d-none"),e("#img-"+a).removeClass("d-none")})),
// FAQs page - filter tabs accordion
e(".faq-tabs .nav-link").click((function(){
// Make tabs active
e(".faq-tabs .nav-link").removeClass("active"),e(this).addClass("active");
// Get selected category
let a=e(this).data("category");
// Show selected FAQ section only
e(".faq-section").addClass("d-none"),e('.faq-section[data-category="'+a+'"]').removeClass("d-none")})),
// Media page - filter tabs accordion
e(".media-tabs .nav-link").click((function(){
// Make tabs active
e(".media-tabs .nav-link").removeClass("active"),e(this).addClass("active");
// Get selected category
let a=e(this).data("category");
// Show selected FAQ section only
e(".media-section").addClass("d-none"),e('.media-section[data-category="'+a+'"]').removeClass("d-none")})),
// Contact page
e(document).ready((function(){e(".city-list .list-group-item").click((function(){var a=e(this).data("city");
// Update active tab
e(".city-list .list-group-item").removeClass("active"),e(this).addClass("active"),
// Show relevant location info
e(".location-info").addClass("d-none"),e("#info-"+a).removeClass("d-none"),
// Handle map pins
e(".active-pin").addClass("d-none"),e(".active-pin.pin-"+a).removeClass("d-none")}))})),
// window scroll event
e(window).on("scroll",(function(){if(e(".stricked-menu").length){var a=e(".stricked-menu");e(window).scrollTop()>130?a.addClass("stricky-fixed"):e(this).scrollTop()<=130&&a.removeClass("stricky-fixed")}if(e(".scroll-to-top").length){e(window).scrollTop()>100?e(".scroll-to-top").fadeIn(500):e(this).scrollTop()<=100&&e(".scroll-to-top").fadeOut(500)}
// OnePageMenuScroll()
}));const a=new IntersectionObserver((function(a){a.forEach((function(a){a.isIntersecting?e(a.target).addClass("show"):e(a.target).removeClass("show")}))}),{threshold:.3});e(".main-blogs-grid .blog-items .item").each((function(){a.observe(this)})),e(".business-dir-card").each((function(){a.observe(this)})),e(".business-heads-card").each((function(){a.observe(this)})),e(".certificate-col").each((function(){a.observe(this)}));
// Timeline - Overview page
new Swiper(".timeline-swiper",{slidesPerView:3,spaceBetween:40,grabCursor:!0,navigation:{nextEl:".swiper-button-next",prevEl:".swiper-button-prev"},pagination:{el:".swiper-pagination",clickable:!0},breakpoints:{992:{slidesPerView:3},768:{slidesPerView:2},0:{slidesPerView:1}}});
// Leadership poage - business directors popup
e(".view-profile-popup").magnificPopup({type:"inline",midClick:!0,removalDelay:300,mainClass:"mfp-fade"});
// Location - Manufacturing page
new Swiper(".location-swiper",{slidesPerView:3,spaceBetween:40,grabCursor:!0,navigation:{nextEl:".swiper-button-next",prevEl:".swiper-button-prev"},pagination:{el:".swiper-pagination",clickable:!0},breakpoints:{992:{slidesPerView:3},768:{slidesPerView:2},0:{slidesPerView:1}}});
// careers page
e(".partners-tab").click((function(){e(".partners-tab").removeClass("active"),e(this).addClass("active");const a=e(this).data("image");e("#tab-image").fadeOut(200,(function(){e(this).attr("src",a).fadeIn(200)}))})),
// AOS Animate
AOS.init()}(jQuery);// End jQuery