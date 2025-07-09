@extends('admin.layouts.app')
<script>
    // window.location.href = "/admin/partners";
</script>
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Create Partner</h4>
                    <a href="{{ route('admin.partners.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.partners.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        id="title" name="title" value="{{ old('title') }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6" style="display: none">
                                <div class="mb-3">
                                    <label for="slug" class="form-label">Slug <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                        id="slug" name="slug" value="{{ old('slug') }}" required>
                                    @error('slug')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select @error('status') is-invalid @enderror" id="status"
                                        name="status" required>
                                        <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="0" {{ old('status', '1') == '0' ? 'selected' : '' }}>Inactive
                                        </option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6" style="display:none">
                                <div class="mb-3">
                                    <label for="partner_type" class="form-label">Partner Type <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('partner_type') is-invalid @enderror"
                                        id="partner_type" name="partner_type" value="{{ old('partner_type') }}" required>
                                    @error('partner_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="page_image" class="form-label">Image</label>
                                    <input type="file" class="form-control @error('page_image') is-invalid @enderror"
                                        id="page_image" name="page_image">
                                    @error('page_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="short_description" class="form-label">Short Description</label>
                                    <textarea class="form-control @error('short_description') is-invalid @enderror" id="short_description"
                                        name="short_description" rows="3">{{ old('short_description') }}</textarea>
                                    @error('short_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="long_description" class="form-label">Long Description</label>
                                    <textarea class="form-control @error('long_description') is-invalid @enderror" id="long_description"
                                        name="long_description" rows="5">{{ old('long_description') }}</textarea>
                                    @error('long_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="meta_title" class="form-label">Meta Title</label>
                                    <input type="text" class="form-control @error('meta_title') is-invalid @enderror"
                                        id="meta_title" name="meta_title" value="{{ old('meta_title') }}">
                                    @error('meta_title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="meta_description" class="form-label">Meta Description</label>
                                    <textarea class="form-control @error('meta_description') is-invalid @enderror" id="meta_description"
                                        name="meta_description" rows="2">{{ old('meta_description') }}</textarea>
                                    @error('meta_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="meta_keywords" class="form-label">Meta Keywords</label>
                                    <input type="text"
                                        class="form-control @error('meta_keywords') is-invalid @enderror"
                                        id="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords') }}">
                                    @error('meta_keywords')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Create Partner</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
