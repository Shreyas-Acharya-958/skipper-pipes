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
                                                        <label class="form-label">Icon Class</label>
                                                        <input type="text" class="form-control"
                                                            name="applications[{{ $index }}][icon]"
                                                            value="{{ $application->icon }}" readonly>
                                                        <small class="text-muted">Enter FontAwesome class name (e.g., fas
                                                            fa-star)</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
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
                                                        <input type="file" class="form-control"
                                                            name="features[{{ $index }}][image]" accept="image/*"
                                                            disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">Icon Class</label>
                                                        <input type="text" class="form-control"
                                                            name="features[{{ $index }}][icon]"
                                                            value="{{ $feature->icon }}" readonly>
                                                        <small class="text-muted">Enter FontAwesome class name (e.g., fas
                                                            fa-star)</small>
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
            // Keep the active tab after page refresh
            const activeTab = window.location.hash || localStorage.getItem('activeProductSectionTab') ||
                '#overview';
            $('a[data-bs-toggle="tab"][href="' + activeTab + '"]').tab('show');

            // Store the active tab when changed
            $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
                const tab = $(e.target).attr('href');
                localStorage.setItem('activeProductSectionTab', tab);
                window.location.hash = tab;
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

            // Handle image preview for overview images
            $('input[name="overview_images[]"]').change(function() {
                const files = this.files;
                const container = $('#overview_images');
                const maxFiles = 5;
                const existingImages = container.find('.position-relative').length;

                if (files.length + existingImages > maxFiles) {
                    alert('You can only upload up to ' + maxFiles + ' images');
                    this.value = '';
                    return;
                }

                Array.from(files).forEach(file => {
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const preview = `
                                <div class="mb-2 position-relative d-inline-block me-2">
                                    <img src="${e.target.result}" alt="Preview" style="max-width: 200px; height: auto;">
                                    <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 remove-preview-btn">&times;</button>
                                </div>
                            `;
                            container.find('.mt-2').before(preview);
                        }
                        reader.readAsDataURL(file);
                    }
                });
            });

            // Handle image preview for feature images
            $(document).on('change', 'input[name^="features"][name$="[image]"]', function() {
                const file = this.files[0];
                const container = $(this).closest('.form-group');

                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const preview = `
                            <div class="mb-2">
                                <img src="${e.target.result}" alt="Preview" style="max-width: 200px; height: auto;">
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
                                <label class="form-label">Icon Class</label>
                                <input type="text" class="form-control" name="applications[${index}][icon]">
                                <small class="text-muted">Enter FontAwesome class name (e.g., fas fa-star)</small>
                            </div>
                        </div>
                        <div class="col-md-8">
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
                                <input type="file" class="form-control" name="features[${index}][image]" accept="image/*">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Icon Class</label>
                                <input type="text" class="form-control" name="features[${index}][icon]">
                                <small class="text-muted">Enter FontAwesome class name (e.g., fas fa-star)</small>
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
