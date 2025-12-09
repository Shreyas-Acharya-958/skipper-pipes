@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Image Alt Text Management</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                        <form method="GET" action="{{ route('admin.image-alt-texts.index') }}" class="d-flex gap-2 flex-wrap"
                            style="max-width: 100%;">
                            <input type="text" name="search" class="form-control" placeholder="Search images..."
                                value="{{ request('search') }}" style="max-width: 250px;">

                            <select name="directory" class="form-select" style="max-width: 200px;">
                                <option value="">All Directories</option>
                                @foreach ($directories as $dir)
                                    <option value="{{ $dir }}"
                                        {{ request('directory') == $dir ? 'selected' : '' }}>
                                        {{ $dir }}
                                    </option>
                                @endforeach
                            </select>

                            <select name="has_alt_text" class="form-select" style="max-width: 180px;">
                                <option value="">All Images</option>
                                <option value="yes" {{ request('has_alt_text') == 'yes' ? 'selected' : '' }}>With Alt
                                    Text</option>
                                <option value="no" {{ request('has_alt_text') == 'no' ? 'selected' : '' }}>Without Alt
                                    Text</option>
                            </select>

                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i> Filter
                            </button>

                            @if (request()->anyFilled(['search', 'directory', 'has_alt_text']))
                                <a href="{{ route('admin.image-alt-texts.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Clear
                                </a>
                            @endif
                        </form>

                        <div class="d-flex gap-2">
                            <form action="{{ route('admin.image-alt-texts.scan') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-info"
                                    onclick="return confirm('This will scan all images from public directories. Continue?')">
                                    <i class="fas fa-sync"></i> Scan Images
                                </button>
                            </form>
                            <button type="button" class="btn btn-success" id="saveAllBtn" style="display: none;">
                                <i class="fas fa-save"></i> Save All Changes
                            </button>
                        </div>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form id="bulkUpdateForm" method="POST" action="{{ route('admin.image-alt-texts.update-batch') }}">
                        @csrf
                        @method('PUT')

                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th width="80">Preview</th>
                                        <th>File Name</th>
                                        <th>Directory</th>
                                        <th>Path</th>
                                        <th width="40%">Alt Text</th>
                                        <th width="100">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($images as $image)
                                        <tr>
                                            <td>
                                                <img src="{{ asset($image->image_path) }}"
                                                    alt="{{ $image->alt_text ?? 'Image' }}"
                                                    style="max-width: 60px; height: 60px; object-fit: cover; border-radius: 4px;"
                                                    onerror="this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'60\' height=\'60\'%3E%3Crect fill=\'%23ddd\' width=\'60\' height=\'60\'/%3E%3Ctext x=\'50%25\' y=\'50%25\' text-anchor=\'middle\' dy=\'.3em\' fill=\'%23999\' font-size=\'10\'%3ENo Image%3C/text%3E%3C/svg%3E';">
                                            </td>
                                            <td>
                                                <strong>{{ $image->file_name }}</strong>
                                                @if ($image->file_size)
                                                    <br><small
                                                        class="text-muted">{{ number_format($image->file_size / 1024, 2) }}
                                                        KB</small>
                                                @endif
                                            </td>
                                            <td>
                                                <small class="text-muted">{{ $image->directory ?? 'Root' }}</small>
                                            </td>
                                            <td>
                                                <code class="small">{{ $image->image_path }}</code>
                                            </td>
                                            <td>
                                                <input type="hidden" name="images[{{ $loop->index }}][id]"
                                                    value="{{ $image->id }}">
                                                <input type="text" name="images[{{ $loop->index }}][alt_text]"
                                                    class="form-control form-control-sm alt-text-input"
                                                    value="{{ $image->alt_text }}" placeholder="Enter alternative text..."
                                                    data-image-id="{{ $image->id }}">
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-primary save-single-btn"
                                                    data-image-id="{{ $image->id }}" title="Save this image">
                                                    <i class="fas fa-save"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-4">
                                                <p class="text-muted mb-2">No images found.</p>
                                                <form action="{{ route('admin.image-alt-texts.scan') }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="fas fa-sync"></i> Scan Images Now
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </form>

                    {{ $images->withQueryString()->links('vendor.pagination.bootstrap-5-always') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const altTextInputs = document.querySelectorAll('.alt-text-input');
            const saveAllBtn = document.getElementById('saveAllBtn');
            const bulkUpdateForm = document.getElementById('bulkUpdateForm');

            // Show save all button when any input changes
            altTextInputs.forEach(input => {
                input.addEventListener('input', function() {
                    saveAllBtn.style.display = 'block';
                });
            });

            // Save single image alt text
            document.querySelectorAll('.save-single-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const imageId = this.getAttribute('data-image-id');
                    const input = document.querySelector(`input[data-image-id="${imageId}"]`);
                    const altText = input.value;

                    // Disable button
                    this.disabled = true;
                    this.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';

                    // Send AJAX request
                    fetch(`{{ url('admin/image-alt-texts') }}/${imageId}`, {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            body: JSON.stringify({
                                alt_text: altText
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Show success feedback
                                this.innerHTML = '<i class="fas fa-check text-success"></i>';
                                setTimeout(() => {
                                    this.innerHTML = '<i class="fas fa-save"></i>';
                                    this.disabled = false;
                                }, 2000);
                            } else {
                                throw new Error('Failed to save');
                            }
                        })
                        .catch(error => {
                            this.innerHTML = '<i class="fas fa-times text-danger"></i>';
                            setTimeout(() => {
                                this.innerHTML = '<i class="fas fa-save"></i>';
                                this.disabled = false;
                            }, 2000);
                            alert('Failed to save alt text. Please try again.');
                        });
                });
            });

            // Save all changes
            saveAllBtn.addEventListener('click', function() {
                if (confirm('Save all alt text changes?')) {
                    bulkUpdateForm.submit();
                }
            });
        });
    </script>
@endpush
