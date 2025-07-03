@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid" style="padding: 20px;">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Certifications</h4>
                <div>
                    <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal"
                        data-bs-target="#certificationModal">
                        <i class="fas fa-plus"></i> Add Certification
                    </button>
                    <a href="javascript:history.back()" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Pages
                    </a>
                </div>
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

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Short Description</th>
                                <th>Link</th>
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
                                                <a href="{{ $certification->link }}" target="_blank">View Link</a>
                                            @else
                                                <span class="text-muted">No link</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-primary edit-certification"
                                                data-id="{{ $certification->id }}" data-title="{{ $certification->title }}"
                                                data-short-description="{{ $certification->short_description }}"
                                                data-long-description="{{ $certification->long_description }}"
                                                data-link="{{ $certification->link }}"
                                                data-image="{{ $certification->image }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger delete-certification"
                                                data-id="{{ $certification->id }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
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
                            <input type="file" class="form-control" name="image" accept="image/*">
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
                            <label class="form-label">Link</label>
                            <input type="url" class="form-control" name="link">
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
    <script>
        $(document).ready(function() {
            // Reset form when modal is closed
            $('#certificationModal').on('hidden.bs.modal', function() {
                $('#certificationForm')[0].reset();
                $('#certification_id').val('');
                $('#currentImage').empty();
                $('#certificationModalLabel').text('Add Certification');
            });

            // Handle edit button click
            $('.edit-certification').click(function() {
                const data = $(this).data();
                $('#certification_id').val(data.id);
                $('input[name="title"]').val(data.title);
                $('textarea[name="short_description"]').val(data.shortDescription);
                $('textarea[name="long_description"]').val(data.longDescription);
                $('input[name="link"]').val(data.link);

                if (data.image) {
                    const imageUrl = "{{ asset('storage') }}/" + data.image;
                    $('#currentImage').html(`
                        <div class="position-relative d-inline-block">
                            <img src="${imageUrl}" alt="Current Image" style="max-width: 200px; height: auto;">
                            <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 remove-image-btn">&times;</button>
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
        });
    </script>
@endpush
