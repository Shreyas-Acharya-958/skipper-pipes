@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid" style="padding: 20px;">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Home Page Management</h4>
            </div>
            <div class="card-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs mb-3" id="homePageTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="section1-tab" data-bs-toggle="tab" href="#section1" role="tab">
                            Section 1
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="section2-tab" data-bs-toggle="tab" href="#section2" role="tab">
                            Section 2
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="section3-tab" data-bs-toggle="tab" href="#section3" role="tab">
                            Section 3
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="section4-tab" data-bs-toggle="tab" href="#section4" role="tab">
                            Section 4
                        </a>
                    </li>
                </ul>

                <!-- Tab content -->
                <div class="tab-content" id="homePageTabsContent">
                    <!-- Section 1 -->
                    <div class="tab-pane fade show active p-3" id="section1" role="tabpanel">
                        <div class="alert-info mb-4">
                            <span class="fw-bold">Information:</span> Why Skipper Pipes
                        </div>
                        <form id="section1Form" class="section-form" action="{{ route('admin.home-page.section1.save') }}"
                            method="POST" enctype="multipart/form-data">
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
                                <label for="title1" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title1" name="title"
                                    value="{{ $sectionOne->title ?? '' }}" readonly>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Media Type</label>
                                <select class="form-select" id="mediaType1" name="media_type" disabled>
                                    <option value="image" {{ !isset($sectionOne->video) ? 'selected' : '' }}>Image</option>
                                    <option value="video" {{ isset($sectionOne->video) ? 'selected' : '' }}>Video</option>
                                </select>
                            </div>

                            <div class="form-group mb-3" id="imageSection1"
                                style="{{ isset($sectionOne->video) ? 'display: none;' : '' }}">
                                <label for="image1" class="form-label">Image</label>
                                @if (isset($sectionOne->image))
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $sectionOne->image) }}" alt="Current Image"
                                            style="max-width: 200px;">
                                    </div>
                                @endif
                                <input type="file" class="form-control" id="image1" name="image"
                                    accept="image/*,.svg" disabled>
                            </div>

                            <div class="form-group mb-3" id="videoSection1"
                                style="{{ !isset($sectionOne->video) ? 'display: none;' : '' }}">
                                <label for="video1" class="form-label">Video</label>
                                @if (isset($sectionOne->video))
                                    <div class="mb-2">
                                        <video width="200" controls>
                                            <source src="{{ asset('storage/' . $sectionOne->video) }}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    </div>
                                @endif
                                <input type="file" class="form-control" id="video1" name="video" accept="video/*"
                                    disabled>
                                <small class="text-muted">Supported formats: MP4, WebM, Ogg</small>
                            </div>

                            <div class="form-group mb-3">
                                <label for="description1" class="form-label">Description</label>
                                <textarea class="form-control" id="description1" name="description" rows="4" readonly>{{ $sectionOne->description ?? '' }}</textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Features</label>
                                <div id="features">
                                    @php
                                        $defaultFeatures = [
                                            ['id' => 1, 'title' => '16+ Years of Industry Expertise'],
                                            ['id' => 2, 'title' => 'Pan India Presence'],
                                            ['id' => 3, 'title' => 'Wide Range of Products'],
                                            ['id' => 4, 'title' => 'Best Quality Products'],
                                        ];

                                        $features =
                                            isset($sectionOne) && $sectionOne->features->count() > 0
                                                ? $sectionOne->features
                                                : $defaultFeatures;
                                    @endphp

                                    @foreach ($features as $index => $feature)
                                        <div class="feature border rounded">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 me-2">
                                                    <label class="form-label small">Feature {{ $index + 1 }}</label>
                                                    <input type="text" class="form-control form-control-sm"
                                                        name="features[{{ $index }}][title]"
                                                        value="{{ $feature['title'] }}" readonly>
                                                    <input type="hidden" name="features[{{ $index }}][id]"
                                                        value="{{ $feature['id'] }}">
                                                </div>
                                                <div class="icon-section">
                                                    <label class="form-label small">Icon</label>
                                                    <div class="d-flex align-items-center">
                                                        @if (isset($feature['icon']))
                                                            <div class="me-2">
                                                                <img src="{{ asset('storage/' . $feature['icon']) }}"
                                                                    alt="Feature Icon">
                                                            </div>
                                                        @endif
                                                        <input type="file" class="form-control form-control-sm"
                                                            name="features[{{ $index }}][icon]"
                                                            accept="image/*,.svg" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Section 2 -->
                    <div class="tab-pane fade p-3" id="section2" role="tabpanel">
                        <div class="alert-info mb-4">
                            <span class="fw-bold">Information:</span> Empowering Every Plumber
                        </div>
                        <form id="section2Form" class="section-form"
                            action="{{ route('admin.home-page.section2.save') }}" method="POST"
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
                                <label for="title2" class="form-label">Title</label>
                                <input type="text" class="form-control form-control-sm" id="title2" name="title"
                                    value="{{ $sectionTwo->title ?? '' }}" readonly>
                            </div>

                            <div class="form-group mb-3">
                                <label for="description2" class="form-label">Description</label>
                                <textarea class="form-control tinyeditor" id="description2" name="description" rows="4" readonly>{{ $sectionTwo->description ?? '' }}</textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label for="image2" class="form-label">Image</label>
                                @if (isset($sectionTwo->image))
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $sectionTwo->image) }}" alt="Current Image"
                                            style="max-width: 200px;">
                                    </div>
                                @endif
                                <input type="file" class="form-control form-control-sm" id="image2" name="image"
                                    disabled>
                            </div>

                            <div class="form-group mb-3">
                                <label for="image_title2" class="form-label">Image Title</label>
                                <input type="text" class="form-control form-control-sm" id="image_title2"
                                    name="image_title" value="{{ $sectionTwo->image_title ?? '' }}" readonly>
                            </div>

                            <div class="form-group mb-3">
                                <label for="image_button2" class="form-label">Image Button</label>
                                <input type="text" class="form-control form-control-sm" id="image_button2"
                                    name="image_button" value="{{ $sectionTwo->image_button ?? '' }}" readonly>
                            </div>

                            <div class="form-group mb-3">
                                <label for="link2" class="form-label">Link</label>
                                <input type="text" class="form-control form-control-sm" id="link2" name="link"
                                    value="{{ $sectionTwo->link ?? '' }}" readonly>
                            </div>
                        </form>
                    </div>

                    <!-- Section 3 -->
                    <div class="tab-pane fade p-3" id="section3" role="tabpanel">
                        <div class="alert-info mb-4">
                            <span class="fw-bold">Information:</span> Video Part
                        </div>
                        <form id="section3Form" class="section-form"
                            action="{{ route('admin.home-page.section3.save') }}" method="POST"
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
                                <label for="title3" class="form-label">Title</label>
                                <input type="text" class="form-control form-control-sm" id="title3" name="title"
                                    value="{{ $sectionThree->title ?? '' }}" readonly>
                            </div>

                            <div class="form-group mb-3" style="display: none;">
                                <label for="image3" class="form-label">Image</label>
                                <input type="text" class="form-control form-control-sm" id="image3" name="image"
                                    value="{{ $sectionThree->image ?? '' }}" readonly>
                            </div>

                            <div class="form-group mb-3">
                                <label for="video_link" class="form-label">Video Link</label>
                                <input type="text" class="form-control form-control-sm" id="video_link"
                                    name="video_link" value="{{ $sectionThree->video_link ?? '' }}" readonly>
                            </div>
                        </form>
                    </div>

                    <!-- Section 4 -->
                    <div class="tab-pane fade p-3" id="section4" role="tabpanel">
                        <div class="alert-info mb-4">
                            <span class="fw-bold">Information:</span> Review Part
                        </div>
                        <form id="section4Form" class="section-form"
                            action="{{ route('admin.home-page.section4.save') }}" method="POST"
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
                                <label for="image4" class="form-label">Image</label>
                                @if (isset($sectionFour->image))
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $sectionFour->image) }}" alt="Current Image"
                                            style="max-width: 200px;">
                                    </div>
                                @endif
                                <input type="file" class="form-control form-control-sm" id="image4" name="image"
                                    disabled>
                            </div>

                            <div class="form-group mb-3">
                                <label for="title4" class="form-label">Title</label>
                                <input type="text" class="form-control form-control-sm" id="title4" name="title"
                                    value="{{ $sectionFour->title ?? '' }}" readonly>
                            </div>

                            <div class="form-group mb-3" style="display: none;">
                                <label for="description4" class="form-label">Description</label>
                                <textarea class="form-control form-control-sm" id="description4" name="description" rows="4" readonly>{{ $sectionFour->description ?? '' }}</textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Reviews</label>
                                <div id="reviews">
                                    @php
                                        $defaultReviews = [
                                            [
                                                'id' => 1,
                                                'person_name' => 'John Doe',
                                                'person_role' => 'Plumber',
                                                'star' => 5,
                                                'description' =>
                                                    'Excellent quality pipes that make my plumbing work much easier. The durability and ease of installation are outstanding.',
                                            ],
                                            [
                                                'id' => 2,
                                                'person_name' => 'Jane Smith',
                                                'person_role' => 'Contractor',
                                                'star' => 4,
                                                'description' =>
                                                    'As a contractor, I appreciate the consistency in quality. Their pipes have been reliable for all my construction projects.',
                                            ],
                                            [
                                                'id' => 3,
                                                'person_name' => 'Mike Johnson',
                                                'person_role' => 'Builder',
                                                'star' => 5,
                                                'description' =>
                                                    'The wide range of products and their superior quality have made my building projects much more efficient.',
                                            ],
                                            [
                                                'id' => 4,
                                                'person_name' => 'Sarah Wilson',
                                                'person_role' => 'Dealer',
                                                'star' => 4,
                                                'description' =>
                                                    'Great product lineup and excellent customer support. My customers are always satisfied with Skipper Pipes products.',
                                            ],
                                            [
                                                'id' => 5,
                                                'person_name' => 'Robert Brown',
                                                'person_role' => 'Distributor',
                                                'star' => 5,
                                                'description' =>
                                                    'The product quality and brand reputation make these pipes easy to distribute. Excellent market demand and customer satisfaction.',
                                            ],
                                        ];

                                        $reviews =
                                            isset($sectionFour) && $sectionFour->reviews->count() > 0
                                                ? $sectionFour->reviews
                                                : $defaultReviews;
                                    @endphp

                                    @foreach ($reviews as $index => $review)
                                        <div class="review border rounded p-3 mb-3">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label small">Review {{ $index + 1 }}</label>
                                                        <input type="text" class="form-control form-control-sm"
                                                            name="reviews[{{ $index }}][person_name]"
                                                            value="{{ $review['person_name'] }}" readonly>
                                                        <input type="hidden" name="reviews[{{ $index }}][id]"
                                                            value="{{ $review['id'] }}">
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label class="form-label small">Role</label>
                                                        <input type="text" class="form-control form-control-sm"
                                                            name="reviews[{{ $index }}][person_role]"
                                                            value="{{ $review['person_role'] }}" readonly>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label class="form-label small">Rating (1-5)</label>
                                                        <input type="number" class="form-control form-control-sm"
                                                            name="reviews[{{ $index }}][star]"
                                                            value="{{ $review['star'] }}" min="1" max="5"
                                                            readonly>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label class="form-label small">Description</label>
                                                        <textarea class="form-control form-control-sm" name="reviews[{{ $index }}][description]" rows="3"
                                                            readonly>{{ $review['description'] }}</textarea>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label class="form-label small">Status</label>
                                                        <select class="form-select form-select-sm"
                                                            name="reviews[{{ $index }}][status]">
                                                            <option value="1"
                                                                {{ isset($review['status']) && $review['status'] == 1 ? 'selected' : '' }}>
                                                                Active</option>
                                                            <option value="0"
                                                                {{ isset($review['status']) && $review['status'] == 0 ? 'selected' : '' }}>
                                                                Inactive</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label small">Photo</label>
                                                        @if (isset($review['person_image']))
                                                            <div class="mb-2">
                                                                <img src="{{ asset('storage/' . $review['person_image']) }}"
                                                                    alt="Review {{ $index + 1 }} Photo"
                                                                    style="max-width: 100px;">
                                                            </div>
                                                        @endif
                                                        <input type="file" class="form-control form-control-sm"
                                                            name="reviews[{{ $index }}][person_image]"
                                                            accept="image/*,.svg" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Toast -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="successToast" class="toast align-items-center text-white bg-success border-0" role="alert"
            aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    Section saved successfully!
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.1.1/tinymce.min.js"></script>
    <script>
        // Setup CSRF token for all AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Initialize TinyMCE
        tinymce.init({
            selector: '#description2',
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
            keep_styles: true,
            setup: function(editor) {
                editor.on('change', function() {
                    editor.save();
                });
            }
        });

        // Keep the active tab after page refresh
        $(document).ready(function() {
            // Get active tab from URL hash or localStorage
            const activeTab = window.location.hash || localStorage.getItem('activeHomeTab') || '#section1';

            // Show the active tab
            $('a[data-bs-toggle="tab"][href="' + activeTab + '"]').tab('show');

            // Store the active tab when changed
            $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
                const tab = $(e.target).attr('href');
                localStorage.setItem('activeHomeTab', tab);
                window.location.hash = tab;
            });

            // Handle Edit button click
            $('.edit-btn').click(function() {
                const form = $(this).closest('form');

                // Hide edit button, show save button
                $(this).hide();
                form.find('.save-btn').show();

                // Enable all inputs and selects
                form.find('input:not([type="hidden"]), textarea, select').removeAttr('readonly disabled');
                form.find('input[type="file"]').removeAttr('disabled');
            });

            // Handle form submission
            $('.section-form').on('submit', function(e) {
                e.preventDefault();

                const form = $(this);
                const formData = new FormData(this);

                // Get current active tab ID (just the section part)
                const activeTabId = $('.nav-link.active').attr('href').split('#')[1];

                $.ajax({
                    url: form.attr('action'),
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            // Show success message using toast
                            const toast = new bootstrap.Toast(document.getElementById(
                                'successToast'));
                            toast.show();

                            // Set the hash and reload the page
                            // window.location.hash = activeTabId;
                            window.location.reload();
                        }
                    },
                    error: function(xhr) {
                        alert('Error saving changes. Please try again.');
                    }
                });
            });

            // Handle media type change
            $('#mediaType1').change(function() {
                const selectedType = $(this).val();
                if (selectedType === 'image') {
                    $('#imageSection1').show();
                    $('#videoSection1').hide();
                } else {
                    $('#imageSection1').hide();
                    $('#videoSection1').show();
                }
            });
        });

        // Function to add new feature
        function addFeature() {
            const featureCount = document.querySelectorAll('.feature').length;
            const featureHtml = `
                <div class="feature mb-3">
                    <div class="d-flex align-items-center gap-2">
                        <div class="flex-grow-1">
                            <input type="text" class="form-control mb-2" placeholder="Feature Title" name="features[${featureCount}][title]" style="padding: 8px; border-radius: 4px;">
                            <input type="file" class="form-control" placeholder="Feature Icon" name="features[${featureCount}][icon]" accept="image/*,.svg" style="padding: 8px; border-radius: 4px;">
                        </div>
                        <button type="button" class="btn btn-danger" onclick="removeFeature(this)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            `;
            document.getElementById('features').insertAdjacentHTML('beforeend', featureHtml);
        }

        // Function to add new person review
        function addPersonReview() {
            const reviewCount = document.querySelectorAll('.person_review').length;
            const reviewHtml = `
                <div class="person_review mb-3">
                    <div class="d-flex align-items-center gap-2">
                        <div class="flex-grow-1">
                            <input type="file" class="form-control mb-2" placeholder="Person Image" name="reviews[${reviewCount}][person_image]" accept="image/*,.svg">
                            <input type="text" class="form-control mb-2" placeholder="Person Name" name="reviews[${reviewCount}][person_name]">
                            <input type="text" class="form-control mb-2" placeholder="Person Role" name="reviews[${reviewCount}][person_role]">
                            <input type="text" class="form-control" placeholder="Star Rating" name="reviews[${reviewCount}][star]">
                        </div>
                        <button type="button" class="btn btn-danger" onclick="removeReview(this)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            `;
            document.getElementById('person_reviews').insertAdjacentHTML('beforeend', reviewHtml);
        }

        // Function to remove feature
        function removeFeature(button) {
            button.closest('.feature').remove();
        }

        // Function to remove review
        function removeReview(button) {
            button.closest('.person_review').remove();
        }

        // Review management
        let currentReviewIndex = 0;
        let reviews = @json($reviews);

        function showReview(index) {
            const review = reviews[index];
            const total = reviews.length;

            // Update counter
            $('.review-counter').text(`Review ${index + 1} of ${total}`);

            // Update navigation buttons
            $('.prev-review').prop('disabled', index === 0);
            $('.next-review').prop('disabled', index === total - 1);

            // Generate review HTML
            const reviewHtml = `
                <div class="review border rounded mb-3">
                    <div class="d-flex align-items-start p-3">
                        <div class="flex-grow-1 me-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label class="form-label small">Name</label>
                                        <input type="text" class="form-control form-control-sm"
                                            name="reviews[${index}][person_name]"
                                            value="${review.person_name}" readonly>
                                        <input type="hidden" name="reviews[${index}][id]"
                                            value="${review.id}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label class="form-label small">Role</label>
                                        <input type="text" class="form-control form-control-sm"
                                            name="reviews[${index}][person_role]"
                                            value="${review.person_role}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label class="form-label small">Rating (1-5 stars)</label>
                                <input type="number" class="form-control form-control-sm"
                                    name="reviews[${index}][star]"
                                    value="${review.star}" min="1" max="5" readonly>
                            </div>
                        </div>
                        <div class="image-section" style="width: 150px;">
                            <label class="form-label small">Photo</label>
                            ${review.person_image ? `
                                                                                                                                                                                                                                                                            <div class="mb-2">
                                                                                                                                                                                                                                                                                <img src="${review.person_image.startsWith('http') ? review.person_image : '/storage/' + review.person_image}"
                                                                                                                                                                                                                                                                                    alt="Person Image" style="max-width: 100px;">
                                                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                        ` : ''}
                            <input type="file" class="form-control form-control-sm"
                                name="reviews[${index}][person_image]" disabled>
                        </div>
                    </div>
                </div>
            `;

            $('.review-container').html(reviewHtml);
        }

        // Initialize first review
        $(document).ready(function() {
            showReview(currentReviewIndex);

            // Preview image in modal
            $('#newReviewImage').change(function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#newReviewImagePreview').html(`
                            <img src="${e.target.result}" alt="Preview" style="max-width: 100px;">
                        `);
                    }
                    reader.readAsDataURL(file);
                }
            });
        });

        // Navigation handlers
        $('.prev-review').click(function() {
            if (currentReviewIndex > 0) {
                currentReviewIndex--;
                showReview(currentReviewIndex);
            }
        });

        $('.next-review').click(function() {
            if (currentReviewIndex < reviews.length - 1) {
                currentReviewIndex++;
                showReview(currentReviewIndex);
            }
        });

        // Add new review
        function saveNewReview() {
            const name = $('#newReviewName').val();
            const role = $('#newReviewRole').val();
            const star = $('#newReviewStar').val();

            if (!name || !role || !star) {
                toastr.error('Please fill in all required fields');
                return;
            }

            // Create FormData object
            const formData = new FormData();
            formData.append('person_name', name);
            formData.append('person_role', role);
            formData.append('star', star);

            // Add image if selected
            const imageFile = $('#newReviewImage')[0].files[0];
            if (imageFile) {
                formData.append('person_image', imageFile);
            }

            // Add CSRF token
            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

            // Submit the review
            $.ajax({
                url: '{{ route('admin.home-page.add-review') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        // Add the new review to the reviews array
                        const newReview = response.review;
                        reviews.push(newReview);

                        // Close modal and show success message
                        $('#reviewModal').modal('hide');
                        toastr.success('Review added successfully');

                        // Show the new review
                        currentReviewIndex = reviews.length - 1;
                        showReview(currentReviewIndex);

                        // Clear modal inputs
                        $('#newReviewName').val('');
                        $('#newReviewRole').val('');
                        $('#newReviewStar').val('');
                        $('#newReviewImage').val('');
                        $('#newReviewImagePreview').html('');
                    } else {
                        toastr.error('Failed to add review');
                    }
                },
                error: function(xhr) {
                    const errorMessage = xhr.responseJSON?.message || 'Failed to add review';
                    toastr.error(errorMessage);
                }
            });
        }

        // Make reviews editable when Edit button is clicked
        $('.edit-btn').click(function() {
            const form = $(this).closest('form');
            form.find('.review-container input, .review-container input[type="file"]').removeAttr(
                'readonly disabled');
        });
    </script>
@endpush

@push('styles')
    <style>
        /* Form controls */
        .form-control {
            border: 1px solid #dee2e6;
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            height: calc(1.5em + 0.5rem + 2px);
        }

        .form-control[readonly] {
            background-color: #f8f9fa;
            cursor: not-allowed;
        }

        textarea.form-control {
            height: auto;
        }

        /* Feature cards */
        .feature {
            background-color: #fff;
            transition: all 0.2s ease;
            padding: 0.75rem;
            margin-bottom: 0.5rem;
        }

        .feature:hover {
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .feature .icon-section {
            width: 200px;
            margin-left: 10px;
        }

        /* Tabs */
        .nav-tabs {
            border-bottom: 1px solid #dee2e6;
            background-color: #f8f9fa;
            padding: 0.5rem 1rem 0;
            margin-bottom: 0;
        }

        .nav-tabs .nav-link {
            color: #495057;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 4px 4px 0 0;
            padding: 0.5rem 1rem;
            font-weight: 500;
            margin-right: 0.25rem;
        }

        .nav-tabs .nav-link:hover {
            color: #0d6efd;
            background-color: #fff;
            border-color: #dee2e6 #dee2e6 #fff;
        }

        .nav-tabs .nav-link.active {
            color: #0d6efd;
            background-color: #fff;
            border-color: #dee2e6 #dee2e6 #fff;
        }

        /* Alert */
        .alert-info {
            background-color: #f8f9fa;
            border-left: 4px solid #0d6efd;
            border-top: 0;
            border-right: 0;
            border-bottom: 0;
            padding: 0.5rem 0.75rem;
            margin-bottom: 0.75rem;
        }

        /* Buttons */
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }

        /* Labels */
        .form-label {
            color: #495057;
            font-weight: 500;
            font-size: 0.875rem;
            margin-bottom: 0.25rem;
        }

        /* Card */
        .card {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 0;
        }

        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #dee2e6;
            padding: 0.75rem 1rem;
        }

        .card-body {
            padding: 0;
        }

        /* Layout */
        .container-fluid {
            padding: 0.75rem;
        }

        .tab-pane {
            padding: 0.75rem;
        }

        .row {
            margin: -0.25rem;
        }

        .col,
        [class*="col-"] {
            padding: 0.25rem;
        }

        .mb-3 {
            margin-bottom: 0.75rem !important;
        }

        /* File inputs */
        input[type="file"].form-control {
            padding: 0.2rem;
            font-size: 0.8rem;
            width: 150px;
        }

        /* Images */
        .feature img {
            max-height: 25px;
            width: auto;
        }

        .review-counter {
            font-size: 0.9rem;
            color: #6c757d;
        }

        .review-container {
            min-height: 200px;
        }

        #reviewModal .modal-dialog {
            max-width: 500px;
        }

        #newReviewImagePreview img {
            border-radius: 4px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
    </style>
@endpush
