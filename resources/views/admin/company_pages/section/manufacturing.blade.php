@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid" style="padding: 20px;">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Manufacturing Page Sections</h4>
                <a href="{{ url('/admin/company-pages') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Pages
                </a>
            </div>
            <div class="card-body">
                {{-- @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif --}}

                <!-- Nav tabs -->
                <ul class="nav nav-tabs mb-3" id="manufacturingSectionTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="section1-tab" data-bs-toggle="tab" data-bs-target="#section1"
                            type="button" role="tab">
                            Manufacturing Units
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="section2-tab" data-bs-toggle="tab" data-bs-target="#section2"
                            type="button" role="tab">
                            Technology & Machinery
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="section3-tab" data-bs-toggle="tab" data-bs-target="#section3"
                            type="button" role="tab">
                            Quality Control
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="section4-tab" data-bs-toggle="tab" data-bs-target="#section4"
                            type="button" role="tab">
                            Sustainability Practices
                        </button>
                    </li>
                </ul>

                <!-- Tab content -->
                <div class="tab-content" id="manufacturingSectionTabsContent">
                    <!-- Section 1: Manufacturing Units -->
                    <div class="tab-pane fade show active p-3" id="section1" role="tabpanel">
                        <div class="alert alert-info mb-4">
                            <span class="fw-bold">Information:</span> Manufacturing Units Section
                        </div>
                        <form id="section1Form" class="section-form"
                            action="{{ route('admin.manufacturing.section1.save') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="active_tab" value="#section1">

                            <div class="d-flex justify-content-between mb-3">
                                <button type="button" class="btn btn-warning add-manufacturing-unit-btn"
                                    style="display: none;">
                                    <i class="fas fa-plus"></i> Add Manufacturing Unit
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

                            <div id="manufacturing_units_container">
                                @if (isset($sectionOnes) && $sectionOnes->count() > 0)
                                    @foreach ($sectionOnes as $index => $unit)
                                        <div class="manufacturing-unit border rounded p-3 mb-3">
                                            <div class="d-flex justify-content-between mb-2">
                                                <h6 class="mb-0">Manufacturing Unit {{ $index + 1 }}</h6>
                                                <button type="button"
                                                    class="btn btn-sm btn-danger remove-manufacturing-unit-btn"
                                                    style="display: none;">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                            <input type="hidden" name="sections[{{ $index }}][id]"
                                                value="{{ $unit->id }}">
                                            <div class="form-group mb-3">
                                                <label class="form-label">Title</label>
                                                <input type="text" class="form-control"
                                                    name="sections[{{ $index }}][title]" value="{{ $unit->title }}"
                                                    readonly required>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="form-label">Image</label>
                                                <div class="mb-2">
                                                    @if ($unit->image)
                                                        <div class="position-relative d-inline-block">
                                                            <img src="{{ asset('storage/' . $unit->image) }}"
                                                                alt="Unit Image" style="max-width: 200px; height: auto;">
                                                            <button type="button"
                                                                class="btn btn-sm btn-danger position-absolute top-0 end-0 remove-image-btn"
                                                                style="display: none;"
                                                                data-image="unit_image_{{ $index }}">&times;</button>
                                                        </div>
                                                    @endif
                                                </div>
                                                <input type="file" class="form-control"
                                                    name="sections[{{ $index }}][image]" accept="image/*" disabled>
                                                <input type="hidden" name="sections[{{ $index }}][remove_image]"
                                                    value="0">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="unit_description_{{ $index }}"
                                                    class="form-label">Description</label>
                                                <textarea class="form-control" id="unit_description_{{ $index }}"
                                                    name="sections[{{ $index }}][description]" rows="6" readonly>{{ $unit->description }}</textarea>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="text-center py-5">
                                        <p class="text-muted">No manufacturing units added yet. Click Edit and then Add
                                            Manufacturing Unit to create one.</p>
                                    </div>
                                @endif
                            </div>
                        </form>
                    </div>

                    <!-- Section 2: Technology & Machinery -->
                    <div class="tab-pane fade p-3" id="section2" role="tabpanel">
                        <div class="alert alert-info mb-4">
                            <span class="fw-bold">Information:</span> Technology & Machinery Section
                        </div>
                        <form id="section2Form" class="section-form"
                            action="{{ route('admin.manufacturing.section2.save') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="active_tab" value="#section2">

                            <div class="d-flex justify-content-end mb-3">
                                <button type="button" class="btn btn-primary me-2 edit-btn">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <button type="submit" class="btn btn-success save-btn" style="display: none;">
                                    <i class="fas fa-save"></i> Save
                                </button>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Image</label>
                                <div class="mb-2">
                                    @if (isset($sectionTwo) && $sectionTwo->image)
                                        <div class="position-relative d-inline-block">
                                            <img src="{{ asset('storage/' . $sectionTwo->image) }}"
                                                alt="Section Two Image" style="max-width: 200px; height: auto;">
                                            <button type="button"
                                                class="btn btn-sm btn-danger position-absolute top-0 end-0 remove-image-btn"
                                                style="display: none;" data-image="section2_image">&times;</button>
                                        </div>
                                    @endif
                                </div>
                                <input type="file" class="form-control" name="image" accept="image/*" disabled>
                                <input type="hidden" name="remove_image" value="0">
                            </div>

                            <div class="form-group mb-3">
                                <label for="section2_description" class="form-label">Description</label>
                                <textarea class="form-control tinymce" id="section2_description" name="description" rows="6">{{ $sectionTwo->description ?? '' }}</textarea>
                            </div>
                        </form>
                    </div>

                    <!-- Section 3: Quality Control -->
                    <div class="tab-pane fade p-3" id="section3" role="tabpanel">
                        <div class="alert alert-info mb-4">
                            <span class="fw-bold">Information:</span> Quality Control Section
                        </div>
                        <form id="section3Form" class="section-form"
                            action="{{ route('admin.manufacturing.section3.save') }}" method="POST">
                            @csrf
                            <input type="hidden" name="active_tab" value="#section3">

                            <div class="d-flex justify-content-between mb-3">
                                <button type="button" class="btn btn-warning add-quality-control-btn"
                                    style="display: none;">
                                    <i class="fas fa-plus"></i> Add Quality Control Item
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

                            <div id="quality_control_items_container">
                                @if (isset($sectionThrees) && $sectionThrees->count() > 0)
                                    @foreach ($sectionThrees as $index => $item)
                                        <div class="quality-control-item border rounded p-3 mb-3">
                                            <div class="d-flex justify-content-between mb-2">
                                                <h6 class="mb-0">Quality Control Item {{ $index + 1 }}</h6>
                                                <button type="button"
                                                    class="btn btn-sm btn-danger remove-quality-control-btn"
                                                    style="display: none;">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                            <input type="hidden" name="sections[{{ $index }}][id]"
                                                value="{{ $item->id }}">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">Icon</label>
                                                        <input type="text" class="form-control"
                                                            name="sections[{{ $index }}][icon]"
                                                            value="{{ $item->icon }}" readonly required>
                                                        <small class="text-muted">Enter icon class name (e.g., fas
                                                            fa-star)</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">Title</label>
                                                        <input type="text" class="form-control"
                                                            name="sections[{{ $index }}][title]"
                                                            value="{{ $item->title }}" readonly required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Description</label>
                                                <textarea class="form-control" name="sections[{{ $index }}][description]" rows="3" readonly required>{{ $item->description }}</textarea>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="text-center py-5">
                                        <p class="text-muted">No quality control items added yet. Click Edit and then Add
                                            Quality Control Item to create one.</p>
                                    </div>
                                @endif
                            </div>
                        </form>
                    </div>

                    <!-- Section 4: Sustainability Practices -->
                    <div class="tab-pane fade p-3" id="section4" role="tabpanel">
                        <div class="alert alert-info mb-4">
                            <span class="fw-bold">Information:</span> Sustainability Practices Section
                        </div>
                        <form id="section4Form" class="section-form"
                            action="{{ route('admin.manufacturing.section4.save') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="active_tab" value="#section4">

                            <div class="d-flex justify-content-end mb-3">
                                <button type="button" class="btn btn-primary me-2 edit-btn">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <button type="submit" class="btn btn-success save-btn" style="display: none;">
                                    <i class="fas fa-save"></i> Save
                                </button>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Image</label>
                                <div class="mb-2">
                                    @if (isset($sectionFour) && $sectionFour->image)
                                        <div class="position-relative d-inline-block">
                                            <img src="{{ asset('storage/' . $sectionFour->image) }}"
                                                alt="Section Four Image" style="max-width: 200px; height: auto;">
                                            <button type="button"
                                                class="btn btn-sm btn-danger position-absolute top-0 end-0 remove-image-btn"
                                                style="display: none;" data-image="section4_image">&times;</button>
                                        </div>
                                    @endif
                                </div>
                                <input type="file" class="form-control" name="image" accept="image/*" disabled>
                                <input type="hidden" name="remove_image" value="0">
                            </div>

                            <div class="form-group mb-3">
                                <label for="section4_description" class="form-label">Description</label>
                                <textarea class="form-control tinymce" id="section4_description" name="description" rows="6">{{ $sectionFour->description ?? '' }}</textarea>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.1.1/tinymce.min.js"></script>
        <script>
            $(document).ready(function() {
                // Get the tab ID from URL hash or localStorage
                let activeTab = window.location.hash;
                if (!activeTab) {
                    activeTab = localStorage.getItem('activeManufacturingSectionTab') || '#section1';
                }

                // Show the active tab
                $(`button[data-bs-target="${activeTab}"]`).tab('show');

                // Store the active tab when tab is changed
                $('#manufacturingSectionTabs button[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
                    const targetTab = $(e.target).data('bs-target');
                    localStorage.setItem('activeManufacturingSectionTab', targetTab);
                    window.location.hash = targetTab;
                });

                // Initialize TinyMCE for all textareas with class 'tinymce'
                const editors = ['section2_description', 'section4_description'];
                editors.forEach(editor => {
                    tinymce.init({
                        selector: `#${editor}`,
                        height: 300,
                        menubar: false,
                        plugins: 'lists link image code',
                        toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist | link image | code',
                        verify_html: false,
                        cleanup: false,
                        valid_elements: '*[*]',
                        extended_valid_elements: '*[*]',
                        valid_children: '+*[*]',
                        preserve_cdata: true,
                        entity_encoding: 'raw',
                        force_br_newlines: false,
                        force_p_newlines: false,
                        forced_root_block: '',
                        keep_styles: true
                    });
                });

                // Edit button click handler
                $('.edit-btn').click(function() {
                    const form = $(this).closest('form');
                    form.find('input:not([type="hidden"]), textarea:not(.tinymce), select').removeAttr(
                        'readonly disabled');
                    form.find(
                        '.save-btn, .remove-image-btn, .add-manufacturing-unit-btn, .remove-manufacturing-unit-btn, .add-quality-control-btn, .remove-quality-control-btn'
                    ).show();
                    $(this).hide();

                    // Enable TinyMCE editors
                    editors.forEach(editor => {
                        const tinyEditor = tinymce.get(editor);
                        if (tinyEditor) {
                            tinyEditor.mode.set('design');
                        }
                    });
                });

                // Remove image button click handler
                $('.remove-image-btn').click(function() {
                    const imageId = $(this).data('image');
                    $(this).closest('.position-relative').remove();
                    $('input[name="sections[' + imageId + '][remove_image]"]').val('1');
                });

                // Dynamic item templates
                function getManufacturingUnitTemplate(index) {
                    return `
                        <div class="manufacturing-unit border rounded p-3 mb-3">
                            <div class="d-flex justify-content-between mb-2">
                                <h6 class="mb-0">Manufacturing Unit ${index + 1}</h6>
                                <button type="button" class="btn btn-sm btn-danger remove-manufacturing-unit-btn">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control" name="sections[${index}][title]" required>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Image</label>
                                <input type="file" class="form-control" name="sections[${index}][image]" accept="image/*">
                                <input type="hidden" name="sections[${index}][remove_image]" value="0">
                            </div>
                            <div class="form-group mb-3">
                                <label for="unit_description_${index}" class="form-label">Description</label>
                                <textarea class="form-control" id="unit_description_${index}" name="sections[${index}][description]" rows="6"></textarea>
                            </div>
                        </div>
                    `;
                }

                // Add item button click handlers
                $('.add-manufacturing-unit-btn').click(function() {
                    const container = $('#manufacturing_units_container');
                    const index = container.children('.manufacturing-unit').length;
                    container.find('.text-center').remove();
                    container.append(getManufacturingUnitTemplate(index));
                });

                // Remove item button click handlers
                $(document).on('click', '.remove-manufacturing-unit-btn', function() {
                    const item = $(this).closest('.manufacturing-unit');
                    const id = item.find('input[name$="[id]""]').val();
                    if (id) {
                        const form = item.closest('form');
                        form.append($('<input>').attr({
                            type: 'hidden',
                            name: 'deleted_sections[]',
                            value: id
                        }));
                    }
                    item.remove();

                    const container = $('#manufacturing_units_container');
                    if (container.children('.manufacturing-unit').length === 0) {
                        container.html(
                            '<div class="text-center py-5"><p class="text-muted">No manufacturing units added yet. Click Edit and then Add Manufacturing Unit to create one.</p></div>'
                        );
                    }
                });

                // Dynamic item templates
                function getQualityControlItemTemplate(index) {
                    return `
                        <div class="quality-control-item border rounded p-3 mb-3">
                            <div class="d-flex justify-content-between mb-2">
                                <h6 class="mb-0">Quality Control Item ${index + 1}</h6>
                                <button type="button" class="btn btn-sm btn-danger remove-quality-control-btn">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Icon</label>
                                        <input type="text" class="form-control" name="sections[${index}][icon]" required>
                                        <small class="text-muted">Enter icon class name (e.g., fas fa-star)</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Title</label>
                                        <input type="text" class="form-control" name="sections[${index}][title]" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" name="sections[${index}][description]" rows="3" required></textarea>
                            </div>
                        </div>
                    `;
                }

                // Add item button click handlers
                $('.add-quality-control-btn').click(function() {
                    const container = $('#quality_control_items_container');
                    const index = container.children('.quality-control-item').length;
                    container.find('.text-center').remove();
                    container.append(getQualityControlItemTemplate(index));
                });

                // Remove item button click handlers
                $(document).on('click', '.remove-quality-control-btn', function() {
                    const item = $(this).closest('.quality-control-item');
                    const id = item.find('input[name$="[id]""]').val();
                    if (id) {
                        const form = item.closest('form');
                        form.append($('<input>').attr({
                            type: 'hidden',
                            name: 'deleted_sections[]',
                            value: id
                        }));
                    }
                    item.remove();

                    const container = $('#quality_control_items_container');
                    if (container.children('.quality-control-item').length === 0) {
                        container.html(
                            '<div class="text-center py-5"><p class="text-muted">No quality control items added yet. Click Edit and then Add Quality Control Item to create one.</p></div>'
                        );
                    }
                });

                // Handle form submission
                $('.section-form').on('submit', function() {
                    // Enable all fields before submit
                    $(this).find('input:not([type="hidden"]), textarea, select').removeAttr(
                        'readonly disabled');

                    // Get TinyMCE content
                    $(this).find('.tinymce').each(function() {
                        const editor = tinymce.get($(this).attr('id'));
                        if (editor) {
                            $(this).val(editor.getContent());
                        }
                    });

                    // Update active tab
                    const activeTab = localStorage.getItem('activeManufacturingSectionTab') || '#section1';
                    $(this).find('input[name="active_tab"]').val(activeTab);
                });
            });
        </script>
    @endpush
@endsection
