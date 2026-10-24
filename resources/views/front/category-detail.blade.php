@extends('front.layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/products.css') }}">
    <style>
        .services-one__single.product-cat .services-one__icon {
            background-color: #FFA800;
            position: absolute;
            top: 0;
            left: 0 !important;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 80px;
            height: 80px;
            z-index: 1;
        }

        .services-one__single.product-cat .services-one__icon i {
            color: white;
        }

        .services-one__single.product-cat .services-one__content .services-one__title {
            font-size: 22px;
            margin-bottom: 10px;
        }

        .services-one__single.product-cat .services-one__content p {
            font-size: 15px !important;
            line-height: 1.5;
        }

        .services-one__single.product-cat .services-one__content a {
            font-size: 14px;
            color: #144372;
        }

        .services-one__single.product-cat .services-one__content a:hover {
            color: #FFA800;
        }

        .product-cat-guide-sec .guide-content {
            max-width: 1000px;
            margin: 0 auto;
            text-align: center;
        }

        .product-cat-guide-sec .text-wrapper {
            position: relative;
            max-height: 105px;
            overflow: hidden;
            text-align: left;
            transition: max-height 0.6s ease;
        }

        .product-cat-guide-sec .text-wrapper h3 {
            font-size: 20px;
            font-weight: 600;
            margin: 15px 0 0;
        }

        .product-cat-guide-sec .text-wrapper:not(.expanded)::after {
            content: "";
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            height: 90px;
            background: linear-gradient(to bottom, rgba(255, 255, 255, 0), #fff);
            pointer-events: none;
        }

        .product-cat-guide-sec .text-wrapper.expanded {
            max-height: 500px;
        }

        .product-cat-guide-sec .text-wrapper.expanded::after {
            display: none;
        }

        .why-choose-card .single-item .item-inner {
            background-color: white;
            padding: 45px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .why-choose-card .single-item .item-inner img {
            width: 40px;
            margin-bottom: 20px;
        }

        .why-choose-card .single-item .item-inner h4 {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .why-choose-card .single-item .item-inner p {
            margin-bottom: 0;
            font-size: 15px;
            line-height: 1.5;
        }

        .sticky-brochure-cta {
            position: fixed;
            z-index: 9999;
        }
    </style>
@endsection

@section('content')
    @php
        $overviewImages = $productCategory->productionOverviewSection?->overview_image ?? [];
        if (is_string($overviewImages)) {
            $overviewImages = json_decode($overviewImages, true) ?? [];
        }
    @endphp

    <section class="hero-banner2 product-cat">
        <div class="hero-banner2-bg">
            <img src="{{ $productCategory->image ? asset('storage/' . $productCategory->image) : asset('assets/img/final/product-category.jpg') }}"
                alt="{{ image_alt_text('storage/' . $productCategory->image, $productCategory->name) }}">
        </div>
    </section>
    <section class="hero-banner2-responsive">
        <div class="hero-banner2-img-responsive">
            <img src="{{ $productCategory->image ? asset('storage/' . $productCategory->image) : asset('assets/img/final/product-category.jpg') }}"
                alt="{{ image_alt_text('storage/' . $productCategory->image, $productCategory->name) }}">
        </div>
    </section>

    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12 p-0">
                    <ul class="breadcrumb">
                        <li><a href="{{ route('front.home') }}"><i class="fas fa-home"></i> Home</a></li>
                        <li>Products Category</li>
                        <li class="active">{{ $productCategory->name }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    @if ($productCategory->productionOverviewSection || $productCategory->description)
        <section class="product-overview default-padding">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="site-heading text-center">
                            <h1>{{ $productCategory->name }}</h1>
                            <p class="product-overview-text">Product Overview</p>
                        </div>
                    </div>
                </div>
                <div class="row align-center">
                    <div class="col-md-6 pt-3 pt-md-0">
                        <div class="pr-md-5">{!! $productCategory->productionOverviewSection?->overview_description ?: e($productCategory->description) !!}</div>
                    </div>
                    <div class="col-md-6 order-first order-md-last">
                        @if (count($overviewImages))
                            <div id="categoryOverviewCarousel" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    @foreach ($overviewImages as $index => $image)
                                        <li data-target="#categoryOverviewCarousel" data-slide-to="{{ $index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
                                    @endforeach
                                </ol>
                                <div class="carousel-inner">
                                    @foreach ($overviewImages as $image)
                                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                            <img class="d-block w-100" src="{{ asset('storage/' . $image) }}" alt="{{ $productCategory->name }}">
                                        </div>
                                    @endforeach
                                </div>
                                @if (count($overviewImages) > 1)
                                    <a class="carousel-control-prev" href="#categoryOverviewCarousel" role="button" data-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="sr-only">Previous</span></a>
                                    <a class="carousel-control-next" href="#categoryOverviewCarousel" role="button" data-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="sr-only">Next</span></a>
                                @endif
                            </div>
                        @elseif ($productCategory->image)
                            <img class="d-block w-100" src="{{ asset('storage/' . $productCategory->image) }}" alt="{{ $productCategory->name }}">
                        @endif
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if ($productCategory->products->isNotEmpty())
        <section class="services-page-one bg-gray default-padding">
            <div class="container">
                <div class="row"><div class="col-12"><div class="site-heading text-center"><p>{{ $productCategory->name }}</p><h2>Explore Our {{ $productCategory->name }} Range</h2></div></div></div>
                <div class="row">
                    @foreach ($productCategory->products as $product)
                        <div class="col-xl-4 col-lg-6 col-md-6">
                            <div class="services-one__single product-cat">
                                <div class="services-one__img-box">
                                    <div class="services-one__img"><img src="{{ $product->page_image ? asset('storage/' . $product->page_image) : asset('assets/img/final/product-category.jpg') }}" alt="{{ image_alt_text('storage/' . $product->page_image, $product->title) }}"></div>
                                    <div class="services-one__icon"><img src="{{ asset('assets/img/final2/Product-category/products-icon.svg') }}" alt=""></div>
                                    <a href="{{ route('front.products.show', $product->slug) }}" class="services-one__arrow"></a>
                                </div>
                                <div class="services-one__content">
                                    <h3 class="services-one__title">{{ $product->title }}</h3>
                                    <p>{{ strip_tags($product->product_overview ?? '') }}</p>
                                    <a href="{{ route('front.products.show', $product->slug) }}">VIEW PRODUCT <i class="far fa-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Category Applications are hidden until the reference layout includes this section.
    @if ($productCategory->productionApplicationSections->isNotEmpty())
        <section class="services-page-one default-padding">
            <div class="container">
                <div class="row"><div class="col-12"><div class="site-heading text-center"><p>{{ $productCategory->name }}</p><h2>Applications</h2></div></div></div>
                <div class="row">
                    @foreach ($productCategory->productionApplicationSections as $application)
                        <div class="col-xl-4 col-lg-6 col-md-6 mb-4">
                            <div class="services-one__single product-cat">
                                @if ($application->image)<div class="services-one__img"><img src="{{ asset('storage/' . $application->image) }}" alt="{{ $application->title }}"></div>@endif
                                <div class="services-one__content"><h3 class="services-one__title">{{ $application->title }}</h3><div>{!! $application->description !!}</div></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    --}}

    @if ($productCategory->guide_content)
        <section class="product-cat-guide-sec default-padding">
            <div class="container">
                <div class="row"><div class="col-12"><div class="site-heading text-center"><p>{{ $productCategory->name }}</p><h2>A Complete Guide to {{ $productCategory->name }}</h2></div></div></div>
                <div class="row"><div class="col-12"><div class="guide-content">
                    <div class="text-wrapper" id="guideText">{!! $productCategory->guide_content !!}</div>
                    <a class="btn btn-dark theme theme2 btn-md mt-5 btn-text" id="readMoreBtn" role="button" tabindex="0" aria-controls="guideText" aria-expanded="false">
                        <span class="btn-text">READ MORE</span>
                        <span class="arrow" aria-hidden="true">↓</span>
                    </a>
                </div></div></div>
            </div>
        </section>
    @endif

    @if ($productCategory->productionFeaturesSections->isNotEmpty())
        <section class="key-features-benefits bg-gray">
            <div class="work-process-area relative default-padding bottom-less bg-fixed">
                <div class="container">
                    <div class="row"><div class="col-12"><div class="site-heading text-center"><p>{{ $productCategory->name }}</p><h2>Why Choose {{ $productCategory->name }}</h2></div></div></div>
                    <div class="why-choose-card"><div class="row">
                        @foreach ($productCategory->productionFeaturesSections as $feature)
                            @php
                                $featureDescription = strip_tags($feature->description ?? '', '<p><br><strong><em><b><i><ul><ol><li><a><h3><h4>');
                                $featureDescription = trim(preg_replace('/\s+/', ' ', str_ireplace('&nbsp;', ' ', $featureDescription)));
                            @endphp
                            <div class="col-lg-4 col-md-6 single-item"><div class="item-inner">
                                @if ($feature->icon)<img src="{{ asset('storage/' . $feature->icon) }}" alt="{{ $feature->title }}">@elseif ($feature->image)<img src="{{ asset('storage/' . $feature->image) }}" alt="{{ $feature->title }}">@endif
                                <h4>{{ $feature->title }}</h4><div>{!! $featureDescription !!}</div>
                            </div></div>
                        @endforeach
                    </div></div>
                </div>
            </div>
        </section>
    @endif

    @if ($productCategory->productionFaqSections->isNotEmpty())
        <section class="product-faq default-padding">
            <div class="container">
                <div class="row"><div class="col-12"><div class="site-heading text-center"><p>{{ $productCategory->name }}</p><h2>Frequently Asked Questions</h2></div></div></div>
                <div class="row"><div class="col-12"><div class="accordion" id="categoryFaqAccordion">
                    @foreach ($productCategory->productionFaqSections as $faq)
                        @php
                            $faqDescription = strip_tags($faq->description ?? '', '<p><br><strong><em><b><i><ul><ol><li><a><h3><h4>');
                            $faqDescription = trim(preg_replace('/\s+/', ' ', str_ireplace('&nbsp;', ' ', $faqDescription)));
                        @endphp
                        <div class="card">
                            <div class="card-header" id="categoryFaqHeading{{ $faq->id }}"><h2 class="mb-0"><button class="btn btn-link btn-block text-left {{ $loop->first ? '' : 'collapsed' }}" type="button" data-toggle="collapse" data-target="#categoryFaq{{ $faq->id }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}">{{ $faq->title }}</button></h2></div>
                            <div id="categoryFaq{{ $faq->id }}" class="collapse {{ $loop->first ? 'show' : '' }}" data-parent="#categoryFaqAccordion"><div class="card-body">{!! $faqDescription !!}</div></div>
                        </div>
                    @endforeach
                </div></div></div>
            </div>
        </section>
    @endif

    @if ($productCategory->brochure || $productCategory->technical_brochure)
        <section class="product-cta bg-theme text-white default-padding">
            <div class="container"><div class="row"><div class="col-12 text-center">
                <h2 class="text-white mb-4">Everything You Need to Know</h2>
                @if ($productCategory->brochure)<a class="btn btn-light effect btn-md mr-md-3 mb-3 js-download-category-brochure" data-brochure-type="category" data-toggle="modal" data-target="#categoryBrochurePopup">Download Category Brochure</a>@endif
                @if ($productCategory->technical_brochure)<a class="btn btn-light effect btn-md js-download-category-brochure" data-brochure-type="technical" data-toggle="modal" data-target="#categoryBrochurePopup">Download Technical Brochure</a>@endif
            </div></div></div>
        </section>
        <div class="sticky-brochure-cta">
            @if ($productCategory->brochure)<a class="btn btn-light effect btn-md js-download-category-brochure" data-brochure-type="category" data-toggle="modal" data-target="#categoryBrochurePopup">Category Brochure <br><span>Download</span></a>@endif
            @if ($productCategory->technical_brochure)<a class="btn btn-light technical-btn effect btn-md js-download-category-brochure" data-brochure-type="technical" data-toggle="modal" data-target="#categoryBrochurePopup">Technical Brochure <br><span>Download</span></a>@endif
        </div>
        @include('front.category-popup')
    @endif
@endsection

@section('scripts')
    @if ($productCategory->guide_content)
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const guideText = document.getElementById('guideText');
                const readMoreBtn = document.getElementById('readMoreBtn');

                if (!guideText || !readMoreBtn) {
                    return;
                }

                if (guideText.scrollHeight <= guideText.clientHeight) {
                    readMoreBtn.hidden = true;
                    return;
                }

                function toggleGuide(event) {
                    event.preventDefault();
                    const expanded = guideText.classList.toggle('expanded');
                    readMoreBtn.setAttribute('aria-expanded', expanded ? 'true' : 'false');
                    readMoreBtn.querySelector('.btn-text').textContent = expanded ? 'READ LESS' : 'READ MORE';
                    readMoreBtn.querySelector('.arrow').textContent = expanded ? '↑' : '↓';
                }

                readMoreBtn.addEventListener('click', toggleGuide);
                readMoreBtn.addEventListener('keydown', function(event) {
                    if (event.key === 'Enter' || event.key === ' ') {
                        toggleGuide(event);
                    }
                });
            });
        </script>
    @endif
    @if ($productCategory->brochure || $productCategory->technical_brochure)
        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.21.0/dist/jquery.validate.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.21.0/dist/additional-methods.min.js"></script>
        <script>
            $(document).on('click', '.js-download-category-brochure', function() {
                const brochureType = $(this).data('brochure-type');
                $('#category_inquiry_brochure_type').val(brochureType);
                $('#categoryBrochurePopup .typeofbrchure').text(brochureType === 'technical' ? 'Technical' : 'Category');
                $('#categoryBrochureFormSection').show();
                $('#categoryBrochureThankYouSection').hide();
            });
            $.validator.addMethod('validEmail', function(value, element) {
                return this.optional(element) || /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/.test(value);
            }, 'Please enter a valid email address.');
            $.validator.addMethod('alphaOnly', function(value, element) {
                return this.optional(element) || /^[A-Za-z]+(?: [A-Za-z]+)*$/.test(value);
            }, 'Please enter letters only.');
            $('#categoryBrochureForm').validate({
                rules: {
                    name: { required: true, alphaOnly: true },
                    email: { email: true, validEmail: true },
                    mobile: { required: true, digits: true, minlength: 10, maxlength: 12 },
                    pincode: { required: true, digits: true, minlength: 6, maxlength: 6 }
                },
                submitHandler: function(form) {
                    const $form = $(form);
                    const $button = $form.find('[type="submit"]');
                    $button.prop('disabled', true);
                    $.ajax({
                        url: $form.attr('action'),
                        type: 'POST',
                        dataType: 'json',
                        data: $form.serialize(),
                        success: function(response) {
                            $form[0].reset();
                            $form.validate().resetForm();
                            $('#categoryBrochureFormSection').hide();
                            $('#categoryBrochureThankYouSection').show();
                            $('#categoryBrochureDownload').attr('href', response.file_url).attr('download', response.file_name).text('Download ' + (response.brochure === 'technical' ? 'Technical' : 'Category') + ' Brochure');
                        },
                        error: function(xhr) {
                            if (xhr.status === 422 && xhr.responseJSON.errors) {
                                $.each(xhr.responseJSON.errors, function(field, messages) {
                                    const input = $form.find('[name="' + field + '"]');
                                    input.addClass('error').after('<label class="error">' + messages[0] + '</label>');
                                });
                            }
                        },
                        complete: function() { $button.prop('disabled', false); }
                    });
                    return false;
                }
            });
        </script>
    @endif
@endsection
