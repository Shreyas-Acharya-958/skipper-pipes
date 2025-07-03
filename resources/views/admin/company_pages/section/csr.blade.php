@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid" style="padding: 20px;">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">CSR Page Sections</h4>
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
                                                <textarea class="form-control tinymce" id="focus_area_description_{{ $index }}"
                                                    name="sections[{{ $index }}][description]" rows="3" readonly required>{{ $item->description }}</textarea>
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
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex" style="max-width: 400px;">
                                <!-- Add search functionality if needed -->
                            </div>
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                data-bs-target="#initiativeModal">
                                <i class="fas fa-plus"></i> Add New Initiative
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($sectionThrees) && $sectionThrees->count() > 0)
                                        @foreach ($sectionThrees as $initiative)
                                            <tr>
                                                <td>
                                                    @if ($initiative->image)
                                                        <img src="{{ asset('storage/' . $initiative->image) }}"
                                                            alt="Initiative Image"
                                                            style="max-width: 100px; height: auto;">
                                                    @else
                                                        <span class="text-muted">No image</span>
                                                    @endif
                                                </td>
                                                <td>{{ $initiative->title }}</td>
                                                <td>{!! Str::limit(strip_tags($initiative->description), 100) !!}</td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <button type="button" class="btn p-0 me-2 edit-initiative"
                                                            style="background: none; border: none;"
                                                            data-id="{{ $initiative->id }}"
                                                            data-title="{{ $initiative->title }}"
                                                            data-description="{{ $initiative->description }}"
                                                            data-image="{{ $initiative->image }}" title="Edit">
                                                            <i class="fas fa-edit text-warning"
                                                                style="font-size: 1.2rem;"></i>
                                                        </button>
                                                        <button type="button" class="btn p-0 delete-initiative"
                                                            style="background: none; border: none;"
                                                            data-id="{{ $initiative->id }}" title="Delete">
                                                            <i class="fas fa-trash text-danger"
                                                                style="font-size: 1.2rem;"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4" class="text-center">No initiatives found</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        <!-- Initiative Modal -->
                        <div class="modal fade" id="initiativeModal" tabindex="-1"
                            aria-labelledby="initiativeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <form id="initiativeForm" action="{{ route('admin.csr.section3.save') }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="initiative_id" id="initiative_id">

                                        <div class="modal-header">
                                            <h5 class="modal-title" id="initiativeModalLabel">Add Initiative</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group mb-3">
                                                <label class="form-label">Image</label>
                                                <div class="mb-2" id="currentImage"></div>
                                                <input type="file" class="form-control" name="image"
                                                    accept="image/*">
                                                <input type="hidden" name="remove_image" value="0">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="form-label">Title</label>
                                                <input type="text" class="form-control" name="title" required>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="form-label">Description</label>
                                                <textarea id="description" name="description" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Delete Confirmation Modal -->
                        <div class="modal fade" id="deleteInitiativeModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Delete Initiative</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete this initiative?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <form id="deleteInitiativeForm" action="{{ route('admin.csr.section3.delete') }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="initiative_id" id="delete_initiative_id">
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.1.1/tinymce.min.js"></script>
        <script>
            $(document).ready(function() {
                // Auto dismiss alerts after 5 seconds
                setTimeout(function() {
                    $('.alert').alert('close');
                }, 5000);

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
                function initTinyMCE(selector) {
                    if (tinymce.get(selector.replace('#', ''))) {
                        tinymce.remove(selector);
                    }
                    tinymce.init({
                        selector: selector,
                        height: 300,
                        menubar: false,
                        plugins: 'lists link image code',
                        toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist | link image | code',
                        setup: function(editor) {
                            editor.on('init', function() {
                                if ($(selector).attr('readonly')) {
                                    editor.mode.set('readonly');
                                }
                            });
                        },
                        init_instance_callback: function(editor) {
                            if ($(selector).attr('readonly')) {
                                editor.mode.set('readonly');
                            }
                        }
                    });
                }

                // Initialize existing TinyMCE editors
                $('.tinymce').each(function() {
                    initTinyMCE('#' + $(this).attr('id'));
                });

                // Edit button click handler
                $('.edit-btn').click(function() {
                    const form = $(this).closest('form');
                    form.find('input:not([type="hidden"]), select').removeAttr('readonly disabled');
                    form.find(
                        '.save-btn, .remove-image-btn, .add-focus-area-btn, .remove-focus-area-btn, .add-initiative-btn, .remove-initiative-btn'
                    ).show();
                    $(this).hide();

                    // Enable TinyMCE editors
                    form.find('.tinymce').each(function() {
                        const editor = tinymce.get($(this).attr('id'));
                        if (editor) {
                            editor.mode.set('design');
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
                                <textarea class="form-control tinymce" id="focus_area_description_new_${index}" name="sections[${index}][description]" rows="3" required></textarea>
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
                    $(this).find('input:not([type="hidden"]), select').removeAttr('readonly disabled');

                    // Get TinyMCE content for all editors
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

                // Initialize TinyMCE with basic configuration
                tinymce.init({
                    selector: '#description',
                    height: 300,
                    menubar: false,
                    plugins: ['lists', 'link'],
                    toolbar: 'undo redo | bold italic | bullist numlist | link'
                });

                // Reset form when modal is closed
                $('#initiativeModal').on('hidden.bs.modal', function() {
                    $('#initiativeForm')[0].reset();
                    $('#initiative_id').val('');
                    $('#currentImage').empty();
                    $('#initiativeModalLabel').text('Add Initiative');
                    tinymce.get('description').setContent('');
                });

                // Handle edit button click
                $('.edit-initiative').click(function() {
                    const data = $(this).data();
                    $('#initiative_id').val(data.id);
                    $('input[name="title"]').val(data.title);
                    tinymce.get('description').setContent(data.description);

                    if (data.image) {
                        const imageUrl = "{{ asset('storage') }}/" + data.image;
                        $('#currentImage').html(`
                            <div class="position-relative d-inline-block">
                                <img src="${imageUrl}" alt="Current Image" style="max-width: 200px; height: auto;">
                                <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 remove-image-btn">&times;</button>
                            </div>
                        `);
                    }

                    $('#initiativeModalLabel').text('Edit Initiative');
                    $('#initiativeModal').modal('show');
                });

                // Handle delete button click
                $('.delete-initiative').click(function() {
                    const id = $(this).data('id');
                    $('#delete_initiative_id').val(id);
                    $('#deleteInitiativeModal').modal('show');
                });

                // Handle remove image button click
                $(document).on('click', '.remove-image-btn', function() {
                    $(this).closest('.position-relative').remove();
                    $('input[name="remove_image"]').val('1');
                });
            });
        </script>
    @endpush
@endsection
