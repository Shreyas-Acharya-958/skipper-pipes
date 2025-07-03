@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid" style="padding: 20px;">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">CSR Page Sections</h4>
                <a href="javascript:history.back()" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Pages
                </a>
            </div>
            <div class="card-body">
                @if (session('success'))
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
                @endif

                <!-- Nav tabs -->
                <ul class="nav nav-tabs mb-3" id="csrSectionTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="section1-tab" data-bs-toggle="tab" data-bs-target="#section1"
                            type="button" role="tab">
                            CSR Philosophy
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="section2-tab" data-bs-toggle="tab" data-bs-target="#section2"
                            type="button" role="tab">
                            Key Focus Areas
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="section3-tab" data-bs-toggle="tab" data-bs-target="#section3"
                            type="button" role="tab">
                            Ongoing Initiatives
                        </button>
                    </li>
                </ul>

                <!-- Tab content -->
                <div class="tab-content" id="csrSectionTabsContent">
                    <!-- Section 1: CSR Philosophy -->
                    <div class="tab-pane fade show active p-3" id="section1" role="tabpanel">
                        <div class="alert alert-info mb-4">
                            <span class="fw-bold">Information:</span> CSR Philosophy Section
                        </div>
                        <form id="section1Form" class="section-form" action="{{ route('admin.csr.section1.save') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="active_tab" value="#section1">

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
                                    @if (isset($sectionOne) && $sectionOne->image)
                                        <div class="position-relative d-inline-block">
                                            <img src="{{ asset('storage/' . $sectionOne->image) }}" alt="Section One Image"
                                                style="max-width: 200px; height: auto;">
                                            <button type="button"
                                                class="btn btn-sm btn-danger position-absolute top-0 end-0 remove-image-btn"
                                                style="display: none;" data-image="section1_image">&times;</button>
                                        </div>
                                    @endif
                                </div>
                                <input type="file" class="form-control" name="image" accept="image/*" disabled>
                                <input type="hidden" name="remove_image" value="0">
                            </div>

                            <div class="form-group mb-3">
                                <label for="section1_description" class="form-label">Description</label>
                                <textarea class="form-control tinymce" id="section1_description" name="description" rows="6">{{ $sectionOne->description ?? '' }}</textarea>
                            </div>
                        </form>
                    </div>

                    <!-- Section 2: Key Focus Areas -->
                    <div class="tab-pane fade p-3" id="section2" role="tabpanel">
                        <div class="alert alert-info mb-4">
                            <span class="fw-bold">Information:</span> Key Focus Areas Section
                        </div>
                        <form id="section2Form" class="section-form" action="{{ route('admin.csr.section2.save') }}"
                            method="POST">
                            @csrf
                            <input type="hidden" name="active_tab" value="#section2">

                            <div class="d-flex justify-content-between mb-3">
                                <button type="button" class="btn btn-warning add-focus-area-btn" style="display: none;">
                                    <i class="fas fa-plus"></i> Add Focus Area
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

                            <div id="focus_area_items_container">
                                @if (isset($sectionTwos) && $sectionTwos->count() > 0)
                                    @foreach ($sectionTwos as $index => $item)
                                        <div class="focus-area-item border rounded p-3 mb-3">
                                            <div class="d-flex justify-content-between mb-2">
                                                <h6 class="mb-0">Focus Area {{ $index + 1 }}</h6>
                                                <button type="button" class="btn btn-sm btn-danger remove-focus-area-btn"
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
                                        <p class="text-muted">No focus areas added yet. Click Edit and then Add Focus
                                            Area to create one.</p>
                                    </div>
                                @endif
                            </div>
                        </form>
                    </div>

                    <!-- Section 3: Ongoing Initiatives -->
                    <div class="tab-pane fade p-3" id="section3" role="tabpanel">
                        <div class="alert alert-info mb-4">
                            <span class="fw-bold">Information:</span> Ongoing Initiatives Section
                        </div>
                        <form id="section3Form" class="section-form" action="{{ route('admin.csr.section3.save') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="active_tab" value="#section3">

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
                                    @if (isset($sectionThree) && $sectionThree->image)
                                        <div class="position-relative d-inline-block">
                                            <img src="{{ asset('storage/' . $sectionThree->image) }}"
                                                alt="Section Three Image" style="max-width: 200px; height: auto;">
                                            <button type="button"
                                                class="btn btn-sm btn-danger position-absolute top-0 end-0 remove-image-btn"
                                                style="display: none;" data-image="section3_image">&times;</button>
                                        </div>
                                    @endif
                                </div>
                                <input type="file" class="form-control" name="image" accept="image/*" disabled>
                                <input type="hidden" name="remove_image" value="0">
                            </div>

                            <div class="form-group mb-3">
                                <label for="section3_description" class="form-label">Description</label>
                                <textarea class="form-control tinymce" id="section3_description" name="description" rows="6">{{ $sectionThree->description ?? '' }}</textarea>
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
                    activeTab = localStorage.getItem('activeCsrSectionTab') || '#section1';
                }

                // Show the active tab
                $(`button[data-bs-target="${activeTab}"]`).tab('show');

                // Store the active tab when tab is changed
                $('#csrSectionTabs button[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
                    const targetTab = $(e.target).data('bs-target');
                    localStorage.setItem('activeCsrSectionTab', targetTab);
                    window.location.hash = targetTab;
                });

                // Initialize TinyMCE for all textareas with class 'tinymce'
                const editors = ['section1_description', 'section3_description'];
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
                        '.save-btn, .remove-image-btn, .add-focus-area-btn, .remove-focus-area-btn'
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
                    $('input[name="remove_' + imageId + '"]').val('1');
                });

                // Dynamic item templates
                function getFocusAreaItemTemplate(index) {
                    return `
                        <div class="focus-area-item border rounded p-3 mb-3">
                            <div class="d-flex justify-content-between mb-2">
                                <h6 class="mb-0">Focus Area ${index + 1}</h6>
                                <button type="button" class="btn btn-sm btn-danger remove-focus-area-btn">
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
                $('.add-focus-area-btn').click(function() {
                    const container = $('#focus_area_items_container');
                    const index = container.children('.focus-area-item').length;
                    container.find('.text-center').remove();
                    container.append(getFocusAreaItemTemplate(index));
                });

                // Remove item button click handlers
                $(document).on('click', '.remove-focus-area-btn', function() {
                    const item = $(this).closest('.focus-area-item');
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

                    const container = $('#focus_area_items_container');
                    if (container.children('.focus-area-item').length === 0) {
                        container.html(
                            '<div class="text-center py-5"><p class="text-muted">No focus areas added yet. Click Edit and then Add Focus Area to create one.</p></div>'
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
                    const activeTab = localStorage.getItem('activeCsrSectionTab') || '#section1';
                    $(this).find('input[name="active_tab"]').val(activeTab);
                });
            });
        </script>
    @endpush
@endsection
