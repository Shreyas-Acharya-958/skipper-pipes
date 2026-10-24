@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid" style="padding: 20px;">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Category Sections - {{ $productCategory->name }}</h4>
                <a href="{{ route('admin.product_categories.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Categories
                </a>
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs mb-3" id="categorySectionTabs" role="tablist">
                    <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#overview" type="button">Overview</button></li>
                    {{-- <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#applications" type="button">Applications</button></li> --}}
                    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#features" type="button">Features</button></li>
                    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#faq" type="button">FAQ</button></li>
                    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#brochures" type="button">Brochures</button></li>
                    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#seo" type="button">SEO</button></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade show active p-3" id="overview">
                        @php
                            $overviewImages = json_decode($overview->overview_image ?? '[]', true) ?? [];
                            $hasOverviewData = $overview && (($overview->overview_description ?? null) || !empty($overviewImages) || $productCategory->guide_content);
                        @endphp
                        <form class="category-section-form" action="{{ route('admin.product_categories.sections.overview.save', $productCategory) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="d-flex justify-content-end mb-3">
                                @if ($hasOverviewData)
                                    <button type="button" class="btn btn-primary me-2 edit-btn">Edit</button>
                                    <button type="submit" class="btn btn-success save-btn" style="display:none">Save</button>
                                @else
                                    <button type="submit" class="btn btn-success save-btn">Save</button>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Overview Description</label>
                                <textarea class="form-control tinymce" name="overview_description" rows="5" @if ($hasOverviewData) readonly @endif>{{ $overview->overview_description ?? '' }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Overview Images (Max 5 images)</label>
                                @foreach ($overviewImages as $image)
                                    <div class="mb-2 position-relative d-inline-block me-2">
                                        <img src="{{ asset('storage/' . $image) }}" alt="Overview Image" style="max-width:200px">
                                        <input type="hidden" name="existing_images[]" value="{{ $image }}">
                                        <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 remove-image-btn" @if ($hasOverviewData) style="display:none" @endif>&times;</button>
                                    </div>
                                @endforeach
                                <input type="file" class="form-control" name="overview_images[]" accept="image/*" multiple @if ($hasOverviewData) disabled @endif>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Complete Guide Content</label>
                                <textarea class="form-control tinymce" name="guide_content" rows="8" @if ($hasOverviewData) readonly @endif>{{ $productCategory->guide_content }}</textarea>
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane fade p-3" id="brochures">
                        @php $hasBrochureData = $productCategory->brochure || $productCategory->technical_brochure; @endphp
                        <form action="{{ route('admin.product_categories.update', $productCategory) }}" method="POST" enctype="multipart/form-data" class="border rounded p-3">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="name" value="{{ $productCategory->name }}">
                            <input type="hidden" name="slug" value="{{ $productCategory->slug }}">
                            <input type="hidden" name="description" value="{{ $productCategory->description }}">
                            <input type="hidden" name="status" value="{{ $productCategory->status }}">
                            <div class="d-flex justify-content-between mb-3"><h5>Category Brochures</h5><div>@if ($hasBrochureData)<button type="button" class="btn btn-primary me-2 edit-btn">Edit</button><button type="submit" class="btn btn-success save-btn" style="display:none">Save</button>@else<button type="submit" class="btn btn-success save-btn">Save</button>@endif</div></div>
                            @foreach (['brochure' => 'Category Brochure', 'technical_brochure' => 'Technical Brochure'] as $field => $label)
                                <div class="mb-3">
                                    <label class="form-label">{{ $label }}</label>
                                    @if ($productCategory->$field)
                                        <div class="mb-2"><a href="{{ asset('storage/' . $productCategory->$field) }}" target="_blank">View current file</a></div>
                                        <label class="form-check-label"><input class="form-check-input" type="checkbox" name="remove_{{ $field }}" value="1" @if ($hasBrochureData) disabled @endif> Remove current file</label>
                                    @endif
                                    <input type="file" class="form-control" name="{{ $field }}" accept=".pdf,.doc,.docx" @if ($hasBrochureData) disabled @endif>
                                </div>
                            @endforeach
                        </form>
                    </div>

                    <div class="tab-pane fade p-3" id="seo">
                        @php
                            $seoFields = ['meta_title', 'meta_description', 'meta_keywords', 'canonical_url', 'robots', 'og_title', 'og_description', 'og_type', 'twitter_title', 'twitter_description', 'twitter_card'];
                            $hasSeoData = collect($seoFields)->contains(fn ($field) => filled($productCategory->$field));
                        @endphp
                        <form class="category-section-form" action="{{ route('admin.product_categories.sections.seo.save', $productCategory) }}" method="POST">
                            @csrf
                            <div class="d-flex justify-content-end mb-3">
                                @if ($hasSeoData)
                                    <button type="button" class="btn btn-primary me-2 edit-btn">Edit</button>
                                    <button type="submit" class="btn btn-success save-btn" style="display:none">Save</button>
                                @else
                                    <button type="submit" class="btn btn-success save-btn">Save</button>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="category_meta_title">Meta Title</label>
                                <input class="form-control" id="category_meta_title" name="meta_title" value="{{ old('meta_title', $productCategory->meta_title) }}" @if ($hasSeoData) readonly @endif>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="category_meta_description">Meta Description</label>
                                <textarea class="form-control" id="category_meta_description" name="meta_description" rows="3" @if ($hasSeoData) readonly @endif>{{ old('meta_description', $productCategory->meta_description) }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="category_meta_keywords">Meta Keywords</label>
                                <input class="form-control" id="category_meta_keywords" name="meta_keywords" value="{{ old('meta_keywords', $productCategory->meta_keywords) }}" @if ($hasSeoData) readonly @endif>
                                <small class="text-muted">Separate keywords with commas.</small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="category_canonical_url">Canonical URL</label>
                                <input class="form-control" id="category_canonical_url" name="canonical_url" value="{{ old('canonical_url', $productCategory->canonical_url) }}" @if ($hasSeoData) readonly @endif>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="category_robots">Robots</label>
                                <input class="form-control" id="category_robots" name="robots" value="{{ old('robots', $productCategory->robots) }}" @if ($hasSeoData) readonly @endif>
                            </div>
                            <h5>Open Graph</h5>
                            <div class="mb-3">
                                <label class="form-label" for="category_og_title">OG Title</label>
                                <input class="form-control" id="category_og_title" name="og_title" value="{{ old('og_title', $productCategory->og_title) }}" @if ($hasSeoData) readonly @endif>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="category_og_description">OG Description</label>
                                <textarea class="form-control" id="category_og_description" name="og_description" rows="3" @if ($hasSeoData) readonly @endif>{{ old('og_description', $productCategory->og_description) }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="category_og_type">OG Type</label>
                                <input class="form-control" id="category_og_type" name="og_type" value="{{ old('og_type', $productCategory->og_type) }}" @if ($hasSeoData) readonly @endif>
                            </div>
                            <h5>Twitter</h5>
                            <div class="mb-3">
                                <label class="form-label" for="category_twitter_title">Twitter Title</label>
                                <input class="form-control" id="category_twitter_title" name="twitter_title" value="{{ old('twitter_title', $productCategory->twitter_title) }}" @if ($hasSeoData) readonly @endif>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="category_twitter_description">Twitter Description</label>
                                <textarea class="form-control" id="category_twitter_description" name="twitter_description" rows="3" @if ($hasSeoData) readonly @endif>{{ old('twitter_description', $productCategory->twitter_description) }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="category_twitter_card">Twitter Card</label>
                                <input class="form-control" id="category_twitter_card" name="twitter_card" value="{{ old('twitter_card', $productCategory->twitter_card) }}" @if ($hasSeoData) readonly @endif>
                            </div>
                        </form>
                    </div>

                    {{-- Category Applications are hidden until the reference layout includes this section.
                    <div class="tab-pane fade p-3" id="applications">
                        <form class="category-section-form" action="{{ route('admin.product_categories.sections.applications.save', $productCategory) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="d-flex justify-content-between mb-3"><button type="button" class="btn btn-warning add-item" data-type="application">Add Application</button><div><button type="button" class="btn btn-primary me-2 edit-btn">Edit</button><button type="submit" class="btn btn-success save-btn" style="display:none">Save</button></div></div>
                            <div id="applications_container">
                                @foreach ($applications as $index => $application)
                                    <div class="border rounded p-3 mb-3 application-item">
                                        <input type="hidden" name="applications[{{ $index }}][id]" value="{{ $application->id }}">
                                        <div class="mb-3"><label class="form-label">Title</label><input class="form-control" name="applications[{{ $index }}][title]" value="{{ $application->title }}" readonly></div>
                                        <div class="mb-3"><label class="form-label">Description</label><textarea class="form-control tinymce" name="applications[{{ $index }}][description]" rows="4" readonly>{{ $application->description }}</textarea></div>
                                        <div class="row"><div class="col-md-6"><label class="form-label">Image</label>@if ($application->image)<div><img src="{{ asset('storage/' . $application->image) }}" style="max-width:150px"></div>@endif<input class="form-control" type="file" name="applications[{{ $index }}][image]" accept="image/*" disabled></div><div class="col-md-6"><label class="form-label">Icon</label>@if ($application->icon)<div><img src="{{ asset('storage/' . $application->icon) }}" style="max-width:60px"></div>@endif<input class="form-control" type="file" name="applications[{{ $index }}][icon]" accept="image/*" disabled></div></div>
                                        <button type="button" class="btn btn-sm btn-danger remove-item mt-3" style="display:none">Remove</button>
                                    </div>
                                @endforeach
                            </div>
                        </form>
                    </div>
                    --}}

                    <div class="tab-pane fade p-3" id="features">
                        <form class="category-section-form" action="{{ route('admin.product_categories.sections.features.save', $productCategory) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="d-flex justify-content-between mb-3"><button type="button" class="btn btn-warning add-item" data-type="feature">Add Feature</button><div>@if ($features->isNotEmpty())<button type="button" class="btn btn-primary me-2 edit-btn">Edit</button><button type="submit" class="btn btn-success save-btn" style="display:none">Save</button>@else<button type="submit" class="btn btn-success save-btn">Save</button>@endif</div></div>
                            <div id="features_container">
                                @foreach ($features as $index => $feature)
                                    <div class="border rounded p-3 mb-3 feature-item">
                                        <input type="hidden" name="features[{{ $index }}][id]" value="{{ $feature->id }}">
                                        <div class="mb-3"><label class="form-label">Title</label><input class="form-control" name="features[{{ $index }}][title]" value="{{ $feature->title }}" @if ($features->isNotEmpty()) readonly @endif></div>
                                        <div class="mb-3"><label class="form-label">Description</label><textarea class="form-control tinymce" name="features[{{ $index }}][description]" rows="4" @if ($features->isNotEmpty()) readonly @endif>{{ $feature->description }}</textarea></div>
                                        <div class="row"><div class="col-md-6"><label class="form-label">Image</label>@if ($feature->image)<div><img src="{{ asset('storage/' . $feature->image) }}" style="max-width:150px"></div>@endif<input class="form-control" type="file" name="features[{{ $index }}][image]" accept="image/*" @if ($features->isNotEmpty()) disabled @endif></div><div class="col-md-6"><label class="form-label">Icon</label>@if ($feature->icon)<div><img src="{{ asset('storage/' . $feature->icon) }}" style="max-width:60px"></div>@endif<input class="form-control" type="file" name="features[{{ $index }}][icon]" accept="image/*" @if ($features->isNotEmpty()) disabled @endif></div></div>
                                        <button type="button" class="btn btn-sm btn-danger remove-item mt-3" style="display:none">Remove</button>
                                    </div>
                                @endforeach
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane fade p-3" id="faq">
                        <form class="category-section-form" action="{{ route('admin.product_categories.sections.faq.save', $productCategory) }}" method="POST">
                            @csrf
                            <div class="d-flex justify-content-between mb-3"><button type="button" class="btn btn-warning add-item" data-type="faq">Add FAQ</button><div>@if ($faqs->isNotEmpty())<button type="button" class="btn btn-primary me-2 edit-btn">Edit</button><button type="submit" class="btn btn-success save-btn" style="display:none">Save</button>@else<button type="submit" class="btn btn-success save-btn">Save</button>@endif</div></div>
                            <div id="faqs_container">
                                @foreach ($faqs as $index => $faq)
                                    <div class="border rounded p-3 mb-3 faq-item">
                                        <input type="hidden" name="faqs[{{ $index }}][id]" value="{{ $faq->id }}">
                                        <div class="mb-3"><label class="form-label">Question</label><input class="form-control" name="faqs[{{ $index }}][title]" value="{{ $faq->title }}" @if ($faqs->isNotEmpty()) readonly @endif></div>
                                        <div class="mb-3"><label class="form-label">Answer</label><textarea class="form-control tinymce" name="faqs[{{ $index }}][description]" rows="4" @if ($faqs->isNotEmpty()) readonly @endif>{{ $faq->description }}</textarea></div>
                                        <button type="button" class="btn btn-sm btn-danger remove-item" style="display:none">Remove</button>
                                    </div>
                                @endforeach
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.1.1/tinymce.min.js"></script>
    <script>
        $(document).ready(function() {
            let activeTab = window.location.hash || localStorage.getItem('activeCategorySectionTab') || '#overview';
            $(`#categorySectionTabs button[data-bs-target="${activeTab}"]`).tab('show');
            tinymce.init({
                selector: 'textarea.tinymce:not(.mce-initialized)',
                menubar: false,
                plugins: 'lists link',
                toolbar: 'undo redo | bold italic | bullist numlist | link',
                setup: function(editor) {
                    editor.on('init', function() {
                        $(editor.getElement()).addClass('mce-initialized');
                    });
                }
            });
            $('#categorySectionTabs button[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
                activeTab = $(e.target).data('bs-target');
                localStorage.setItem('activeCategorySectionTab', activeTab);
                window.location.hash = activeTab;
            });
            $('.category-section-form').on('submit', function() {
                if (window.tinymce) {
                    tinymce.triggerSave();
                }
            });
            $('.edit-btn').click(function() {
                const form = $(this).closest('form');
                form.find('input:not([type="hidden"]), textarea, select').removeAttr('readonly disabled');
                form.find('.save-btn, .add-item, .remove-item, .remove-image-btn').show();
                $(this).hide();
            });
            let applicationIndex = {{ $applications->count() }};
            let featureIndex = {{ $features->count() }};
            let faqIndex = {{ $faqs->count() }};
            $('.add-item').click(function() {
                const type = $(this).data('type');
                const form = $(this).closest('form');
                form.find('input:not([type="hidden"]), textarea, select').removeAttr('readonly disabled');
                form.find('.edit-btn').hide();
                form.find('.save-btn, .add-item, .remove-item').show();
                let index;
                let fields;
                if (type === 'application') {
                    index = applicationIndex++;
                    fields = `<div class="mb-3"><label class="form-label">Title</label><input class="form-control" name="applications[${index}][title]" required></div><div class="mb-3"><label class="form-label">Description</label><textarea class="form-control tinymce" name="applications[${index}][description]" rows="4" required></textarea></div><div class="row"><div class="col-md-6"><label class="form-label">Image</label><input class="form-control" type="file" name="applications[${index}][image]" accept="image/*"></div><div class="col-md-6"><label class="form-label">Icon</label><input class="form-control" type="file" name="applications[${index}][icon]" accept="image/*"></div></div>`;
                } else if (type === 'feature') {
                    index = featureIndex++;
                    fields = `<div class="mb-3"><label class="form-label">Title</label><input class="form-control" name="features[${index}][title]"></div><div class="mb-3"><label class="form-label">Description</label><textarea class="form-control tinymce" name="features[${index}][description]" rows="4"></textarea></div><div class="row"><div class="col-md-6"><label class="form-label">Image</label><input class="form-control" type="file" name="features[${index}][image]" accept="image/*"></div><div class="col-md-6"><label class="form-label">Icon</label><input class="form-control" type="file" name="features[${index}][icon]" accept="image/*"></div></div>`;
                } else {
                    index = faqIndex++;
                    fields = `<div class="mb-3"><label class="form-label">Question</label><input class="form-control" name="faqs[${index}][title]" required></div><div class="mb-3"><label class="form-label">Answer</label><textarea class="form-control tinymce" name="faqs[${index}][description]" rows="4"></textarea></div>`;
                }
                const item = $(`<div class="border rounded p-3 mb-3 ${type}-item">${fields}<button type="button" class="btn btn-sm btn-danger remove-item mt-3">Remove</button></div>`);
                $('#' + (type === 'faq' ? 'faqs' : type + 's') + '_container').append(item);
                tinymce.init({target: item.find('textarea.tinymce')[0], menubar: false, plugins: 'lists link', toolbar: 'undo redo | bold italic | bullist numlist | link'});
            });
            $(document).on('click', '.remove-item', function() {
                $(this).closest('.application-item, .feature-item, .faq-item').remove();
            });
            $(document).on('click', '.remove-image-btn', function() {
                $(this).closest('.position-relative').remove();
            });
        });
    </script>
@endpush
