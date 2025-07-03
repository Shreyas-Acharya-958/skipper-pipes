@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid" style="padding: 20px;">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Leadership Page Sections</h4>
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
                <ul class="nav nav-tabs mb-3" id="leadershipSectionTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="section1-tab" data-bs-toggle="tab" data-bs-target="#section1"
                            type="button" role="tab">
                            Words from the Top!
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="section2-tab" data-bs-toggle="tab" data-bs-target="#section2"
                            type="button" role="tab">
                            Leadership Philosophy
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="section3-tab" data-bs-toggle="tab" data-bs-target="#section3"
                            type="button" role="tab">
                            Business Directors
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="section4-tab" data-bs-toggle="tab" data-bs-target="#section4"
                            type="button" role="tab">
                            Business Heads
                        </button>
                    </li>
                </ul>

                <!-- Tab content -->
                <div class="tab-content" id="leadershipSectionTabsContent">
                    <!-- Section 1: Words from the Top! -->
                    <div class="tab-pane fade show active p-3" id="section1" role="tabpanel">
                        <div class="alert alert-info mb-4">
                            <span class="fw-bold">Information:</span> Words from the Top! Section
                        </div>
                        <form id="section1Form" class="section-form" action="{{ route('admin.leadership.section1.save') }}"
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

                    <!-- Section 2: Leadership Philosophy -->
                    <div class="tab-pane fade p-3" id="section2" role="tabpanel">
                        <div class="alert alert-info mb-4">
                            <span class="fw-bold">Information:</span> Leadership Philosophy Section
                        </div>
                        <form id="section2Form" class="section-form"
                            action="{{ route('admin.leadership.section2.save') }}" method="POST">
                            @csrf
                            <input type="hidden" name="active_tab" value="#section2">

                            <div class="d-flex justify-content-between mb-3">
                                <button type="button" class="btn btn-warning add-philosophy-btn" style="display: none;">
                                    <i class="fas fa-plus"></i> Add Philosophy Item
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

                            <div id="philosophy_items_container">
                                @if (isset($sectionTwos) && $sectionTwos->count() > 0)
                                    @foreach ($sectionTwos as $index => $item)
                                        <div class="philosophy-item border rounded p-3 mb-3">
                                            <div class="d-flex justify-content-between mb-2">
                                                <h6 class="mb-0">Philosophy Item {{ $index + 1 }}</h6>
                                                <button type="button" class="btn btn-sm btn-danger remove-philosophy-btn"
                                                    style="display: none;" data-id="{{ $item->id }}">
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
                                                <div class="col-md-8">
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
                                        <p class="text-muted">No philosophy items added yet. Click Edit and then Add
                                            Philosophy
                                            Item to create one.</p>
                                    </div>
                                @endif
                            </div>
                        </form>
                    </div>

                    <!-- Section 3: Business Directors -->
                    <div class="tab-pane fade p-3" id="section3" role="tabpanel">
                        <div class="alert alert-info mb-4">
                            <span class="fw-bold">Information:</span> Business Directors Section
                        </div>
                        <form id="section3Form" class="section-form"
                            action="{{ route('admin.leadership.section3.save') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="active_tab" value="#section3">

                            <div class="d-flex justify-content-between mb-3">
                                <button type="button" class="btn btn-warning add-director-btn" style="display: none;">
                                    <i class="fas fa-plus"></i> Add Director
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

                            <div id="director_items_container">
                                @if (isset($sectionThrees) && $sectionThrees->count() > 0)
                                    @foreach ($sectionThrees as $index => $item)
                                        <div class="director-item border rounded p-3 mb-3">
                                            <div class="d-flex justify-content-between mb-2">
                                                <h6 class="mb-0">Director {{ $index + 1 }}</h6>
                                                <button type="button" class="btn btn-sm btn-danger remove-director-btn"
                                                    style="display: none;" data-id="{{ $item->id }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                            <input type="hidden" name="sections[{{ $index }}][id]"
                                                value="{{ $item->id }}">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">Name</label>
                                                        <input type="text" class="form-control"
                                                            name="sections[{{ $index }}][name]"
                                                            value="{{ $item->name }}" readonly required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">Role</label>
                                                        <input type="text" class="form-control"
                                                            name="sections[{{ $index }}][role]"
                                                            value="{{ $item->role }}" readonly required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">Image</label>
                                                        <div class="mb-2">
                                                            @if ($item->image)
                                                                <div class="position-relative d-inline-block">
                                                                    <img src="{{ asset('storage/' . $item->image) }}"
                                                                        alt="Director Image"
                                                                        style="max-width: 200px; height: auto;">
                                                                    <button type="button"
                                                                        class="btn btn-sm btn-danger position-absolute top-0 end-0 remove-image-btn"
                                                                        style="display: none;"
                                                                        data-image="director_{{ $index }}">&times;</button>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <input type="file" class="form-control"
                                                            name="sections[{{ $index }}][image_file]"
                                                            accept="image/*" disabled>
                                                        <input type="hidden"
                                                            name="sections[{{ $index }}][remove_image]"
                                                            value="0">
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
                                        <p class="text-muted">No directors added yet. Click Edit and then Add Director to
                                            create
                                            one.</p>
                                    </div>
                                @endif
                            </div>
                        </form>
                    </div>

                    <!-- Section 4: Business Heads -->
                    <div class="tab-pane fade p-3" id="section4" role="tabpanel">
                        <div class="alert alert-info mb-4">
                            <span class="fw-bold">Information:</span> Business Heads Section
                        </div>
                        <form id="section4Form" class="section-form"
                            action="{{ route('admin.leadership.section4.save') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="active_tab" value="#section4">

                            <div class="d-flex justify-content-between mb-3">
                                <button type="button" class="btn btn-warning add-head-btn" style="display: none;">
                                    <i class="fas fa-plus"></i> Add Head
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

                            <div id="head_items_container">
                                @if (isset($sectionFours) && $sectionFours->count() > 0)
                                    @foreach ($sectionFours as $index => $item)
                                        <div class="head-item border rounded p-3 mb-3">
                                            <div class="d-flex justify-content-between mb-2">
                                                <h6 class="mb-0">Head {{ $index + 1 }}</h6>
                                                <button type="button" class="btn btn-sm btn-danger remove-head-btn"
                                                    style="display: none;" data-id="{{ $item->id }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                            <input type="hidden" name="sections[{{ $index }}][id]"
                                                value="{{ $item->id }}">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">Name</label>
                                                        <input type="text" class="form-control"
                                                            name="sections[{{ $index }}][name]"
                                                            value="{{ $item->name }}" readonly required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">Role</label>
                                                        <input type="text" class="form-control"
                                                            name="sections[{{ $index }}][role]"
                                                            value="{{ $item->role }}" readonly required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">Image</label>
                                                        <div class="mb-2">
                                                            @if ($item->image)
                                                                <div class="position-relative d-inline-block">
                                                                    <img src="{{ asset('storage/' . $item->image) }}"
                                                                        alt="Head Image"
                                                                        style="max-width: 200px; height: auto;">
                                                                    <button type="button"
                                                                        class="btn btn-sm btn-danger position-absolute top-0 end-0 remove-image-btn"
                                                                        style="display: none;"
                                                                        data-image="head_{{ $index }}">&times;</button>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <input type="file" class="form-control"
                                                            name="sections[{{ $index }}][image_file]"
                                                            accept="image/*" disabled>
                                                        <input type="hidden"
                                                            name="sections[{{ $index }}][remove_image]"
                                                            value="0">
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
                                        <p class="text-muted">No heads added yet. Click Edit and then Add Head to create
                                            one.</p>
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

