@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ isset($news) ? 'Edit News' : 'Create News' }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ isset($news) ? route('admin.news.update', $news) : route('admin.news.store') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @if (isset($news))
                            @method('PUT')
                            <input type="hidden" name="remove_file" value="0" id="remove_file_input">
                        @endif

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        id="title" name="title" value="{{ old('title', $news->title ?? '') }}"
                                        required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="press_release" class="form-label">Press Release Date</label>
                                    <input type="date" class="form-control @error('press_release') is-invalid @enderror"
                                        id="press_release" name="press_release"
                                        value="{{ old('press_release', isset($news) ? $news->press_release->format('Y-m-d') : '') }}"
                                        required>
                                    @error('press_release')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="sequence" class="form-label">Sequence</label>
                                    <input type="number" class="form-control @error('sequence') is-invalid @enderror"
                                        id="sequence" name="sequence" value="{{ old('sequence', $news->sequence ?? 0) }}"
                                        required min="0">
                                    @error('sequence')
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
                                            {{ old('status', $news->status ?? '') == '1' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="0"
                                            {{ old('status', $news->status ?? '') == '0' ? 'selected' : '' }}>Inactive
                                        </option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        @php
                            $existingType = 'pdf';
                            if (isset($news) && $news->file) {
                                if (preg_match('/^https?:\/\//i', $news->file)) {
                                    $existingType = 'link';
                                } else {
                                    $ext = strtolower(pathinfo($news->file, PATHINFO_EXTENSION));
                                    $existingType = in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'svg', 'webp'])
                                        ? 'image'
                                        : 'pdf';
                                }
                            }
                        @endphp

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="content_type" class="form-label">Content Type</label>
                                    <select class="form-select @error('content_type') is-invalid @enderror"
                                        id="content_type" name="content_type" required>
                                        <option value="pdf"
                                            {{ old('content_type', $existingType) == 'pdf' ? 'selected' : '' }}>Pdf
                                        </option>
                                        <option value="image"
                                            {{ old('content_type', $existingType) == 'image' ? 'selected' : '' }}>Image
                                        </option>
                                        <option value="link"
                                            {{ old('content_type', $existingType) == 'link' ? 'selected' : '' }}>Link
                                        </option>
                                    </select>
                                    @error('content_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3" id="file-input-wrapper">
                                    <label for="file" class="form-label">Upload File</label>
                                    @if (isset($news) && $news->file)
                                        <div class="mb-2" id="current-file-wrapper">
                                            @if (preg_match('/^https?:\/\//i', $news->file))
                                                <a href="{{ $news->file }}" target="_blank"
                                                    class="btn btn-sm btn-info me-2">
                                                    <i class="fas fa-link"></i> View Current Link
                                                </a>
                                            @else
                                                <a href="{{ asset('storage/' . $news->file) }}" target="_blank"
                                                    class="btn btn-sm btn-info me-2">
                                                    <i class="fas fa-file"></i> View Current File
                                                </a>
                                            @endif
                                            <button type="button" class="btn btn-sm btn-danger remove-file-btn"
                                                data-field="file">&times; Remove</button>
                                        </div>
                                    @endif
                                    <input type="file" class="form-control @error('file') is-invalid @enderror"
                                        id="file" name="file" accept=".pdf,.jpg,.jpeg,.png,.gif,.svg,.webp"
                                        {{ !isset($news) ? 'required' : '' }}>
                                    @error('file')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 d-none" id="link-input-wrapper">
                                    <label for="file_link" class="form-label">External Link</label>
                                    <input type="url" class="form-control @error('file_link') is-invalid @enderror"
                                        id="file_link" name="file_link"
                                        value="{{ old('file_link', isset($news) && preg_match('/^https?:\/\//i', $news->file ?? '') ? $news->file : '') }}">
                                    @error('file_link')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">
                                    {{ isset($news) ? 'Update News' : 'Create News' }}
                                </button>
                                <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">Cancel</a>
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
        (function() {
            const typeSelect = document.getElementById('content_type');
            const fileWrapper = document.getElementById('file-input-wrapper');
            const linkWrapper = document.getElementById('link-input-wrapper');
            const fileInput = document.getElementById('file');
            const linkInput = document.getElementById('file_link');

            function syncInputs() {
                const type = typeSelect ? typeSelect.value : 'pdf';
                if (!fileWrapper || !linkWrapper || !fileInput) return;

                if (type === 'link') {
                    fileWrapper.classList.add('d-none');
                    linkWrapper.classList.remove('d-none');
                    if (fileInput) fileInput.required = false;
                    if (linkInput) linkInput.required = true;
                } else {
                    fileWrapper.classList.remove('d-none');
                    linkWrapper.classList.add('d-none');
                    if (linkInput) linkInput.required = false;
                    if (fileInput && !fileInput.getAttribute('data-not-required')) {
                        // Keep required for create; update may not require
                        // We won't force required here for edit context
                    }
                    if (type === 'pdf') {
                        fileInput.setAttribute('accept', '.pdf');
                    } else {
                        fileInput.setAttribute('accept', '.jpg,.jpeg,.png,.gif,.svg,.webp');
                    }
                }
            }

            if (typeSelect) {
                typeSelect.addEventListener('change', syncInputs);
                syncInputs();
            }

            document.querySelectorAll('.remove-file-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const field = this.getAttribute('data-field');
                    const input = document.getElementById(field);
                    if (input) input.value = '';
                    if (this.parentElement) this.parentElement.remove();
                    const hidden = document.getElementById('remove_' + field + '_input');
                    if (hidden) hidden.value = '1';
                });
            });
        })();
    </script>
@endpush
