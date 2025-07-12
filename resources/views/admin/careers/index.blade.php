@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid" style="padding: 20px;">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Career Sections</h4>
                <a href="{{ url('/admin/company') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Pages
                </a>
            </div>
            <div class="card-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs mb-3" id="careerTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="main-tab" data-bs-toggle="tab" data-bs-target="#main"
                            type="button" role="tab">
                            Main Section
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="why-skipper-tab" data-bs-toggle="tab" data-bs-target="#why-skipper"
                            type="button" role="tab">
                            Why Skipper
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="life-at-skipper-tab" data-bs-toggle="tab"
                            data-bs-target="#life-at-skipper" type="button" role="tab">
                            Life at Skipper
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="skipper-pipes-tab" data-bs-toggle="tab" data-bs-target="#skipper-pipes"
                            type="button" role="tab">
                            Skipper Pipes
                        </button>
                    </li>
                </ul>

                <!-- Tab content -->
                <div class="tab-content" id="careerTabsContent">
                    <!-- Main Section -->
                    <div class="tab-pane fade show active p-3" id="main" role="tabpanel">
                        <div class="alert alert-info mb-4">
                            <span class="fw-bold">Information:</span> Main Section
                        </div>
                        <form id="mainForm" class="section-form" action="{{ route('admin.careers.main.save') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="active_tab" value="#main">

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
                                    value="{{ $mainSection->title ?? '' }}" readonly required>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Images</label>
                                <div class="mb-2 d-flex flex-wrap gap-3">
                                    @if (isset($mainSection) && !empty($mainSection->images))
                                        @foreach ((array) $mainSection->images as $index => $image)
                                            <div class="position-relative d-inline-block">
                                                <img src="{{ asset('storage/' . $image) }}"
                                                    alt="Main Section Image {{ $index + 1 }}"
                                                    style="max-width: 200px; height: auto;">
                                                <button type="button"
                                                    class="btn btn-sm btn-danger position-absolute top-0 end-0 remove-image-btn"
                                                    style="display: none;" data-image="{{ $image }}">&times;</button>
                                                <input type="hidden" name="deleted_images[]" value=""
                                                    class="deleted-image-input">
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <input type="file" class="form-control" name="images[]" accept="image/*,.svg" multiple
                                    disabled>
                            </div>

                            <div class="form-group mb-3">
                                <label for="main_description" class="form-label">Description</label>
                                <textarea class="form-control" name="description" rows="6" readonly required>{{ $mainSection->description ?? '' }}</textarea>
                            </div>
                        </form>
                    </div>

                    <!-- Why Skipper Section -->
                    <div class="tab-pane fade p-3" id="why-skipper" role="tabpanel">
                        <div class="alert alert-info mb-4">
                            <span class="fw-bold">Information:</span> Why Skipper
                        </div>
                        <form id="whySkipperForm" class="section-form"
                            action="{{ route('admin.careers.why-skipper.save') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="active_tab" value="#why-skipper">

                            <div class="d-flex justify-content-end mb-3">
                                <button type="button" class="btn btn-primary me-2 edit-btn">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <button type="submit" class="btn btn-success save-btn" style="display: none;">
                                    <i class="fas fa-save"></i> Save
                                </button>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Images</label>
                                <div class="mb-2 d-flex flex-wrap gap-3">
                                    @if (isset($whySkipper) && !empty($whySkipper->images))
                                        @foreach ((array) $whySkipper->images as $index => $image)
                                            <div class="position-relative d-inline-block">
                                                <img src="{{ asset('storage/' . $image) }}"
                                                    alt="Why Skipper Image {{ $index + 1 }}"
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
                                <label for="why_skipper_description" class="form-label">Description</label>
                                <textarea class="form-control" name="description" rows="6" readonly required>{{ $whySkipper->description ?? '' }}</textarea>
                            </div>
                        </form>
                    </div>

                    <!-- Life at Skipper Section -->
                    <div class="tab-pane fade p-3" id="life-at-skipper" role="tabpanel">
                        <div class="alert alert-info mb-4">
                            <span class="fw-bold">Information:</span> Life at Skipper
                        </div>
                        <form id="lifeAtSkipperForm" class="section-form"
                            action="{{ route('admin.careers.life-at-skipper.save') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="active_tab" value="#life-at-skipper">

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

                            <div id="life_at_skipper_items_container">
                                @if (isset($lifeAtSkippers) && $lifeAtSkippers->count() > 0)
                                    @foreach ($lifeAtSkippers as $index => $item)
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
                                                <textarea class="form-control" name="sections[{{ $index }}][description]" rows="3" readonly required>{{ $item->description }}</textarea>
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

                    <!-- Skipper Pipes Section -->
                    <div class="tab-pane fade p-3" id="skipper-pipes" role="tabpanel">
                        <div class="alert alert-info mb-4">
                            <span class="fw-bold">Information:</span> Skipper Pipes
                        </div>
                        <form id="skipperPipesForm" class="section-form"
                            action="{{ route('admin.careers.skipper-pipes.save') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="active_tab" value="#skipper-pipes">

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

                            <div id="skipper_pipes_items_container">
                                @if (isset($skipperPipes) && $skipperPipes->count() > 0)
                                    @foreach ($skipperPipes as $index => $item)
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
                                                <textarea class="form-control" name="sections[{{ $index }}][description]" rows="3" readonly required>{{ $item->description }}</textarea>
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
        <script>
            $(document).ready(function() {
                // Get the tab ID from URL hash or localStorage
                let activeTab = window.location.hash;
                if (!activeTab) {
                    activeTab = localStorage.getItem('activeCareerTab') || '#main';
                }

                // Show the active tab
                $(`button[data-bs-target="${activeTab}"]`).tab('show');

                // Store the active tab when tab is changed
                $('#careerTabs button[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
                    const targetTab = $(e.target).data('bs-target');
                    localStorage.setItem('activeCareerTab', targetTab);
                    window.location.hash = targetTab;
                });

                // Edit button click handler
                $('.edit-btn').click(function() {
                    const form = $(this).closest('form');
                    form.find('input:not([type="hidden"]), textarea, select').removeAttr(
                        'readonly disabled');
                    form.find('.save-btn, .remove-image-btn, .add-item-btn, .remove-item-btn').show();
                    $(this).hide();
                });

                // Remove image button click handler
                $('.remove-image-btn').click(function() {
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
                                <textarea class="form-control" name="sections[${index}][description]" rows="3" required></textarea>
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
                    const activeTab = localStorage.getItem('activeCareerTab') || '#main';
                    $(this).find('input[name="active_tab"]').val(activeTab);
                });
            });
        </script>
    @endpush
@endsection
