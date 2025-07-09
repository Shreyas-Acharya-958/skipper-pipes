@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid" style="padding: 20px;">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Product Sections - {{ $product->title }}</h4>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Products
                </a>
            </div>
            <div class="card-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs mb-3" id="productSectionTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview"
                            type="button" role="tab">
                            Overview
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="applications-tab" data-bs-toggle="tab" data-bs-target="#applications"
                            type="button" role="tab">
                            Applications
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="features-tab" data-bs-toggle="tab" data-bs-target="#features"
                            type="button" role="tab">
                            Features
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="faq-tab" data-bs-toggle="tab" data-bs-target="#faq" type="button"
                            role="tab">
                            FAQ
                        </button>
                    </li>
                </ul>

                <!-- Tab content -->
                <div class="tab-content" id="productSectionTabsContent">
                    <!-- Overview Section -->
                    <div class="tab-pane fade show active p-3" id="overview" role="tabpanel">
                        <div class="alert alert-info mb-4">
                            <span class="fw-bold">Information:</span> Product Overview Section
                        </div>
                        <form id="overviewForm" class="section-form"
                            action="{{ route('admin.products.sections.overview.save', $product) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="d-flex justify-content-end mb-3">
                                <button type="button" class="btn btn-primary me-2 edit-btn">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <button type="submit" class="btn btn-success save-btn" style="display: none;">
                                    <i class="fas fa-save"></i> Save
                                </button>
                            </div>

                            <div class="form-group mb-3">
                                <label for="overview_description" class="form-label">Overview Description</label>
                                <textarea class="form-control" id="overview_description" name="overview_description" rows="4" readonly>{{ $overview->overview_description ?? '' }}</textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Overview Images (Max 5 images)</label>
                                <div id="overview_images">
                                    @if (isset($overview) && $overview->overview_image)
                                        @foreach (json_decode($overview->overview_image) as $index => $image)
                                            <div class="mb-2 position-relative d-inline-block me-2">
                                                <img src="{{ asset('storage/' . $image) }}"
                                                    alt="Overview Image {{ $index + 1 }}"
                                                    style="max-width: 200px; height: auto;">
                                                <input type="hidden" name="existing_images[]" value="{{ $image }}">
                                                <button type="button"
                                                    class="btn btn-sm btn-danger position-absolute top-0 end-0 remove-image-btn"
                                                    style="display: none;" data-image="{{ $image }}">&times;</button>
                                            </div>
                                        @endforeach
                                    @endif
                                    <div class="mt-2">
                                        <input type="file" class="form-control" name="overview_images[]" multiple
                                            accept="image/*" disabled>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Applications Section -->
                    <div class="tab-pane fade p-3" id="applications" role="tabpanel">
                        <div class="alert alert-info mb-4">
                            <span class="fw-bold">Information:</span> Product Applications Section
                        </div>
                        <form id="applicationsForm" class="section-form"
                            action="{{ route('admin.products.sections.applications.save', $product) }}" method="POST">
                            @csrf
                            <div class="d-flex justify-content-between mb-3">
                                <button type="button" class="btn btn-warning add-application-btn"
                                    style="display: none;">
                                    <i class="fas fa-plus"></i> Add Application
                                </button>
                                <div>
                                    <button type="button" class="btn btn-primary me-2 edit-btn">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button type="submit" class="btn btn-success save-btn" style="display: none;">
                                        <i class="fas fa-save"></i> Save
                                    </button>
                                </div>
                            </div>

                            <div id="applications_container">
                                @if (isset($applications) && $applications->count() > 0)
                                    @foreach ($applications as $index => $application)
                                        <div class="application-item border rounded p-3 mb-3">
                                            <div class="d-flex justify-content-between mb-2">
                                                <h6 class="mb-0">Application {{ $index + 1 }}</h6>
                                                <button type="button"
                                                    class="btn btn-sm btn-danger remove-application-btn"
                                                    style="display: none;">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                            <input type="hidden" name="applications[{{ $index }}][id]"
                                                value="{{ $application->id }}">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">Image</label>
                                                        @if ($application->image)
                                                            <div class="mb-2">
                                                                <img src="{{ asset('storage/' . $application->image) }}"
                                                                    alt="Application Image"
                                                                    style="max-width: 200px; height: auto;">
                                                            </div>
                                                        @endif
                                                        <input type="file" class="form-control application-image-input"
                                                            name="applications[{{ $index }}][image_file]"
                                                            accept="image/*" readonly>
                                                        <input type="hidden"
                                                            name="applications[{{ $index }}][image_base64]"
                                                            class="image-base64-input">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">Icon</label>
                                                        @if ($application->icon)
                                                            <div class="mb-2">
                                                                <img src="{{ asset('storage/' . $application->icon) }}"
                                                                    alt="Application Icon"
                                                                    style="max-width: 50px; height: auto;">
                                                            </div>
                                                        @endif
                                                        <input type="file" class="form-control application-icon-input"
                                                            name="applications[{{ $index }}][icon_file]"
                                                            accept="image/*" readonly>
                                                        <input type="hidden"
                                                            name="applications[{{ $index }}][icon_base64]"
                                                            class="icon-base64-input">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">Title</label>
                                                        <input type="text" class="form-control"
                                                            name="applications[{{ $index }}][title]"
                                                            value="{{ $application->title }}" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Description</label>
                                                <textarea class="form-control" name="applications[{{ $index }}][description]" rows="3" readonly>{{ $application->description }}</textarea>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="text-center py-5">
                                        <p class="text-muted">No applications added yet. Click Edit and then Add
                                            Application to create one.</p>
                                    </div>
                                @endif
                            </div>
                        </form>
                    </div>

                    <!-- Features Section -->
                    <div class="tab-pane fade p-3" id="features" role="tabpanel">
                        <div class="alert alert-info mb-4">
                            <span class="fw-bold">Information:</span> Product Features Section
                        </div>
                        <form id="featuresForm" class="section-form"
                            action="{{ route('admin.products.sections.features.save', $product) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="d-flex justify-content-between mb-3">
                                <button type="button" class="btn btn-warning add-feature-btn" style="display: none;">
                                    <i class="fas fa-plus"></i> Add Feature
                                </button>
                                <div>
                                    <button type="button" class="btn btn-primary me-2 edit-btn">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button type="submit" class="btn btn-success save-btn" style="display: none;">
                                        <i class="fas fa-save"></i> Save
                                    </button>
                                </div>
                            </div>

                            <div id="features_container">
                                @if (isset($features) && $features->count() > 0)
                                    @foreach ($features as $index => $feature)
                                        <div class="feature-item border rounded p-3 mb-3">
                                            <div class="d-flex justify-content-between mb-2">
                                                <h6 class="mb-0">Feature {{ $index + 1 }}</h6>
                                                <button type="button" class="btn btn-sm btn-danger remove-feature-btn"
                                                    style="display: none;">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                            <input type="hidden" name="features[{{ $index }}][id]"
                                                value="{{ $feature->id }}">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">Image</label>
                                                        @if ($feature->image)
                                                            <div class="mb-2">
                                                                <img src="{{ asset('storage/' . $feature->image) }}"
                                                                    alt="Feature Image"
                                                                    style="max-width: 200px; height: auto;">
                                                            </div>
                                                        @endif
                                                        <input type="file" class="form-control feature-image-input"
                                                            name="features[{{ $index }}][image_file]"
                                                            accept="image/*">
                                                        <input type="hidden"
                                                            name="features[{{ $index }}][image_base64]"
                                                            class="image-base64-input">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">Icon</label>
                                                        @if ($feature->icon)
                                                            <div class="mb-2">
                                                                <img src="{{ asset('storage/' . $feature->icon) }}"
                                                                    alt="Feature Icon"
                                                                    style="max-width: 50px; height: auto;">
                                                            </div>
                                                        @endif
                                                        <input type="file" class="form-control feature-icon-input"
                                                            name="features[{{ $index }}][icon_file]"
                                                            accept="image/*" readonly>
                                                        <input type="hidden"
                                                            name="features[{{ $index }}][icon_base64]"
                                                            class="icon-base64-input">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="form-label">Title</label>
                                                <input type="text" class="form-control"
                                                    name="features[{{ $index }}][title]"
                                                    value="{{ $feature->title }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Description</label>
                                                <textarea class="form-control" name="features[{{ $index }}][description]" rows="3" readonly>{{ $feature->description }}</textarea>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="text-center py-5">
                                        <p class="text-muted">No features added yet. Click Edit and then Add Feature to
                                            create one.</p>
                                    </div>
                                @endif
                            </div>
                        </form>
                    </div>

                    <!-- FAQ Section -->
                    <div class="tab-pane fade p-3" id="faq" role="tabpanel">
                        <div class="alert alert-info mb-4">
                            <span class="fw-bold">Information:</span> Product FAQ Section
                        </div>
                        <form id="faqForm" class="section-form"
                            action="{{ route('admin.products.sections.faq.save', $product) }}" method="POST">
                            @csrf
                            <div class="d-flex justify-content-between mb-3">
                                <button type="button" class="btn btn-warning add-faq-btn" style="display: none;">
                                    <i class="fas fa-plus"></i> Add FAQ
                                </button>
                                <div>
                                    <button type="button" class="btn btn-primary me-2 edit-btn">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button type="submit" class="btn btn-success save-btn" style="display: none;">
                                        <i class="fas fa-save"></i> Save
                                    </button>
                                </div>
                            </div>

                            <div id="faqs_container">
                                @if (isset($faqs) && $faqs->count() > 0)
                                    @foreach ($faqs as $index => $faq)
                                        <div class="faq-item border rounded p-3 mb-3">
                                            <div class="d-flex justify-content-between mb-2">
                                                <h6 class="mb-0">FAQ {{ $index + 1 }}</h6>
                                                <button type="button" class="btn btn-sm btn-danger remove-faq-btn"
                                                    style="display: none;">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                            <input type="hidden" name="faqs[{{ $index }}][id]"
                                                value="{{ $faq->id }}">
                                            <div class="form-group mb-3">
                                                <label class="form-label">Question</label>
                                                <input type="text" class="form-control"
                                                    name="faqs[{{ $index }}][title]" value="{{ $faq->title }}"
                                                    readonly>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Answer</label>
                                                <textarea class="form-control" name="faqs[{{ $index }}][description]" rows="3" readonly>{{ $faq->description }}</textarea>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="text-center py-5">
                                        <p class="text-muted">No FAQs added yet. Click Edit and then Add FAQ to create one.
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Get the tab ID from URL hash or localStorage
            let activeTab = window.location.hash;
            if (!activeTab) {
                activeTab = localStorage.getItem('activeProductSectionTab') || '#overview';
            }

            // Show the active tab
            $(`button[data-bs-target="${activeTab}"]`).tab('show');

            // Store the active tab when tab is changed
            $('#productSectionTabs button[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
                const targetTab = $(e.target).data('bs-target');
                localStorage.setItem('activeProductSectionTab', targetTab);
                window.location.hash = targetTab;
            });

            // Add hidden input for active tab to all forms
            $('.section-form').append(`<input type="hidden" name="active_tab" value="${activeTab}">`);

            // Update hidden input when tab changes
            $('#productSectionTabs button[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
                const targetTab = $(e.target).data('bs-target');
                $('input[name="active_tab"]').val(targetTab);
            });

            // Handle form submission
            $('.section-form').on('submit', function(e) {
                const activeTab = localStorage.getItem('activeProductSectionTab') || '#overview';
                $(this).find('input[name="active_tab"]').val(activeTab);
            });

            // Handle Edit button click
            $('.edit-btn').click(function() {
                const form = $(this).closest('form');
                form.find('input:not([type="hidden"]), textarea, select').removeAttr('readonly disabled');
                form.find(
                    '.save-btn, .remove-image-btn, .add-application-btn, .add-feature-btn, .add-faq-btn, .remove-application-btn, .remove-feature-btn, .remove-faq-btn'
                ).show();
                $(this).hide();
            });

            // Handle Save button click
            $('.save-btn').click(function() {
                const form = $(this).closest('form');
                form.find('input:not([type="hidden"]), textarea, select').attr('readonly', 'readonly');
                form.find('input[type="file"]').attr('disabled', 'disabled');
                form.find('.edit-btn').show();
                form.find(
                    '.save-btn, .remove-image-btn, .add-application-btn, .add-feature-btn, .add-faq-btn, .remove-application-btn, .remove-feature-btn, .remove-faq-btn'
                ).hide();
            });

            // Handle overview image file input change
            $('input[name="overview_images[]"]').on('change', function(e) {
                const files = e.target.files;
                const overviewImages = [];

                // Process each selected file
                Array.from(files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        // Get the base64 string
                        const base64String = e.target.result;

                        // Create preview
                        const previewContainer = $('<div>').addClass(
                            'mb-2 position-relative d-inline-block me-2');
                        const previewImage = $('<img>')
                            .attr('src', base64String)
                            .attr('alt', 'Preview')
                            .css({
                                'max-width': '200px',
                                'height': 'auto'
                            });
                        const removeButton = $('<button>')
                            .addClass(
                                'btn btn-sm btn-danger position-absolute top-0 end-0 remove-image-btn'
                            )
                            .html('&times;')
                            .on('click', function() {
                                previewContainer.remove();
                            });

                        previewContainer.append(previewImage, removeButton);
                        $('#overview_images').prepend(previewContainer);

                        // Add base64 string to form data
                        const input = $('<input>')
                            .attr('type', 'hidden')
                            .attr('name', 'overview_images[]')
                            .val(base64String);
                        previewContainer.append(input);
                    };
                    reader.readAsDataURL(file);
                });

                // Clear the file input
                $(this).val('');
            });

            // Handle existing image removal
            $('.remove-image-btn').on('click', function() {
                $(this).closest('.position-relative').remove();
            });

            // Handle image preview for feature images and icons
            $(document).on('change', '.feature-image-input, .feature-icon-input', function() {
                const file = this.files[0];
                const container = $(this).closest('.form-group');
                const base64Input = container.find($(this).hasClass('feature-icon-input') ?
                    '.icon-base64-input' : '.image-base64-input');
                const maxWidth = $(this).hasClass('feature-icon-input') ? '50px' : '200px';

                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const base64Data = e.target.result;
                        // Store base64 data in hidden input
                        base64Input.val(base64Data);

                        const preview = `
                            <div class="mb-2">
                                <img src="${base64Data}" alt="Preview" style="max-width: ${maxWidth}; height: auto;">
                            </div>
                        `;
                        container.find('.mb-2').remove(); // Remove existing preview
                        container.find('label').after(preview);
                    }
                    reader.readAsDataURL(file);
                }
            });

            // Remove preview image
            $(document).on('click', '.remove-preview-btn', function() {
                $(this).closest('.position-relative').remove();
            });

            // Remove existing image
            $('.remove-image-btn').click(function() {
                $(this).closest('.position-relative').remove();
            });

            // Handle image preview for application images and icons
            $(document).on('change', '.application-image-input, .application-icon-input', function() {
                const file = this.files[0];
                const container = $(this).closest('.form-group');
                const base64Input = container.find($(this).hasClass('application-icon-input') ?
                    '.icon-base64-input' : '.image-base64-input');
                const maxWidth = $(this).hasClass('application-icon-input') ? '50px' : '200px';

                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const base64Data = e.target.result;
                        // Store base64 data in hidden input
                        base64Input.val(base64Data);

                        const preview = `
                            <div class="mb-2">
                                <img src="${base64Data}" alt="Preview" style="max-width: ${maxWidth}; height: auto;">
                            </div>
                        `;
                        container.find('.mb-2').remove(); // Remove existing preview
                        container.find('label').after(preview);
                    }
                    reader.readAsDataURL(file);
                }
            });

            // Template for new application
            function getNewApplicationTemplate(index) {
                return `
                <div class="application-item border rounded p-3 mb-3">
                    <div class="d-flex justify-content-between mb-2">
                        <h6 class="mb-0">Application ${index + 1}</h6>
                        <button type="button" class="btn btn-sm btn-danger remove-application-btn">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label">Image</label>
                                <input type="file" class="form-control application-image-input" name="applications[${index}][image_file]" accept="image/*">
                                <input type="hidden" name="applications[${index}][image_base64]" class="image-base64-input">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label">Icon</label>
                                <input type="file" class="form-control application-icon-input" name="applications[${index}][icon_file]" accept="image/*">
                                <input type="hidden" name="applications[${index}][icon_base64]" class="icon-base64-input">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control" name="applications[${index}][title]">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="applications[${index}][description]" rows="3"></textarea>
                    </div>
                </div>
            `;
            }

            // Template for new feature
            function getNewFeatureTemplate(index) {
                return `
                <div class="feature-item border rounded p-3 mb-3">
                    <div class="d-flex justify-content-between mb-2">
                        <h6 class="mb-0">Feature ${index + 1}</h6>
                        <button type="button" class="btn btn-sm btn-danger remove-feature-btn">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Image</label>
                                <input type="file" class="form-control feature-image-input" name="features[${index}][image_file]" accept="image/*">
                                <input type="hidden" name="features[${index}][image_base64]" class="image-base64-input">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Icon</label>
                                <input type="file" class="form-control feature-icon-input" name="features[${index}][icon_file]" accept="image/*">
                                <input type="hidden" name="features[${index}][icon_base64]" class="icon-base64-input">
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control" name="features[${index}][title]">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="features[${index}][description]" rows="3"></textarea>
                    </div>
                </div>
            `;
            }

            // Template for new FAQ
            function getNewFaqTemplate(index) {
                return `
                <div class="faq-item border rounded p-3 mb-3">
                    <div class="d-flex justify-content-between mb-2">
                        <h6 class="mb-0">FAQ ${index + 1}</h6>
                        <button type="button" class="btn btn-sm btn-danger remove-faq-btn">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Question</label>
                        <input type="text" class="form-control" name="faqs[${index}][title]">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Answer</label>
                        <textarea class="form-control" name="faqs[${index}][description]" rows="3"></textarea>
                    </div>
                </div>
            `;
            }

            // Add new application
            $('.add-application-btn').click(function() {
                const container = $('#applications_container');
                const index = container.find('.application-item').length;
                container.append(getNewApplicationTemplate(index));
            });

            // Add new feature
            $('.add-feature-btn').click(function() {
                const container = $('#features_container');
                const index = container.find('.feature-item').length;
                container.append(getNewFeatureTemplate(index));
            });

            // Add new FAQ
            $('.add-faq-btn').click(function() {
                const container = $('#faqs_container');
                const index = container.find('.faq-item').length;
                container.append(getNewFaqTemplate(index));
            });

            // Remove application
            $(document).on('click', '.remove-application-btn', function() {
                $(this).closest('.application-item').remove();
                reindexItems('application');
            });

            // Remove feature
            $(document).on('click', '.remove-feature-btn', function() {
                $(this).closest('.feature-item').remove();
                reindexItems('feature');
            });

            // Remove FAQ
            $(document).on('click', '.remove-faq-btn', function() {
                $(this).closest('.faq-item').remove();
                reindexItems('faq');
            });

            // Reindex items after removal
            function reindexItems(type) {
                $(`.${type}-item`).each(function(index) {
                    $(this).find('h6').text(`${type.charAt(0).toUpperCase() + type.slice(1)} ${index + 1}`);
                    $(this).find('input, textarea').each(function() {
                        const name = $(this).attr('name');
                        if (name) {
                            $(this).attr('name', name.replace(/\[\d+\]/, `[${index}]`));
                        }
                    });
                });
            }
        });
    </script>
@endpush

@push('styles')
    <style>
        .nav-tabs .nav-link {
            color: #495057;
            background-color: transparent;
            border: 1px solid transparent;
            border-radius: 0.25rem 0.25rem 0 0;
            padding: 0.5rem 1rem;
            margin-right: 0.25rem;
            cursor: pointer;
        }

        .nav-tabs .nav-link:hover {
            border-color: #e9ecef #e9ecef #dee2e6;
            isolation: isolate;
        }

        .nav-tabs .nav-link.active {
            color: #495057;
            background-color: #fff;
            border-color: #dee2e6 #dee2e6 #fff;
        }
    </style>
@endpush