@push('styles')
    <link href="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/skins/ui/oxide/skin.min.css" rel="stylesheet">
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.1.1/tinymce.min.js"></script>
    <script>
        $(document).ready(function() {
            // Get the tab ID from URL hash or localStorage
            let activeTab = window.location.hash;
            if (!activeTab) {
                activeTab = localStorage.getItem('activeLeadershipSectionTab') || '#section1';
            }

            // Show the active tab
            $(`button[data-bs-target="${activeTab}"]`).tab('show');

            // Store the active tab when tab is changed
            $('#leadershipSectionTabs button[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
                const targetTab = $(e.target).data('bs-target');
                localStorage.setItem('activeLeadershipSectionTab', targetTab);
                window.location.hash = targetTab;
            });

            // Initialize TinyMCE for all textareas with class 'tinymce'
            const editors = ['section1_description'];
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
                    '.save-btn, .remove-image-btn, .add-philosophy-btn, .add-director-btn, .add-head-btn, .remove-philosophy-btn, .remove-director-btn, .remove-head-btn'
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
            function getPhilosophyItemTemplate(index) {
                return `
                    <div class="philosophy-item border rounded p-3 mb-3">
                        <div class="d-flex justify-content-between mb-2">
                            <h6 class="mb-0">Philosophy Item ${index + 1}</h6>
                            <button type="button" class="btn btn-sm btn-danger remove-philosophy-btn">
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
                            <div class="col-md-8">
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

            function getDirectorItemTemplate(index) {
                return `
                    <div class="director-item border rounded p-3 mb-3">
                        <div class="d-flex justify-content-between mb-2">
                            <h6 class="mb-0">Director ${index + 1}</h6>
                            <button type="button" class="btn btn-sm btn-danger remove-director-btn">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" name="sections[${index}][name]" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label class="form-label">Role</label>
                                    <input type="text" class="form-control" name="sections[${index}][role]" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Image</label>
                                    <input type="file" class="form-control" name="sections[${index}][image_file]" accept="image/*">
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

            function getHeadItemTemplate(index) {
                return `
                    <div class="head-item border rounded p-3 mb-3">
                        <div class="d-flex justify-content-between mb-2">
                            <h6 class="mb-0">Business Head ${index + 1}</h6>
                            <button type="button" class="btn btn-sm btn-danger remove-head-btn">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" name="sections[${index}][name]" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label class="form-label">Role</label>
                                    <input type="text" class="form-control" name="sections[${index}][role]" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Image</label>
                                    <input type="file" class="form-control" name="sections[${index}][image_file]" accept="image/*">
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
            $('.add-philosophy-btn').click(function() {
                const container = $('#philosophy_items_container');
                const index = container.children('.philosophy-item').length;
                container.find('.text-center').remove();
                container.append(getPhilosophyItemTemplate(index));
            });

            $('.add-director-btn').click(function() {
                const container = $('#director_items_container');
                const index = container.children('.director-item').length;
                container.find('.text-center').remove();
                container.append(getDirectorItemTemplate(index));
            });

            $('.add-head-btn').click(function() {
                const container = $('#head_items_container');
                const index = container.children('.head-item').length;
                container.find('.text-center').remove();
                container.append(getHeadItemTemplate(index));
            });

            // Remove item button click handlers
            $(document).on('click', '.remove-philosophy-btn', function() {
                const item = $(this).closest('.philosophy-item');
                const id = item.find('input[name$="[id]"]').val();
                if (id) {
                    const form = item.closest('form');
                    form.append($('<input>').attr({
                        type: 'hidden',
                        name: 'deleted_sections[]',
                        value: id
                    }));
                }
                item.remove();

                const container = $('#philosophy_items_container');
                if (container.children('.philosophy-item').length === 0) {
                    container.html(
                        '<div class="text-center py-5"><p class="text-muted">No philosophy items added yet. Click Edit and then Add Philosophy Item to create one.</p></div>'
                    );
                }
            });

            $(document).on('click', '.remove-director-btn', function() {
                const item = $(this).closest('.director-item');
                const id = item.find('input[name$="[id]"]').val();
                if (id) {
                    const form = item.closest('form');
                    form.append($('<input>').attr({
                        type: 'hidden',
                        name: 'deleted_sections[]',
                        value: id
                    }));
                }
                item.remove();

                const container = $('#director_items_container');
                if (container.children('.director-item').length === 0) {
                    container.html(
                        '<div class="text-center py-5"><p class="text-muted">No directors added yet. Click Edit and then Add Director to create one.</p></div>'
                    );
                }
            });

            $(document).on('click', '.remove-head-btn', function() {
                const item = $(this).closest('.head-item');
                const id = item.find('input[name$="[id]"]').val();
                if (id) {
                    const form = item.closest('form');
                    form.append($('<input>').attr({
                        type: 'hidden',
                        name: 'deleted_sections[]',
                        value: id
                    }));
                }
                item.remove();

                const container = $('#head_items_container');
                if (container.children('.head-item').length === 0) {
                    container.html(
                        '<div class="text-center py-5"><p class="text-muted">No business heads added yet. Click Edit and then Add Business Head to create one.</p></div>'
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
                const activeTab = localStorage.getItem('activeLeadershipSectionTab') || '#section1';
                $(this).find('input[name="active_tab"]').val(activeTab);
            });
        });
    </script>
@endpush
