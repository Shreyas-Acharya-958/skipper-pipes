@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid" style="padding: 20px;">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Jal Rakshak Sections</h4>
                <a href="{{ url('/admin/company') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Pages
                </a>
            </div>
            <div class="card-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs mb-3" id="jalRakshakTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="menus-tab" data-bs-toggle="tab" data-bs-target="#menus"
                            type="button" role="tab">
                            Menus
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="banners-tab" data-bs-toggle="tab" data-bs-target="#banners"
                            type="button" role="tab">
                            Banner Images
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="initiative-tab" data-bs-toggle="tab" data-bs-target="#initiative"
                            type="button" role="tab">
                            Initiative
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="activities-tab" data-bs-toggle="tab" data-bs-target="#activities"
                            type="button" role="tab">
                            Activities
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="gallery-tab" data-bs-toggle="tab" data-bs-target="#gallery"
                            type="button" role="tab">
                            Photo Gallery
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="videos-tab" data-bs-toggle="tab" data-bs-target="#videos"
                            type="button" role="tab">
                            Videos
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="conservations-tab" data-bs-toggle="tab" data-bs-target="#conservations"
                            type="button" role="tab">
                            Conservation
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="involvement-tab" data-bs-toggle="tab" data-bs-target="#involvement"
                            type="button" role="tab">
                            Get Involved
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="seo-tab" data-bs-toggle="tab" data-bs-target="#seo" type="button"
                            role="tab">
                            SEO
                        </button>
                    </li>
                </ul>

                <!-- Tab content -->
                <div class="tab-content" id="jalRakshakTabsContent">
                    <!-- Menus Tab -->
                    <div class="tab-pane fade show active p-3" id="menus" role="tabpanel">
                        <div class=" mb-4">
                            <span class="fw-bold">Information:</span> Navigation Menus (Title, URL multiple rows)
                        </div>
                        <form id="menusForm" class="section-form" action="{{ route('admin.jal-rakshak.menus.save') }}"
                            method="POST">
                            @csrf
                            <input type="hidden" name="active_tab" value="#menus">

                            <div class="d-flex justify-content-between mb-3">
                                <button type="button" class="btn btn-warning add-item-btn" style="display: none;">
                                    <i class="fas fa-plus"></i> Add Menu Item
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

                            <div id="menus_items_container">
                                @if (isset($menus) && $menus->count() > 0)
                                    @foreach ($menus as $index => $menu)
                                        <div class="section-item border rounded p-3 mb-3">
                                            <div class="d-flex justify-content-between mb-2">
                                                <h6 class="mb-0">Menu Item {{ $index + 1 }}</h6>
                                                <button type="button" class="btn btn-sm btn-danger remove-item-btn"
                                                    style="display: none;">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">Title</label>
                                                        <input type="text" class="form-control"
                                                            name="menus[{{ $index }}][title]"
                                                            value="{{ $menu->title }}" readonly required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">URL</label>
                                                        <input type="text" class="form-control"
                                                            name="menus[{{ $index }}][url]"
                                                            value="{{ $menu->url }}" readonly required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="text-center py-5">
                                        <p class="text-muted">No menu items added yet. Click Edit and then Add Menu Item to
                                            create one.</p>
                                    </div>
                                @endif
                            </div>
                        </form>
                    </div>

                    <!-- Banner Images Tab -->
                    <div class="tab-pane fade p-3" id="banners" role="tabpanel">
                        <div class=" mb-4">
                            <span class="fw-bold">Information:</span> Banner Images
                        </div>
                        <form id="bannersForm" class="section-form"
                            action="{{ route('admin.jal-rakshak.banners.save') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="active_tab" value="#banners">

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
                                    value="{{ $banners->title ?? '' }}" readonly>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Desktop Images</label>
                                <div class="alert alert-info mb-3">
                                    <small>
                                        <strong>Note:</strong><br>
                                        • Upload multiple desktop banner images
                                    </small>
                                </div>

                                <div class="mb-2 d-flex flex-wrap gap-3">
                                    @if (isset($banners->images))
                                        @foreach ($banners->images as $index => $image)
                                            <div class="position-relative d-inline-block">
                                                <img src="{{ asset('storage/' . $image) }}"
                                                    alt="Desktop Banner Image {{ $index + 1 }}"
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
                                <label class="form-label">Mobile Image</label>
                                <div class="alert alert-info mb-3">
                                    <small>
                                        <strong>Note:</strong><br>
                                        • Upload a separate mobile banner image
                                    </small>
                                </div>

                                <div class="mb-2">
                                    @if (isset($banners) && $banners->mobile_image)
                                        <div class="position-relative d-inline-block">
                                            <img src="{{ asset('storage/' . $banners->mobile_image) }}"
                                                alt="Mobile Banner Image" style="max-width: 200px; height: auto;">
                                            <button type="button"
                                                class="btn btn-sm btn-danger position-absolute top-0 end-0 remove-mobile-image-btn"
                                                style="display: none;" data-image="mobile_image">&times;</button>
                                        </div>
                                    @endif
                                </div>
                                <input type="file" class="form-control" name="mobile_image" accept="image/*,.svg"
                                    disabled>
                                <input type="hidden" name="remove_mobile_image" value="0">
                            </div>
                        </form>
                    </div>

                    <!-- About the Initiative Tab -->
                    <div class="tab-pane fade p-3" id="initiative" role="tabpanel">
                        <div class=" mb-4">
                            <span class="fw-bold">Information:</span> About the Initiative
                        </div>
                        <form id="initiativeForm" class="section-form"
                            action="{{ route('admin.jal-rakshak.initiative.save') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="active_tab" value="#initiative">

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
                                    @if (isset($initiative) && $initiative->image)
                                        <div class="position-relative d-inline-block">
                                            <img src="{{ asset('storage/' . $initiative->image) }}"
                                                alt="Initiative Image" style="max-width: 200px; height: auto;">
                                            <button type="button"
                                                class="btn btn-sm btn-danger position-absolute top-0 end-0 remove-image-btn"
                                                style="display: none;" data-image="initiative_image">&times;</button>
                                        </div>
                                    @endif
                                </div>
                                <input type="file" class="form-control" name="image" accept="image/*,.svg"
                                    disabled>
                                <input type="hidden" name="remove_image" value="0">
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control" name="title"
                                    value="{{ $initiative->title ?? '' }}" readonly required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="initiative_description" class="form-label">Description</label>
                                <textarea class="form-control tinymce" id="initiative_description" name="description" rows="6" readonly
                                    required>{{ $initiative->description ?? '' }}</textarea>
                            </div>
                        </form>
                    </div>

                    <!-- Offline Activities Showcase Tab -->
                    <div class="tab-pane fade p-3" id="activities" role="tabpanel">
                        <div class=" mb-4">
                            <span class="fw-bold">Information:</span> Offline Activities Showcase
                        </div>
                        <form id="activitiesForm" class="section-form"
                            action="{{ route('admin.jal-rakshak.activities.save') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="active_tab" value="#activities">

                            <div class="d-flex justify-content-between mb-3">
                                <button type="button" class="btn btn-warning add-item-btn" style="display: none;">
                                    <i class="fas fa-plus"></i> Add Activity
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

                            <div id="activities_items_container">
                                @if (isset($activities) && $activities->count() > 0)
                                    @foreach ($activities as $index => $activity)
                                        <div class="section-item border rounded p-3 mb-3">
                                            <div class="d-flex justify-content-between mb-2">
                                                <h6 class="mb-0">Activity {{ $index + 1 }}</h6>
                                                <button type="button" class="btn btn-sm btn-danger remove-item-btn"
                                                    style="display: none;">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                            <input type="hidden" name="activities[{{ $index }}][id]"
                                                value="{{ $activity->id }}">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">Image</label>
                                                        @if ($activity->image)
                                                            <div class="position-relative d-inline-block mb-2">
                                                                <img src="{{ asset('storage/' . $activity->image) }}"
                                                                    alt="Activity Image {{ $index + 1 }}"
                                                                    style="max-width: 200px; height: auto;">
                                                                <button type="button"
                                                                    class="btn btn-sm btn-danger position-absolute top-0 end-0 remove-image-btn"
                                                                    style="display: none;"
                                                                    data-image="activity_{{ $index }}">&times;</button>
                                                            </div>
                                                        @endif
                                                        <input type="file" class="form-control"
                                                            name="activities[{{ $index }}][image_file]"
                                                            accept="image/*,.svg" disabled>
                                                        <input type="hidden"
                                                            name="activities[{{ $index }}][remove_image]"
                                                            value="0">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">Title</label>
                                                        <input type="text" class="form-control"
                                                            name="activities[{{ $index }}][title]"
                                                            value="{{ $activity->title }}" readonly required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Description</label>
                                                <textarea class="form-control" id="activity_description_{{ $index }}"
                                                    name="activities[{{ $index }}][description]" rows="3" readonly required>{{ $activity->description }}</textarea>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="text-center py-5">
                                        <p class="text-muted">No activities added yet. Click Edit and then Add Activity to
                                            create one.</p>
                                    </div>
                                @endif
                            </div>
                        </form>
                    </div>

                    <!-- Photo Gallery Tab -->
                    <div class="tab-pane fade p-3" id="gallery" role="tabpanel">
                        <div class=" mb-4">
                            <span class="fw-bold">Information:</span> Photo Gallery
                        </div>
                        <form id="galleryForm" class="section-form"
                            action="{{ route('admin.jal-rakshak.gallery.save') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="active_tab" value="#gallery">

                            <div class="d-flex justify-content-between mb-3">
                                <div>
                                    <button type="button" class="btn btn-warning add-item-btn" style="display: none;">
                                        <i class="fas fa-plus"></i> Add Gallery Item
                                    </button>
                                    <button type="button" class="btn btn-info add-category-btn" style="display: none;">
                                        <i class="fas fa-tags"></i> Add Category
                                    </button>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-primary me-2 edit-btn">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button type="submit" class="btn btn-success save-btn" style="display: none;">
                                        <i class="fas fa-save"></i> Save
                                    </button>
                                </div>
                            </div>

                            <div id="gallery_items_container">
                                @if (isset($gallery) && $gallery->count() > 0)
                                    @foreach ($gallery as $index => $galleryItem)
                                        <div class="section-item border rounded p-3 mb-3">
                                            <div class="d-flex justify-content-between mb-2">
                                                <h6 class="mb-0">Gallery Item {{ $index + 1 }}</h6>
                                                <button type="button" class="btn btn-sm btn-danger remove-item-btn"
                                                    style="display: none;">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                            <input type="hidden" name="gallery[{{ $index }}][id]"
                                                value="{{ $galleryItem->id }}">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">Image</label>
                                                        @if ($galleryItem->image)
                                                            <div class="position-relative d-inline-block mb-2">
                                                                <img src="{{ asset('storage/' . $galleryItem->image) }}"
                                                                    alt="Gallery Image {{ $index + 1 }}"
                                                                    style="max-width: 200px; height: auto;">
                                                                <button type="button"
                                                                    class="btn btn-sm btn-danger position-absolute top-0 end-0 remove-image-btn"
                                                                    style="display: none;"
                                                                    data-image="gallery_{{ $index }}">&times;</button>
                                                            </div>
                                                        @endif
                                                        <input type="file" class="form-control"
                                                            name="gallery[{{ $index }}][image_file]"
                                                            accept="image/*,.svg" disabled>
                                                        <input type="hidden"
                                                            name="gallery[{{ $index }}][remove_image]"
                                                            value="0">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">Categories</label>
                                                        <select class="form-control"
                                                            name="gallery[{{ $index }}][category_id]" readonly>
                                                            <option value="">Select Category</option>
                                                            @if (isset($categories))
                                                                @foreach ($categories as $category)
                                                                    <option value="{{ $category->id }}"
                                                                        @if ($galleryItem->category_id == $category->id) selected @endif>
                                                                        {{ $category->name }}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="text-center py-5">
                                        <p class="text-muted">No gallery items added yet. Click Edit and then Add Gallery
                                            Item to create one.</p>
                                    </div>
                                @endif
                            </div>
                        </form>

                        <!-- Category Management Modal -->
                        <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog"
                            aria-labelledby="categoryModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="categoryModalLabel">Manage Categories</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="categoryForm">
                                            @csrf
                                            <div class="form-group">
                                                <label for="category_name">Category Name</label>
                                                <input type="text" class="form-control" id="category_name"
                                                    name="name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="category_description">Description (Optional)</label>
                                                <textarea class="form-control" id="category_description" name="description" rows="3"></textarea>
                                            </div>
                                            <input type="hidden" id="category_id" name="id">
                                        </form>

                                        <!-- Existing Categories List -->
                                        <div class="mt-4">
                                            <h6>Existing Categories</h6>
                                            <div id="categoriesList">
                                                @if (isset($categories))
                                                    @foreach ($categories as $category)
                                                        <div class="d-flex justify-content-between align-items-center border-bottom py-2"
                                                            data-category-id="{{ $category->id }}">
                                                            <div>
                                                                <strong>{{ $category->name }}</strong>
                                                                @if ($category->description)
                                                                    <br><small
                                                                        class="text-muted">{{ $category->description }}</small>
                                                                @endif
                                                            </div>
                                                            <div>
                                                                <button type="button"
                                                                    class="btn btn-sm btn-primary edit-category-btn"
                                                                    data-category="{{ json_encode($category) }}">
                                                                    <i class="fas fa-edit"></i>
                                                                </button>
                                                                <button type="button"
                                                                    class="btn btn-sm btn-danger delete-category-btn"
                                                                    data-category-id="{{ $category->id }}">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" id="saveCategoryBtn">Save
                                            Category</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Videos Tab -->
                    <div class="tab-pane fade p-3" id="videos" role="tabpanel">
                        <div class=" mb-4">
                            <span class="fw-bold">Information:</span> Videos
                        </div>
                        <form id="videosForm" class="section-form" action="{{ route('admin.jal-rakshak.videos.save') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="active_tab" value="#videos">

                            <div class="d-flex justify-content-between mb-3">
                                <button type="button" class="btn btn-warning add-item-btn" style="display: none;">
                                    <i class="fas fa-plus"></i> Add Video
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

                            <div id="videos_items_container">
                                @if (isset($videos) && $videos->count() > 0)
                                    @foreach ($videos as $index => $video)
                                        <div class="section-item border rounded p-3 mb-3">
                                            <input type="hidden" name="videos[{{ $index }}][id]"
                                                value="{{ $video->id }}">
                                            <div class="d-flex justify-content-between mb-2">
                                                <h6 class="mb-0">Video {{ $index + 1 }}</h6>
                                                <div>
                                                    <button type="button"
                                                        class="btn btn-sm btn-danger remove-existing-video-btn me-2"
                                                        data-video-id="{{ $video->id }}" style="display: none;">
                                                        <i class="fas fa-trash"></i> Remove
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-danger remove-item-btn"
                                                        style="display: none;">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">Video File</label>
                                                        <input type="file" class="form-control video-file-input"
                                                            name="videos[{{ $index }}][video_file]"
                                                            accept="video/*" readonly>
                                                        @if ($video->video_file)
                                                            <div class="mt-2">
                                                                <small class="text-muted">Current:
                                                                    {{ basename($video->video_file) }}</small>
                                                                <br>
                                                                <video width="200" height="120" controls
                                                                    class="mt-1">
                                                                    <source
                                                                        src="{{ asset('storage/' . $video->video_file) }}"
                                                                        type="video/mp4">
                                                                    Your browser does not support the video tag.
                                                                </video>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">Title (Optional)</label>
                                                        <input type="text" class="form-control"
                                                            name="videos[{{ $index }}][title]"
                                                            value="{{ $video->title }}" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="text-center py-5">
                                        <p class="text-muted">No videos added yet. Click Edit and then Add Video to create
                                            one.</p>
                                    </div>
                                @endif
                            </div>
                        </form>
                    </div>

                    <!-- Water Conservation Tab -->
                    <div class="tab-pane fade p-3" id="conservations" role="tabpanel">
                        <div class=" mb-4">
                            <span class="fw-bold">Information:</span> Water Conservation Facts & Tips
                        </div>
                        <form id="conservationsForm" class="section-form"
                            action="{{ route('admin.jal-rakshak.conservations.save') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="active_tab" value="#conservations">

                            <div class="d-flex justify-content-between mb-3">
                                <button type="button" class="btn btn-warning add-item-btn" style="display: none;">
                                    <i class="fas fa-plus"></i> Add Conservation Item
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

                            <div id="conservations_items_container">
                                @if (isset($conservations) && $conservations->count() > 0)
                                    @foreach ($conservations as $index => $conservation)
                                        <div class="section-item border rounded p-3 mb-3">
                                            <div class="d-flex justify-content-between mb-2">
                                                <h6 class="mb-0">Conservation Item {{ $index + 1 }}</h6>
                                                <button type="button" class="btn btn-sm btn-danger remove-item-btn"
                                                    style="display: none;">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                            <input type="hidden" name="conservations[{{ $index }}][id]"
                                                value="{{ $conservation->id }}">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">Image</label>
                                                        @if ($conservation->image)
                                                            <div class="position-relative d-inline-block mb-2">
                                                                <img src="{{ asset('storage/' . $conservation->image) }}"
                                                                    alt="Conservation Image {{ $index + 1 }}"
                                                                    style="max-width: 200px; height: auto;">
                                                                <button type="button"
                                                                    class="btn btn-sm btn-danger position-absolute top-0 end-0 remove-image-btn"
                                                                    style="display: none;"
                                                                    data-image="conservation_{{ $index }}">&times;</button>
                                                            </div>
                                                        @endif
                                                        <input type="file" class="form-control"
                                                            name="conservations[{{ $index }}][image_file]"
                                                            accept="image/*,.svg" disabled>
                                                        <input type="hidden"
                                                            name="conservations[{{ $index }}][remove_image]"
                                                            value="0">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">Title</label>
                                                        <input type="text" class="form-control"
                                                            name="conservations[{{ $index }}][title]"
                                                            value="{{ $conservation->title }}" readonly required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Description</label>
                                                <textarea class="form-control tinymce" id="conservation_description_{{ $index }}"
                                                    name="conservations[{{ $index }}][description]" rows="6" readonly required>{{ $conservation->description }}</textarea>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="text-center py-5">
                                        <p class="text-muted">No conservation items added yet. Click Edit and then Add
                                            Conservation Item to create one.</p>
                                    </div>
                                @endif
                            </div>
                        </form>
                    </div>

                    <!-- Get Involved Tab -->
                    <div class="tab-pane fade p-3" id="involvement" role="tabpanel">
                        <div class=" mb-4">
                            <span class="fw-bold">Information:</span> Get Involved Section
                        </div>
                        <form id="involvementForm" class="section-form"
                            action="{{ route('admin.jal-rakshak.involvement.save') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="active_tab" value="#involvement">

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
                                    @if (isset($involvement) && $involvement->image)
                                        <div class="position-relative d-inline-block">
                                            <img src="{{ asset('storage/' . $involvement->image) }}"
                                                alt="Involvement Image" style="max-width: 200px; height: auto;">
                                            <button type="button"
                                                class="btn btn-sm btn-danger position-absolute top-0 end-0 remove-image-btn"
                                                style="display: none;" data-image="involvement_image">&times;</button>
                                        </div>
                                    @endif
                                </div>
                                <input type="file" class="form-control" name="image" accept="image/*,.svg"
                                    disabled>
                                <input type="hidden" name="remove_image" value="0">
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Head Title</label>
                                <input type="text" class="form-control" name="head_title"
                                    value="{{ $involvement->head_title ?? '' }}" readonly required>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Form Title</label>
                                <input type="text" class="form-control" name="form_title"
                                    value="{{ $involvement->form_title ?? '' }}" readonly required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="involvement_description" class="form-label">Description</label>
                                <textarea class="form-control tinymce" id="involvement_description" name="description" rows="6" readonly>{{ $involvement->description ?? '' }}</textarea>
                            </div>
                        </form>
                    </div>

                    <!-- SEO Tab -->
                    <div class="tab-pane fade p-3" id="seo" role="tabpanel">
                        <div class=" mb-4">
                            <span class="fw-bold">Information:</span> SEO Settings
                        </div>
                        <form id="seoForm" class="section-form" action="{{ route('admin.jal-rakshak.seo.save') }}"
                            method="POST">
                            @csrf
                            <input type="hidden" name="active_tab" value="#seo">

                            <div class="d-flex justify-content-end mb-3">
                                <button type="button" class="btn btn-primary me-2 edit-btn">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <button type="submit" class="btn btn-success save-btn" style="display: none;">
                                    <i class="fas fa-save"></i> Save
                                </button>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Meta Title</label>
                                <input type="text" class="form-control" name="meta_title"
                                    value="{{ $seo->meta_title ?? '' }}" readonly placeholder="Enter meta title for SEO">
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Meta Description</label>
                                <textarea class="form-control" name="meta_description" rows="4" readonly
                                    placeholder="Enter meta description for SEO">{{ $seo->meta_description ?? '' }}</textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Meta Keywords</label>
                                <textarea class="form-control" name="meta_keywords" rows="3" readonly
                                    placeholder="Enter meta keywords separated by commas">{{ $seo->meta_keywords ?? '' }}</textarea>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .nav-tabs .nav-link {
                padding: 0.5rem 0.75rem;
                font-size: 0.875rem;
                white-space: nowrap;
            }

            .nav-tabs {
                flex-wrap: nowrap;
                overflow-x: auto;
            }

            .nav-tabs::-webkit-scrollbar {
                height: 4px;
            }

            .nav-tabs::-webkit-scrollbar-track {
                background: #f1f1f1;
            }

            .nav-tabs::-webkit-scrollbar-thumb {
                background: #888;
                border-radius: 2px;
            }
        </style>
    @endpush

    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.1.1/tinymce.min.js"></script>
        <script>
            function initJalRakshakTinyMCE() {
                $('.tinymce').each(function() {
                    const id = $(this).attr('id');
                    if (!id) return; // Skip if no ID

                    // Remove existing editor if it exists
                    if (tinymce.get(id)) {
                        tinymce.get(id).remove();
                    }

                    // Initialize TinyMCE for all tinymce elements - always enabled
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
                        keep_styles: true,
                        setup: function(editor) {
                            editor.on('change', function() {
                                editor.save();
                            });
                            editor.on('init', function() {
                                // Ensure content is properly loaded
                                const textarea = $('#' + id);
                                if (textarea.length && textarea.val()) {
                                    editor.setContent(textarea.val());
                                }
                            });
                        }
                    });
                });
            }
            $(document).ready(function() {
                // Initialize TinyMCE after a short delay to ensure DOM is fully ready
                setTimeout(function() {
                    initJalRakshakTinyMCE();
                }, 500);
                // Get the tab ID from URL hash or localStorage
                let activeTab = window.location.hash;
                if (!activeTab) {
                    activeTab = localStorage.getItem('activeJalRakshakTab') || '#menus';
                }

                // Show the active tab
                $(`button[data-bs-target="${activeTab}"]`).tab('show');

                // Store the active tab when tab is changed
                $('#jalRakshakTabs button[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
                    const targetTab = $(e.target).data('bs-target');
                    localStorage.setItem('activeJalRakshakTab', targetTab);
                    window.location.hash = targetTab;
                    setTimeout(initJalRakshakTinyMCE, 200); // Re-init TinyMCE on tab change
                });

                // Edit button click handler
                $('.edit-btn').click(function() {
                    const form = $(this).closest('form');
                    form.find('input:not([type="hidden"]), textarea, select').removeAttr(
                        'readonly disabled');
                    form.find(
                        '.save-btn, .remove-image-btn, .remove-mobile-image-btn, .remove-existing-video-btn'
                    ).show();
                    // Show the add-item-btn and add-category-btn if they exist in this form
                    form.find('.add-item-btn').show();
                    form.find('.add-category-btn').show();
                    $(this).hide();

                    // TinyMCE editors are always enabled, no need to modify them
                });

                // Remove image button click handler for banners and gallery
                $(document).on('click', '#banners .remove-image-btn, #gallery .remove-image-btn', function() {
                    const imageContainer = $(this).closest('.position-relative');
                    const imagePath = $(this).data('image');
                    const deletedInput = imageContainer.find('.deleted-image-input');

                    // Mark image for deletion
                    deletedInput.val(imagePath);
                    imageContainer.hide();
                });

                // Remove mobile image button click handler
                $(document).on('click', '#banners .remove-mobile-image-btn', function() {
                    const imageContainer = $(this).closest('.position-relative');
                    const removeInput = $('input[name="remove_mobile_image"]');

                    // Mark mobile image for removal
                    removeInput.val('1');
                    imageContainer.hide();
                });

                // Dynamic item template
                function getItemTemplate(index, containerId, type) {
                    if (type === 'menu') {
                        return `
                            <div class="section-item border rounded p-3 mb-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <h6 class="mb-0">Menu Item ${index + 1}</h6>
                                    <button type="button" class="btn btn-sm btn-danger remove-item-btn">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Title</label>
                                            <input type="text" class="form-control" name="menus[${index}][title]" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">URL</label>
                                            <input type="text" class="form-control" name="menus[${index}][url]" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                    } else if (type === 'activity') {
                        return `
                            <div class="section-item border rounded p-3 mb-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <h6 class="mb-0">Activity ${index + 1}</h6>
                                    <button type="button" class="btn btn-sm btn-danger remove-item-btn">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Image</label>
                                            <input type="file" class="form-control" name="activities[${index}][image_file]" accept="image/*,.svg">
                                            <input type="hidden" name="activities[${index}][remove_image]" value="0">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Title</label>
                                            <input type="text" class="form-control" name="activities[${index}][title]" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" id="activity_description_${index}" name="activities[${index}][description]" rows="3" required></textarea>
                                </div>
                            </div>
                        `;
                    } else if (type === 'video') {
                        return `
                            <div class="section-item border rounded p-3 mb-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <h6 class="mb-0">Video ${index + 1}</h6>
                                    <button type="button" class="btn btn-sm btn-danger remove-item-btn">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Video File</label>
                                            <input type="file" class="form-control video-file-input" name="videos[${index}][video_file]" accept="video/*" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Title (Optional)</label>
                                            <input type="text" class="form-control" name="videos[${index}][title]">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                    } else if (type === 'conservation') {
                        return `
                            <div class="section-item border rounded p-3 mb-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <h6 class="mb-0">Conservation Item ${index + 1}</h6>
                                    <button type="button" class="btn btn-sm btn-danger remove-item-btn">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Image</label>
                                            <input type="file" class="form-control" name="conservations[${index}][image_file]" accept="image/*,.svg">
                                            <input type="hidden" name="conservations[${index}][remove_image]" value="0">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Title</label>
                                            <input type="text" class="form-control" name="conservations[${index}][title]" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control tinymce" id="conservation_description_${index}" name="conservations[${index}][description]" rows="6" required></textarea>
                                </div>
                            </div>
                        `;
                    } else if (type === 'gallery') {
                        return `
                            <div class="section-item border rounded p-3 mb-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <h6 class="mb-0">Gallery Item ${index + 1}</h6>
                                    <button type="button" class="btn btn-sm btn-danger remove-item-btn">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Image</label>
                                            <input type="file" class="form-control" name="gallery[${index}][image_file]" accept="image/*,.svg">
                                            <input type="hidden" name="gallery[${index}][remove_image]" value="0">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Categories</label>
                                            <select class="form-control" name="gallery[${index}][category_id]">
                                                <option value="">Select Category</option>
                                                @if (isset($categories))
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                    }
                }

                // Add item button click handler
                $('.add-item-btn').click(function() {
                    const container = $(this).closest('.tab-pane').find('[id$="_items_container"]');
                    const index = container.children('.section-item').length;
                    const tabId = $(this).closest('.tab-pane').attr('id');

                    let type = 'menu';
                    if (tabId === 'activities') type = 'activity';
                    else if (tabId === 'videos') type = 'video';
                    else if (tabId === 'conservations') type = 'conservation';
                    else if (tabId === 'gallery') type = 'gallery';

                    container.find('.text-center').remove();
                    container.append(getItemTemplate(index, container.attr('id'), type));
                    // Re-initialize TinyMCE for new content
                    setTimeout(function() {
                        initJalRakshakTinyMCE();
                    }, 200);
                });

                // Remove item button click handler
                $(document).on('click', '.remove-item-btn', function() {
                    const item = $(this).closest('.section-item');
                    item.remove();

                    const container = $(this).closest('[id$="_items_container"]');
                    if (container.children('.section-item').length === 0) {
                        container.html(
                            '<div class="text-center py-5"><p class="text-muted">No items added yet. Click Edit and then Add Item to create one.</p></div>'
                        );
                    }
                });

                // Remove existing video button click handler
                $(document).on('click', '.remove-existing-video-btn', function() {
                    const videoId = $(this).data('video-id');
                    const item = $(this).closest('.section-item');

                    if (confirm('Are you sure you want to delete this video? This action cannot be undone.')) {
                        $.ajax({
                            url: `/admin/jal-rakshak/videos/delete/${videoId}`,
                            type: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                if (response.success) {
                                    item.fadeOut(300, function() {
                                        $(this).remove();

                                        const container = item.closest(
                                            '[id$="_items_container"]');
                                        if (container.children('.section-item').length ===
                                            0) {
                                            container.html(
                                                '<div class="text-center py-5"><p class="text-muted">No videos added yet. Click Edit and then Add Video to create one.</p></div>'
                                            );
                                        }
                                    });

                                    // Show success message
                                    if (typeof toastr !== 'undefined') {
                                        toastr.success(response.message);
                                    } else {
                                        alert(response.message);
                                    }
                                } else {
                                    alert('Error: ' + response.message);
                                }
                            },
                            error: function(xhr) {
                                let message = 'Error deleting video';
                                if (xhr.responseJSON && xhr.responseJSON.message) {
                                    message = xhr.responseJSON.message;
                                }
                                alert(message);
                            }
                        });
                    }
                });

                // Handle form submission
                $('.section-form').on('submit', function(e) {
                    // Enable all fields before submit
                    $(this).find('input:not([type="hidden"]), textarea, select').removeAttr(
                        'readonly disabled');

                    // Update active tab
                    const activeTab = localStorage.getItem('activeJalRakshakTab') || '#menus';
                    $(this).find('input[name="active_tab"]').val(activeTab);

                    // Update textarea values from TinyMCE
                    $(this).find('.tinymce').each(function() {
                        const id = $(this).attr('id');
                        if (id) {
                            const editor = tinymce.get(id);
                            if (editor && !editor.isHidden()) {
                                $(this).val(editor.getContent());
                            }
                        }
                    });
                });

                // Category Management Functions
                $('.add-category-btn').click(function() {
                    $('#categoryModal').modal('show');
                    $('#categoryForm')[0].reset();
                    $('#category_id').val('');
                    $('#categoryModalLabel').text('Add New Category');
                });

                $(document).on('click', '.edit-category-btn', function() {
                    const category = JSON.parse($(this).data('category'));
                    $('#category_name').val(category.name);
                    $('#category_description').val(category.description);
                    $('#category_id').val(category.id);
                    $('#categoryModalLabel').text('Edit Category');
                    $('#categoryModal').modal('show');
                });

                $(document).on('click', '.delete-category-btn', function() {
                    if (confirm('Are you sure you want to delete this category?')) {
                        const categoryId = $(this).data('category-id');
                        $.ajax({
                            url: '{{ route('admin.jal-rakshak.categories.delete') }}',
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                id: categoryId
                            },
                            success: function(response) {
                                if (response.success) {
                                    $(`[data-category-id="${categoryId}"]`).remove();
                                    // Refresh the page to update category dropdowns
                                    location.reload();
                                } else {
                                    alert('Error deleting category: ' + response.message);
                                }
                            },
                            error: function() {
                                alert('Error deleting category');
                            }
                        });
                    }
                });

                $('#saveCategoryBtn').click(function() {
                    const formData = {
                        _token: '{{ csrf_token() }}',
                        name: $('#category_name').val(),
                        description: $('#category_description').val(),
                        id: $('#category_id').val()
                    };

                    $.ajax({
                        url: '{{ route('admin.jal-rakshak.categories.save') }}',
                        method: 'POST',
                        data: formData,
                        success: function(response) {
                            if (response.success) {
                                $('#categoryModal').modal('hide');
                                // Refresh the page to update category dropdowns
                                location.reload();
                            } else {
                                alert('Error saving category: ' + response.message);
                            }
                        },
                        error: function() {
                            alert('Error saving category');
                        }
                    });
                });
            });

            // Chunked Video Upload Functionality
            function uploadVideoInChunks(file, title, progressCallback, successCallback, errorCallback) {
                const chunkSize = 2 * 1024 * 1024; // 2MB chunks
                const totalChunks = Math.ceil(file.size / chunkSize);
                const uploadId = 'upload_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9);

                let uploadedChunks = 0;

                function uploadChunk(chunkIndex) {
                    const start = chunkIndex * chunkSize;
                    const end = Math.min(start + chunkSize, file.size);
                    const chunk = file.slice(start, end);

                    const formData = new FormData();
                    formData.append('chunk', chunk);
                    formData.append('chunk_index', chunkIndex);
                    formData.append('total_chunks', totalChunks);
                    formData.append('file_name', file.name);
                    formData.append('file_size', file.size);
                    formData.append('upload_id', uploadId);
                    formData.append('title', title);
                    formData.append('auto_save', '1');
                    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

                    $.ajax({
                        url: '{{ route('admin.jal-rakshak.videos.upload-chunk') }}',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if (response.success) {
                                uploadedChunks++;

                                if (response.upload_complete) {
                                    successCallback(response.file_path, response.video_id);
                                } else {
                                    const progress = (uploadedChunks / totalChunks) * 100;
                                    progressCallback(progress);
                                    uploadChunk(chunkIndex + 1);
                                }
                            } else {
                                errorCallback('Upload failed: ' + response.message);
                            }
                        },
                        error: function(xhr) {
                            errorCallback('Upload failed: ' + xhr.responseText);
                        }
                    });
                }

                uploadChunk(0);
            }

            // Override video file input change event
            $(document).on('change', '.video-file-input', function() {
                const file = this.files[0];
                if (!file) return;

                // Check file size (optional - you can set a limit)
                const maxSize = 100 * 1024 * 1024; // 100MB
                if (file.size > maxSize) {
                    alert('File size too large. Maximum allowed size is 100MB.');
                    this.value = '';
                    return;
                }

                const $input = $(this);
                const $container = $input.closest('.section-item');

                // Get the title from the title input field
                const title = $container.find('input[name*="[title]"]').val() || '';

                // Create progress bar
                let $progressBar = $container.find('.upload-progress');
                if ($progressBar.length === 0) {
                    $progressBar = $(`
                        <div class="upload-progress mt-2" style="display: none;">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: 0%"></div>
                            </div>
                            <small class="upload-status text-muted">Uploading...</small>
                        </div>
                    `);
                    $input.after($progressBar);
                }

                // Show progress bar
                $progressBar.show();
                $progressBar.find('.upload-status').text('Uploading...');

                // Disable input during upload
                $input.prop('disabled', true);

                uploadVideoInChunks(
                    file,
                    title,
                    function(progress) {
                        // Progress callback
                        $progressBar.find('.progress-bar').css('width', progress + '%');
                        $progressBar.find('.upload-status').text(`Uploading... ${Math.round(progress)}%`);
                    },
                    function(filePath, videoId) {
                        // Success callback
                        $progressBar.find('.progress-bar').css('width', '100%');
                        $progressBar.find('.upload-status').text('Upload completed and saved!');

                        // If video was auto-saved, reload the page to show the new video
                        if (videoId) {
                            setTimeout(() => {
                                location.reload();
                            }, 2000);
                        } else {
                            // Create hidden input to store the file path for manual save
                            $input.after(
                                `<input type="hidden" name="${$input.attr('name').replace('[video_file]', '[uploaded_file_path]')}" value="${filePath}">`
                            );

                            // Show success message
                            setTimeout(() => {
                                $progressBar.hide();
                                $input.prop('disabled', false);
                            }, 2000);
                        }
                    },
                    function(error) {
                        // Error callback
                        $progressBar.find('.upload-status').text('Upload failed: ' + error);
                        $progressBar.find('.progress-bar').addClass('bg-danger');
                        $input.prop('disabled', false);
                        alert('Upload failed: ' + error);
                    }
                );
            });
        </script>
    @endpush
@endsection
