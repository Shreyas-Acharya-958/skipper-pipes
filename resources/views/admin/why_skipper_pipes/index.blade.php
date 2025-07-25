@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid" style="padding: 20px;">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Why Skipper Pipes Sections</h4>
                <a href="{{ url('/admin/company') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Pages
                </a>
            </div>
            <div class="card-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs mb-3" id="whySkipperPipesTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="main-tab" data-bs-toggle="tab" data-bs-target="#main"
                            type="button" role="tab">
                            Main Section
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="section3-tab" data-bs-toggle="tab" data-bs-target="#section3"
                            type="button" role="tab">
                            Why Skipper Pipes?
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="section4-tab" data-bs-toggle="tab" data-bs-target="#section4"
                            type="button" role="tab">
                            India's Infrastructure
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="section5-tab" data-bs-toggle="tab" data-bs-target="#section5"
                            type="button" role="tab">
                            Quality That Speaks
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="built-for-condition-tab" data-bs-toggle="tab"
                            data-bs-target="#built-for-condition" type="button" role="tab">
                            Built for Every Condition
                        </button>
                    </li>
                </ul>

                <!-- Tab content -->
                <div class="tab-content" id="whySkipperPipesTabsContent">
                    <!-- Main Section -->
                    <div class="tab-pane fade show active p-3" id="main" role="tabpanel">
                        <div class="alert alert-info mb-4">
                            <span class="fw-bold">Information:</span> Main Section
                        </div>
                        <form id="mainForm" class="section-form" action="{{ route('admin.why-skipper-pipes.main.save') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="active_tab" value="#main">

                            <div class="d-flex justify-content-end mb-3">
                                <button type="button" class="btn btn-primary me-2 edit-btn">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <button type="submit" class="btn btn-success save-btn">
                                    <i class="fas fa-save"></i> Save
                                </button>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control" name="title"
                                    value="{{ $mainSection->title ?? '' }}" readonly required>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Image</label>
                                <div class="mb-2">
                                    @if (isset($mainSection) && $mainSection->image)
                                        <div class="position-relative d-inline-block">
                                            <img src="{{ asset('storage/' . $mainSection->image) }}"
                                                alt="Main Section Image" style="max-width: 200px; height: auto;">
                                            <button type="button"
                                                class="btn btn-sm btn-danger position-absolute top-0 end-0 remove-image-btn"
                                                style="display: none;" data-image="main_image">&times;</button>
                                        </div>
                                    @endif
                                </div>
                                <input type="file" class="form-control" name="image" accept="image/*,.svg" disabled>
                                <input type="hidden" name="remove_image" value="0">
                            </div>

                            <div class="form-group mb-3">
                                <label for="main_description" class="form-label">Description</label>
                                <textarea class="form-control tinymce" id="main_description" name="description" rows="6" readonly required>{{ $mainSection->description ?? '' }}</textarea>
                            </div>
                        </form>
                    </div>

                    <!-- Section 3: Why Skipper Pipes? -->
                    <div class="tab-pane fade p-3" id="section3" role="tabpanel">
                        <div class="alert alert-info mb-4">
                            <span class="fw-bold">Information:</span> Why Skipper Pipes?
                        </div>
                        <form id="section3Form" class="section-form"
                            action="{{ route('admin.why-skipper-pipes.section3.save') }}" method="POST"
                            enctype="multipart/form-data">
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
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control" name="title"
                                    value="{{ $sectionThrees->first()->title ?? '' }}" readonly required>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Images</label>
                                <div class="mb-2 d-flex flex-wrap gap-3">
                                    @if (isset($sectionThrees->first()->images))
                                        @foreach ($sectionThrees->first()->images as $index => $image)
                                            <div class="position-relative d-inline-block">
                                                <img src="{{ asset('storage/' . $image) }}"
                                                    alt="Section Image {{ $index + 1 }}"
                                                    style="max-width: 200px; height: auto;">
                                                <button type="button"
                                                    class="btn btn-sm btn-danger position-absolute top-0 end-0 remove-image-btn"
                                                    style="display: none;"
                                                    data-image="{{ $image }}">&times;</button>
                                                <input type="hidden" name="deleted_images[]" value=""
                                                    class="deleted-image-input">
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <input type="file" class="form-control" name="images[]" accept="image/*,.svg"
                                    multiple disabled>
                            </div>

                            <div class="form-group mb-3">
                                <label for="section3_description" class="form-label">Description</label>
                                <textarea class="form-control tinymce" id="section3_description" name="description" rows="6" readonly
                                    required>{{ $sectionThrees->first()->description ?? '' }}</textarea>
                            </div>
                        </form>
                    </div>

                    <!-- Section 4: India's Infrastructure -->
                    <div class="tab-pane fade p-3" id="section4" role="tabpanel">
                        <div class="alert alert-info mb-4">
                            <span class="fw-bold">Information:</span> India's Infrastructure, Powered by Safety
                        </div>
                        <form id="section4Form" class="section-form"
                            action="{{ route('admin.why-skipper-pipes.section4.save') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="active_tab" value="#section4">

                            <div class="d-flex justify-content-between mb-3">
                                <button type="button" class="btn btn-warning add-item-btn" style="display: none;">
                                    <i class="fas fa-plus"></i> Add Item
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

                            <div id="section4_items_container">
                                @if (isset($sectionFours) && $sectionFours->count() > 0)
                                    @foreach ($sectionFours as $index => $item)
                                        <div class="section-item border rounded p-3 mb-3">
                                            <div class="d-flex justify-content-between mb-2">
                                                <h6 class="mb-0">Item {{ $index + 1 }}</h6>
                                                <button type="button" class="btn btn-sm btn-danger remove-item-btn"
                                                    style="display: none;">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                            <input type="hidden" name="sections[{{ $index }}][id]"
                                                value="{{ $item->id }}">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">Image</label>
                                                        @if ($item->image)
                                                            <div class="position-relative d-inline-block mb-2">
                                                                <img src="{{ asset('storage/' . $item->image) }}"
                                                                    alt="Item Image {{ $index + 1 }}"
                                                                    style="max-width: 200px; height: auto;">
                                                                <button type="button"
                                                                    class="btn btn-sm btn-danger position-absolute top-0 end-0 remove-image-btn"
                                                                    style="display: none;"
                                                                    data-image="item_{{ $index }}">&times;</button>
                                                            </div>
                                                        @endif
                                                        <input type="file" class="form-control"
                                                            name="sections[{{ $index }}][image_file]"
                                                            accept="image/*,.svg" disabled>
                                                        <input type="hidden"
                                                            name="sections[{{ $index }}][remove_image]"
                                                            value="0">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
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
                                                <textarea class="form-control tinymce" id="section4_description_{{ $index }}"
                                                    name="sections[{{ $index }}][description]" rows="3" readonly required>{{ $item->description }}</textarea>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="text-center py-5">
                                        <p class="text-muted">No items added yet. Click Edit and then Add Item to create
                                            one.</p>
                                    </div>
                                @endif
                            </div>
                        </form>
                    </div>

                    <!-- Section 5: Quality That Speaks -->
                    <div class="tab-pane fade p-3" id="section5" role="tabpanel">
                        <div class="alert alert-info mb-4">
                            <span class="fw-bold">Information:</span> Quality That Speaks
                        </div>
                        <form id="section5Form" class="section-form"
                            action="{{ route('admin.why-skipper-pipes.section5.save') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="active_tab" value="#section5">

                            <div class="d-flex justify-content-end mb-3">
                                <button type="button" class="btn btn-primary me-2 edit-btn">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <button type="submit" class="btn btn-success save-btn" style="display: none;">
                                    <i class="fas fa-save"></i> Save
                                </button>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control" name="title"
                                    value="{{ $sectionFives->first()->title ?? '' }}" readonly required>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Images</label>
                                <div class="mb-2 d-flex flex-wrap gap-3">
                                    @if (!empty($sectionFives->first()->images))
                                        @foreach ((array) $sectionFives->first()->images as $index => $image)
                                            <div class="position-relative d-inline-block">
                                                <img src="{{ asset('storage/' . $image) }}"
                                                    alt="Section Image {{ $index + 1 }}"
                                                    style="max-width: 200px; height: auto;">
                                                <button type="button"
                                                    class="btn btn-sm btn-danger position-absolute top-0 end-0 remove-image-btn"
                                                    style="display: none;"
                                                    data-image="{{ $image }}">&times;</button>
                                                <input type="hidden" name="deleted_images[]" value=""
                                                    class="deleted-image-input">
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <input type="file" class="form-control" name="images[]" accept="image/*,.svg"
                                    multiple disabled>
                            </div>

                            <div class="form-group mb-3">
                                <label for="section5_description" class="form-label">Description</label>
                                <textarea class="form-control tinymce" id="section5_description" name="description" rows="6" readonly
                                    required>{{ $sectionFives->first()->description ?? '' }}</textarea>
                            </div>
                        </form>
                    </div>

                    <!-- Built for Every Condition -->
                    <div class="tab-pane fade p-3" id="built-for-condition" role="tabpanel">
                        <div class="alert alert-info mb-4">
                            <span class="fw-bold">Information:</span> Built for Every Condition
                        </div>
                        <form id="builtForConditionForm" class="section-form"
                            action="{{ route('admin.why-skipper-pipes.built-for-condition.save') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="active_tab" value="#built-for-condition">

                            <div class="d-flex justify-content-between mb-3">
                                <button type="button" class="btn btn-warning add-item-btn" style="display: none;">
                                    <i class="fas fa-plus"></i> Add Item
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

                            <div id="built_for_condition_items_container">
                                @if (isset($builtForConditions) && $builtForConditions->count() > 0)
                                    @foreach ($builtForConditions as $index => $item)
                                        <div class="section-item border rounded p-3 mb-3">
                                            <div class="d-flex justify-content-between mb-2">
                                                <h6 class="mb-0">Item {{ $index + 1 }}</h6>
                                                <button type="button" class="btn btn-sm btn-danger remove-item-btn"
                                                    style="display: none;">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                            <input type="hidden" name="sections[{{ $index }}][id]"
                                                value="{{ $item->id }}">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">Image</label>
                                                        @if ($item->image)
                                                            <div class="position-relative d-inline-block mb-2">
                                                                <img src="{{ asset('storage/' . $item->image) }}"
                                                                    alt="Item Image {{ $index + 1 }}"
                                                                    style="max-width: 200px; height: auto;">
                                                                <button type="button"
                                                                    class="btn btn-sm btn-danger position-absolute top-0 end-0 remove-image-btn"
                                                                    style="display: none;"
                                                                    data-image="item_{{ $index }}">&times;</button>
                                                            </div>
                                                        @endif
                                                        <input type="file" class="form-control"
                                                            name="sections[{{ $index }}][image_file]"
                                                            accept="image/*,.svg" disabled>
                                                        <input type="hidden"
                                                            name="sections[{{ $index }}][remove_image]"
                                                            value="0">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
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
                                                <textarea class="form-control tinymce" id="built_for_condition_description_{{ $index }}"
                                                    name="sections[{{ $index }}][description]" rows="3" readonly required>{{ $item->description }}</textarea>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="text-center py-5">
                                        <p class="text-muted">No items added yet. Click Edit and then Add Item to create
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

    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.1.1/tinymce.min.js"></script>
        <script>
            function initWhySkipperTinyMCE() {
                $('.tinymce').each(function() {
                    const id = $(this).attr('id');
                    if (tinymce.get(id)) {
                        tinymce.get(id).remove();
                    }
                    tinymce.init({
                        selector: `#${id}`,
                        height: 200,
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
            }
            $(document).ready(function() {
                initWhySkipperTinyMCE();
                // Get the tab ID from URL hash or localStorage
                let activeTab = window.location.hash;
                if (!activeTab) {
                    activeTab = localStorage.getItem('activeWhySkipperPipesTab') || '#main';
                }

                // Show the active tab
                $(`button[data-bs-target="${activeTab}"]`).tab('show');

                // Store the active tab when tab is changed
                $('#whySkipperPipesTabs button[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
                    const targetTab = $(e.target).data('bs-target');
                    localStorage.setItem('activeWhySkipperPipesTab', targetTab);
                    window.location.hash = targetTab;
                    setTimeout(initWhySkipperTinyMCE, 200); // Re-init TinyMCE on tab change
                });

                // Edit button click handler
                $('.edit-btn').click(function() {
                    const form = $(this).closest('form');
                    form.find('input:not([type="hidden"]), textarea, select').removeAttr(
                        'readonly disabled');
                    form.find('.save-btn, .remove-image-btn').show();
                    // Show the add-item-btn if it exists in this form
                    form.find('.add-item-btn').show();
                    $(this).hide();
                    setTimeout(initWhySkipperTinyMCE, 200); // Re-init TinyMCE on edit
                });

                // Remove image button click handler for sections 3 and 5
                $(document).on('click', '#section3 .remove-image-btn, #section5 .remove-image-btn', function() {
                    const imageContainer = $(this).closest('.position-relative');
                    const imagePath = $(this).data('image');
                    const deletedInput = imageContainer.find('.deleted-image-input');

                    // Mark image for deletion
                    deletedInput.val(imagePath);
                    imageContainer.hide();
                });

                // Dynamic item template
                function getItemTemplate(index, containerId) {
                    return `
                        <div class="section-item border rounded p-3 mb-3">
                            <div class="d-flex justify-content-between mb-2">
                                <h6 class="mb-0">Item ${index + 1}</h6>
                                <button type="button" class="btn btn-sm btn-danger remove-item-btn">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Image</label>
                                        <input type="file" class="form-control" name="sections[${index}][image_file]" accept="image/*,.svg">
                                        <input type="hidden" name="sections[${index}][remove_image]" value="0">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Title</label>
                                        <input type="text" class="form-control" name="sections[${index}][title]" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Description</label>
                                <textarea class="form-control tinymce" name="sections[${index}][description]" rows="3" required></textarea>
                            </div>
                        </div>
                    `;
                }

                // Add item button click handler
                $('.add-item-btn').click(function() {
                    const container = $(this).closest('.tab-pane').find('[id$="_items_container"]');
                    const index = container.children('.section-item').length;
                    container.find('.text-center').remove();
                    container.append(getItemTemplate(index, container.attr('id')));
                });

                // Remove item button click handler
                $(document).on('click', '.remove-item-btn', function() {
                    const item = $(this).closest('.section-item');
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

                    const container = $(this).closest('[id$="_items_container"]');
                    if (container.children('.section-item').length === 0) {
                        container.html(
                            '<div class="text-center py-5"><p class="text-muted">No items added yet. Click Edit and then Add Item to create one.</p></div>'
                        );
                    }
                });

                // Handle form submission
                $('.section-form').on('submit', function() {
                    // Enable all fields before submit
                    $(this).find('input:not([type="hidden"]), textarea, select').removeAttr(
                        'readonly disabled');

                    // Update active tab
                    const activeTab = localStorage.getItem('activeWhySkipperPipesTab') || '#main';
                    $(this).find('input[name="active_tab"]').val(activeTab);

                    // Update textarea values from TinyMCE
                    $(this).find('.tinymce').each(function() {
                        const id = $(this).attr('id');
                        const editor = tinymce.get(id);
                        if (editor) {
                            $(this).val(editor.getContent());
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
