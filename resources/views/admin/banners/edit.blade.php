@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Banner</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.banners.update', $banner) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="remove_image" value="0" id="remove_image_input">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        id="title" name="title" value="{{ old('title', $banner->title) }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="sequence" class="form-label">Sequence</label>
                                    <input type="number" class="form-control @error('sequence') is-invalid @enderror"
                                        id="sequence" name="sequence" value="{{ old('sequence', $banner->sequence) }}"
                                        required min="0">
                                    @error('sequence')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="link" class="form-label">Link (Optional)</label>
                                    <input type="text" class="form-control @error('link') is-invalid @enderror"
                                        id="link" name="link" value="{{ old('link', $banner->link) }}">
                                    @error('link')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select @error('status') is-invalid @enderror" id="status"
                                        name="status" required>
                                        <option value="1"
                                            {{ old('status', $banner->status) == '1' ? 'selected' : '' }}>Active</option>
                                        <option value="0"
                                            {{ old('status', $banner->status) == '0' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="image" class="form-label">Banner Image</label>
                                    @if ($banner->image)
                                        <div class="mb-2 position-relative d-inline-block">
                                            <img src="{{ asset('storage/' . $banner->image) }}" alt="{{ $banner->title }}"
                                                style="max-width: 200px; height: auto;">
                                            <button type="button"
                                                class="btn btn-sm btn-danger position-absolute top-0 end-0 remove-image-btn"
                                                data-field="image">&times;</button>
                                        </div>
                                    @endif
                                    <input type="file" class="form-control" id="image" name="image"
                                        accept="image/*,.svg">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Update Banner</button>
                                <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.querySelectorAll('.remove-image-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const field = this.getAttribute('data-field');
                // Clear file input
                const input = document.getElementById(field);
                if (input) input.value = '';
                // Hide the preview
                this.parentElement.remove();
                // Set hidden input to 1 (mark for removal)
                document.getElementById('remove_' + field + '_input').value = '1';
            });
        });
    </script>
@endpush
