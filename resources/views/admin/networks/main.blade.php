@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid" style="padding: 20px;">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Main Network Section</h4>
                <a href="{{ url('/admin/networks') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Networks
                </a>
            </div>
            <div class="card-body">
                <form id="mainNetworkForm" class="section-form" action="{{ route('admin.networks.main.save') }}"
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
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" value="{{ $mainNetwork->title ?? '' }}"
                            readonly required>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Image</label>
                        @if (isset($mainNetwork) && $mainNetwork->image)
                            <div class="position-relative d-inline-block mb-2">
                                <img src="{{ asset('storage/' . $mainNetwork->image) }}" alt="Main Network Image"
                                    style="max-width: 200px; height: auto;">
                                <button type="button"
                                    class="btn btn-sm btn-danger position-absolute top-0 end-0 remove-image-btn"
                                    style="display: none;" data-image="main_network_image">&times;</button>
                            </div>
                        @endif
                        <input type="file" class="form-control" name="image" accept="image/*,.svg" disabled>
                        <input type="hidden" name="remove_image" value="0">
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="4" readonly required>{{ $mainNetwork->description ?? '' }}</textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Overview</label>
                        <textarea class="form-control" name="overview" rows="4" readonly required>{{ $mainNetwork->overview ?? '' }}</textarea>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
