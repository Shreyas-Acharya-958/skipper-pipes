@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Media Details</h4>
                    <div class="card-header-actions">
                        <a href="{{ route('admin.media.edit', $media) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('admin.media.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to List
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="150">ID:</th>
                                    <td>{{ $media->id }}</td>
                                </tr>
                                <tr>
                                    <th>Title:</th>
                                    <td>{{ $media->title }}</td>
                                </tr>
                                <tr>
                                    <th>Media Type:</th>
                                    <td>{{ $media->media_type }}</td>
                                </tr>
                                <tr>
                                    <th>File Type:</th>
                                    <td>{{ ucfirst($media->file_type) }}</td>
                                </tr>
                                <tr>
                                    <th>File:</th>
                                    <td>
                                        @if ($media->file_type === 'image')
                                            @if ($media->file)
                                                <img src="{{ asset('storage/' . $media->file) }}" class="img-fluid rounded"
                                                    alt="{{ $media->title }}" style="max-width: 200px;">
                                            @else
                                                No File
                                            @endif
                                        @elseif ($media->file_type === 'video')
                                            @if ($media->file)
                                                <video src="{{ asset('storage/' . $media->file) }}"
                                                    style="max-width: 200px; height: auto;" controls></video>
                                            @else
                                                No File
                                            @endif
                                        @elseif ($media->file_type === 'pdf')
                                            @if ($media->file)
                                                <a href="{{ asset('storage/' . $media->file) }}" target="_blank">View
                                                    PDF</a>
                                            @else
                                                No File
                                            @endif
                                        @elseif ($media->file_type === 'youtube_link')
                                            @if ($media->file)
                                                <a href="{{ $media->file }}" target="_blank">YouTube Link</a>
                                            @else
                                                No Link
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Created At:</th>
                                    <td>{{ $media->created_at->format('Y-m-d H:i:s') }}</td>
                                </tr>
                                <tr>
                                    <th>Updated At:</th>
                                    <td>{{ $media->updated_at->format('Y-m-d H:i:s') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
