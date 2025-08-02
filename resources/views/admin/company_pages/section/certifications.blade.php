@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Certifications</h4>
                    <a href="{{ url('/admin/company') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Pages
                    </a>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <button type="button" class="btn btn-outline-info me-2" id="toggleHeadPart">
                            + Head Part
                        </button>
                        <div class="d-flex" style="max-width: 400px;">
                            <!-- Add search functionality if needed -->
                        </div>
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                            data-bs-target="#certificationModal">
                            <i class="fas fa-plus"></i> Add New Certification
                        </button>
                    </div>

                    <!-- Head Part Toggle Section -->
                    <div id="headPartSection" class="card mb-3" style="display: none; border: 2px solid #17a2b8;">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="modal-title mb-0">
                                {{ isset($certificationHead) ? 'Edit' : 'Add' }} Head Part
                            </h5>
                            <button type="button" class="btn-close" id="closeHeadPart" aria-label="Close"></button>
                        </div>
                        <div class="card-body">
                            <form id="headPartForm" action="{{ route('admin.certifications.head.save') }}" method="POST">
                                @csrf
                                <div class="form-group mb-3">
                                    <label class="form-label">Title</label>
                                    <input type="text" class="form-control" name="title"
                                        value="{{ $certificationHead->title ?? '' }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control tinymce" id="head_description" name="description" rows="4">{{ $certificationHead->description ?? '' }}</textarea>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-secondary me-2"
                                        id="closeHeadPartBtn">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Short Description</th>
                                    <th>PDF Document</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($certifications) && $certifications->count() > 0)
                                    @foreach ($certifications as $certification)
                                        <tr>
                                            <td>
                                                @if ($certification->image)
                                                    <img src="{{ asset('storage/' . $certification->image) }}"
                                                        alt="Certification Image" style="max-width: 100px; height: auto;">
                                                @else
                                                    <span class="text-muted">No image</span>
                                                @endif
                                            </td>
                                            <td>{{ $certification->title }}</td>
                                            <td>{{ $certification->short_description }}</td>
                                            <td>
                                                @if ($certification->link)
                                                    <a href="{{ asset('storage/' . $certification->link) }}" target="_blank"
                                                        class="btn btn-sm btn-primary">
                                                        <i class="fas fa-file-pdf"></i> Download PDF
                                                    </a>
                                                @else
                                                    <span class="text-muted">No PDF</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <button type="button" class="btn p-0 me-2 edit-certification"
                                                        style="background: none; border: none;"
                                                        data-id="{{ $certification->id }}"
                                                        data-title="{{ $certification->title }}"
                                                        data-short-description="{{ $certification->short_description }}"
                                                        data-long-description="{{ $certification->long_description }}"
                                                        data-link="{{ $certification->link }}"
                                                        data-image="{{ $certification->image }}" title="Edit">
                                                        <i class="fas fa-edit text-warning" style="font-size: 1.2rem;"></i>
                                                    </button>
                                                    <button type="button" class="btn p-0 delete-certification"
                                                        style="background: none; border: none;"
                                                        data-id="{{ $certification->id }}" title="Delete">
                                                        <i class="fas fa-trash text-danger" style="font-size: 1.2rem;"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center">No certifications found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Certification Modal -->
    <div class="modal fade" id="certificationModal" tabindex="-1" aria-labelledby="certificationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="certificationForm" action="{{ route('admin.certifications.section1.save') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="certification_id" id="certification_id">

                    <div class="modal-header">
                        <h5 class="modal-title" id="certificationModalLabel">Add Certification</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label class="form-label">Image</label>
                            <div class="mb-2" id="currentImage"></div>
                            <input type="file" class="form-control" name="image" accept="image/*,.svg">
                            <input type="hidden" name="remove_image" value="0">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Short Description</label>
                            <textarea class="form-control" name="short_description" rows="2" required></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Long Description</label>
                            <textarea class="form-control" name="long_description" rows="4"></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">PDF Document</label>
                            <div class="mb-2" id="currentPdf"></div>
                            <input type="file" class="form-control" name="pdf_file" accept=".pdf">
                            <input type="hidden" name="remove_pdf" value="0">
                            <small class="form-text text-muted">Upload a PDF file for this certification</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Certification</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this certification?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteForm" action="{{ route('admin.certifications.section1.delete') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="certification_id" id="delete_certification_id">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.1.1/tinymce.min.js"></script>
    <script>
        function initHeadTinyMCE() {
            if (tinymce.get('head_description')) {
                tinymce.get('head_description').remove();
            }
            tinymce.init({
                selector: '#head_description',
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
        }

        function toggleHeadPart() {
            const $section = $('#headPartSection');
            const $button = $('#toggleHeadPart');

            if ($section.is(':visible')) {
                // Hide with fade out effect
                $section.fadeOut(300, function() {
                    // Remove TinyMCE instance when hidden
                    if (tinymce.get('head_description')) {
                        tinymce.get('head_description').remove();
                    }
                });
                $button.text('+ Head Part');
            } else {
                // Show with fade in effect
                $section.fadeIn(300, function() {
                    // Initialize TinyMCE after fade in
                    initHeadTinyMCE();
                });
                $button.text('− Head Part');
            }
        }

        $(document).ready(function() {
            // Handle toggle button click
            $('#toggleHeadPart').click(function() {
                toggleHeadPart();
            });

            // Handle close button clicks
            $('#closeHeadPart, #closeHeadPartBtn').click(function() {
                toggleHeadPart();
            });

            // Initialize TinyMCE if section is visible on page load
            if ($('#headPartSection').is(':visible')) {
                initHeadTinyMCE();
            }

            // Reset form when modal is closed
            $('#certificationModal').on('hidden.bs.modal', function() {
                $('#certificationForm')[0].reset();
                $('#certification_id').val('');
                $('#currentImage').empty();
                $('#currentPdf').empty();
                $('#certificationModalLabel').text('Add Certification');
            });

            // Handle edit button click
            $('.edit-certification').click(function() {
                const data = $(this).data();
                $('#certification_id').val(data.id);
                $('input[name="title"]').val(data.title);
                $('textarea[name="short_description"]').val(data.shortDescription);
                $('textarea[name="long_description"]').val(data.longDescription);

                if (data.image) {
                    const imageUrl = "{{ asset('storage') }}/" + data.image;
                    $('#currentImage').html(`
                        <div class="position-relative d-inline-block">
                            <img src="${imageUrl}" alt="Current Image" style="max-width: 200px; height: auto;">
                            <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 remove-image-btn">&times;</button>
                        </div>
                    `);
                }

                if (data.link) {
                    const pdfUrl = "{{ asset('storage') }}/" + data.link;
                    $('#currentPdf').html(`
                        <div class="position-relative d-inline-block">
                            <a href="${pdfUrl}" target="_blank" class="btn btn-sm btn-primary">
                                <i class="fas fa-file-pdf"></i> Current PDF
                            </a>
                            <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 remove-pdf-btn">&times;</button>
                        </div>
                    `);
                }

                $('#certificationModalLabel').text('Edit Certification');
                $('#certificationModal').modal('show');
            });

            // Handle delete button click
            $('.delete-certification').click(function() {
                const id = $(this).data('id');
                $('#delete_certification_id').val(id);
                $('#deleteModal').modal('show');
            });

            // Handle remove image button click
            $(document).on('click', '.remove-image-btn', function() {
                $(this).closest('.position-relative').remove();
                $('input[name="remove_image"]').val('1');
            });

            // Handle remove PDF button click
            $(document).on('click', '.remove-pdf-btn', function() {
                $(this).closest('.position-relative').remove();
                $('input[name="remove_pdf"]').val('1');
            });
        });
    </script>
@endpush
