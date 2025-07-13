@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Media</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.media.update', $media) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="remove_file" value="0" id="remove_file_input">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        id="title" name="title" value="{{ old('title', $media->title) }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="media_type" class="form-label">Media Type</label>
                                    <select class="form-select @error('media_type') is-invalid @enderror" id="media_type"
                                        name="media_type" required>
                                        <option value="Company"
                                            {{ old('media_type', $media->media_type) == 'Company' ? 'selected' : '' }}>
                                            Company</option>
                                        <option value="Events"
                                            {{ old('media_type', $media->media_type) == 'Events' ? 'selected' : '' }}>Events
                                        </option>
                                        <option value="Awards"
                                            {{ old('media_type', $media->media_type) == 'Awards' ? 'selected' : '' }}>Awards
                                        </option>
                                    </select>
                                    @error('media_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="file_type" class="form-label">File Type</label>
                                    <select class="form-select @error('file_type') is-invalid @enderror" id="file_type"
                                        name="file_type" required>
                                        <option value="">Select Type</option>
                                        <option value="image"
                                            {{ old('file_type', $media->file_type) == 'image' ? 'selected' : '' }}>Image
                                        </option>
                                        <option value="video"
                                            {{ old('file_type', $media->file_type) == 'video' ? 'selected' : '' }}>Video
                                        </option>
                                        <option value="pdf"
                                            {{ old('file_type', $media->file_type) == 'pdf' ? 'selected' : '' }}>PDF
                                        </option>
                                        <option value="youtube_link"
                                            {{ old('file_type', $media->file_type) == 'youtube_link' ? 'selected' : '' }}>
                                            YouTube Link</option>
                                    </select>
                                    @error('file_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3" id="file_input_group">
                                    <label for="file" class="form-label">File</label>
                                    @if ($media->file)
                                        <div class="mb-2 position-relative d-inline-block">
                                            @if ($media->file_type === 'image')
                                                <img src="{{ asset('storage/' . $media->file) }}"
                                                    alt="{{ $media->title }}" style="max-width: 200px; height: auto;">
                                            @elseif ($media->file_type === 'video')
                                                <video src="{{ asset('storage/' . $media->file) }}"
                                                    style="max-width: 200px; height: auto;" controls></video>
                                            @elseif ($media->file_type === 'pdf')
                                                @if ($media->thumbnail)
                                                    <img src="{{ asset('storage/' . $media->thumbnail) }}"
                                                        alt="{{ $media->title }}" style="max-width: 200px; height: auto;">
                                                    <br>
                                                @endif
                                                <a href="{{ asset('storage/' . $media->file) }}" target="_blank">View
                                                    PDF</a>
                                            @elseif ($media->file_type === 'youtube_link')
                                                <a href="{{ $media->file }}" target="_blank">YouTube Link</a>
                                            @endif
                                            <button type="button" style="display: none;"
                                                class="btn btn-sm btn-danger position-absolute top-0 end-0 remove-file-btn"
                                                data-field="file">&times;</button>
                                        </div>
                                    @endif
                                    <input type="file"
                                        class="form-control @error('file') is-invalid @enderror {{ old('file_type', $media->file_type) == 'youtube_link' ? 'd-none' : '' }}"
                                        id="file" name="file">
                                    <input type="text"
                                        class="form-control @error('file') is-invalid @enderror {{ old('file_type', $media->file_type) == 'youtube_link' ? '' : 'd-none' }}"
                                        id="youtube_link" name="file" placeholder="YouTube Link"
                                        value="{{ old('file_type', $media->file_type) == 'youtube_link' ? $media->file : '' }}">
                                    @error('file')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Update Media</button>
                                <a href="{{ route('admin.media.index') }}" class="btn btn-secondary">Cancel</a>
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
        function toggleFileInput() {
            const type = document.getElementById('file_type').value;
            const fileInput = document.getElementById('file');
            const ytInput = document.getElementById('youtube_link');
            if (type === 'youtube_link') {
                fileInput.classList.add('d-none');
                ytInput.classList.remove('d-none');
            } else {
                fileInput.classList.remove('d-none');
                ytInput.classList.add('d-none');
                if (type === 'image') fileInput.accept = 'image/*';
                else if (type === 'video') fileInput.accept = 'video/*';
                else if (type === 'pdf') fileInput.accept = 'application/pdf';
                else fileInput.accept = '';
            }
        }
        document.getElementById('file_type').addEventListener('change', toggleFileInput);
        window.addEventListener('DOMContentLoaded', toggleFileInput);
        document.querySelectorAll('.remove-file-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const field = this.getAttribute('data-field');
                const input = document.getElementById(field);
                if (input) input.value = '';
                this.parentElement.remove();
                document.getElementById('remove_' + field + '_input').value = '1';
            });
        });
    </script>
@endpush
