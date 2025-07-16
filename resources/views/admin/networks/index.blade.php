@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid" style="padding: 20px;">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Network Sections</h4>
                <a href="{{ url('/admin/company') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Pages
                </a>
            </div>
            <div class="card-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs mb-3" id="networkTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="main-network-tab" data-bs-toggle="tab"
                            data-bs-target="#main-network" type="button" role="tab">
                            Main Network
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="networks-tab" data-bs-toggle="tab" data-bs-target="#networks"
                            type="button" role="tab">
                            Networks
                        </button>
                    </li>
                </ul>
                <!-- Tab content -->
                <div class="tab-content" id="networkTabsContent">
                    <!-- Main Network Section -->
                    <div class="tab-pane fade show active p-3" id="main-network" role="tabpanel">
                        <form id="mainNetworkForm" class="section-form" action="{{ route('admin.networks.main.save') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="active_tab" value="#main-network">
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
                                    value="{{ $mainNetwork->title ?? '' }}" readonly required>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Image</label>
                                @if (isset($mainNetwork) && $mainNetwork->image)
                                    <div class="position-relative d-inline-block mb-2">
                                        <img src="{{ asset('storage/' . $mainNetwork->image) }}" alt="Main Network Image"
                                            style="max-width: 200px; height: auto;">
                                        <button type="button"
                                            class="btn btn-sm btn-danger position-absolute top-0 end-0 remove-image-btn"
                                            style="display: none;" data-image="main_network_image">&times;</button>
                                    </div>
                                @endif
                                <input type="file" class="form-control" name="image" accept="image/*,.svg" disabled>
                                <input type="hidden" name="remove_image" value="0">
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" name="description" rows="4" readonly required>{{ $mainNetwork->description ?? '' }}</textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Overview</label>
                                <textarea class="form-control" name="overview" rows="4" readonly required>{{ $mainNetwork->overview ?? '' }}</textarea>
                            </div>
                        </form>
                    </div>
                    <!-- Networks Section (existing) -->
                    <div class="tab-pane fade p-3" id="networks" role="tabpanel">
                        <form id="networksForm" class="section-form" action="{{ route('admin.networks.store') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="active_tab" value="#networks">
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
                            <div id="networks_items_container">
                                @if (isset($networks) && $networks->count() > 0)
                                    @foreach ($networks as $index => $item)
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
                // Tab logic
                let activeTab = @json($activeTab ?? null);
                if (!activeTab) {
                    activeTab = window.location.hash;
                }
                if (!activeTab) {
                    activeTab = localStorage.getItem('activeNetworkTab') || '#main-network';
                }
                $(`button[data-bs-target="${activeTab}"]`).tab('show');
                $('#networkTabs button[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
                    const targetTab = $(e.target).data('bs-target');
                    localStorage.setItem('activeNetworkTab', targetTab);
                    window.location.hash = targetTab;
                });
                // Edit button logic
                $('.edit-btn').click(function() {
                    const form = $(this).closest('form');
                    form.find('input:not([type="hidden"]), textarea, select').removeAttr('readonly disabled');
                    form.find('.save-btn, .remove-image-btn').show();
                    $(this).hide();
                });
                // Remove image button logic
                $('.remove-image-btn').click(function() {
                    const imageContainer = $(this).closest('.position-relative');
                    imageContainer.hide();
                    $(this).closest('form').find('input[name="remove_image"]').val(1);
                });
                // Dynamic item template
                function getItemTemplate(index) {
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
                    const container = $('#networks_items_container');
                    const index = container.children('.section-item').length;
                    container.find('.text-center').remove();
                    container.append(getItemTemplate(index));
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
                    const container = $('#networks_items_container');
                    if (container.children('.section-item').length === 0) {
                        container.html(
                            '<div class="text-center py-5"><p class="text-muted">No items added yet. Click Edit and then Add Item to create one.</p></div>'
                        );
                    }
                });
                // Enable all fields before submit
                $('.section-form').on('submit', function() {
                    $(this).find('input:not([type="hidden"]), textarea, select').removeAttr(
                        'readonly disabled');
                    // Update active tab
                    const activeTab = localStorage.getItem('activeNetworkTab') || '#main-network';
                    $(this).find('input[name="active_tab"]').val(activeTab);
                });
            });
        </script>
    @endpush
@endsection
