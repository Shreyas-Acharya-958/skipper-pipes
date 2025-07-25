@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Media</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <form id="searchForm" method="GET" action="{{ url()->current() }}" class="d-flex"
                            style="max-width: 400px;">
                            <input type="text" name="search" class="form-control me-2" placeholder="Search..."
                                value="{{ request('search') }}">
                        </form>
                        <div class="d-flex gap-2 ms-auto">
                            <a href="{{ route('admin.media.create') }}" class="btn btn-warning">
                                <i class="fas fa-plus"></i> Add New Media
                            </a>
                            <a href="{{ url('admin/media/sections') }}" class="btn btn-info">
                                <i class="fas fa-plus"></i> Add Section
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Media Type</th>
                                    <th>File Type</th>
                                    <th>File</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($media as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ ucfirst($item->media_type) }}</td>
                                        <td>{{ ucfirst($item->file_type) }}</td>
                                        <td>
                                            @if ($item->file_type === 'image')
                                                @if ($item->file)
                                                    <img src="{{ asset('storage/' . $item->file) }}"
                                                        alt="{{ $item->title }}" style="max-width: 100px; height: auto;">
                                                @else
                                                    No File
                                                @endif
                                            @elseif ($item->file_type === 'video')
                                                @if ($item->file)
                                                    <video src="{{ asset('storage/' . $item->file) }}"
                                                        style="max-width: 120px; height: auto;" controls></video>
                                                @else
                                                    No File
                                                @endif
                                            @elseif ($item->file_type === 'pdf')
                                                @if ($item->file)
                                                    @if ($item->thumbnail)
                                                        <img src="{{ asset('storage/' . $item->thumbnail) }}"
                                                            alt="{{ $item->title }}"
                                                            style="max-width: 100px; height: auto;">
                                                        <br>
                                                    @endif
                                                    <a href="{{ asset('storage/' . $item->file) }}" target="_blank">View
                                                        PDF</a>
                                                @else
                                                    No File
                                                @endif
                                            @elseif ($item->file_type === 'youtube_link')
                                                @if ($item->file)
                                                    <a href="{{ $item->file }}" target="_blank">YouTube Link</a>
                                                @else
                                                    No Link
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.media.show', $item) }}" class="me-2"
                                                    title="View">
                                                    <i class="fas fa-eye text-info" style="font-size: 1.2rem;"></i>
                                                </a>
                                                <a href="{{ route('admin.media.edit', $item) }}" class="me-2"
                                                    title="Edit">
                                                    <i class="fas fa-edit text-warning" style="font-size: 1.2rem;"></i>
                                                </a>
                                                <form action="{{ route('admin.media.destroy', $item) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn p-0"
                                                        style="background: none; border: none;" title="Delete"
                                                        onclick="return confirm('Are you sure you want to delete this media?')">
                                                        <i class="fas fa-trash text-danger" style="font-size: 1.2rem;"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $media->withQueryString()->links('vendor.pagination.bootstrap-5-always') }}
                </div>
            </div>
        </div>
    </div>
@endsection
