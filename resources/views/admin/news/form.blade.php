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

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="file" class="form-label">PDF File</label>
                                    @if (isset($news) && $news->file)
                                        <div class="mb-2">
                                            <a href="{{ asset('storage/' . $news->file) }}" target="_blank"
                                                class="btn btn-sm btn-info me-2">
                                                <i class="fas fa-file-pdf"></i> View Current PDF
                                            </a>
                                            <button type="button" class="btn btn-sm btn-danger remove-file-btn"
                                                data-field="file">&times; Remove</button>
                                        </div>
                                    @endif
                                    <input type="file" class="form-control @error('file') is-invalid @enderror"
                                        id="file" name="file" accept=".pdf" {{ !isset($news) ? 'required' : '' }}>
                                    @error('file')
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
        document.querySelectorAll('.remove-file-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const field = this.getAttribute('data-field');
                // Clear file input
                const input = document.getElementById(field);
                if (input) input.value = '';
                // Hide the preview and button
                this.parentElement.remove();
                // Set hidden input to 1 (mark for removal)
                document.getElementById('remove_' + field + '_input').value = '1';
            });
        });
    </script>
@endpush
