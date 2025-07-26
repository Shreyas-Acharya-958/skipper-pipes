@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">News</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <form id="searchForm" method="GET" action="{{ url()->current() }}" class="d-flex"
                            style="max-width: 400px;">
                            <input type="text" name="search" class="form-control me-2" placeholder="Search..."
                                value="{{ request('search') }}">
                        </form>
                        <div class="d-flex gap-2 ms-auto">
                            <a href="{{ route('admin.news.create') }}" class="btn btn-warning">
                                <i class="fas fa-plus"></i> Add News
                            </a>
                            <a href="{{ url('admin/news/section') }}" class="btn btn-info">
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
                                    <th>Press Release Date</th>
                                    <th>File</th>
                                    <th>Sequence</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($news as $newsItem)
                                    <tr>
                                        <td>{{ $newsItem->id }}</td>
                                        <td>{{ $newsItem->title }}</td>
                                        <td>{{ $newsItem->press_release->format('Y-m-d') }}</td>
                                        <td>
                                            @if ($newsItem->file)
                                                <a href="{{ asset('storage/' . $newsItem->file) }}" target="_blank"
                                                    class="btn btn-sm btn-info">
                                                    <i class="fas fa-file-pdf"></i> View PDF
                                                </a>
                                            @else
                                                No File
                                            @endif
                                        </td>
                                        <td>{{ $newsItem->sequence }}</td>
                                        <td>
                                            @if ($newsItem->status)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.news.show', $newsItem) }}" class="me-2"
                                                    title="View">
                                                    <i class="fas fa-eye text-info" style="font-size: 1.2rem;"></i>
                                                </a>
                                                <a href="{{ route('admin.news.edit', $newsItem) }}" class="me-2"
                                                    title="Edit">
                                                    <i class="fas fa-edit text-warning" style="font-size: 1.2rem;"></i>
                                                </a>
                                                <form action="{{ route('admin.news.destroy', $newsItem) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn p-0"
                                                        style="background: none; border: none;" title="Delete"
                                                        onclick="return confirm('Are you sure you want to delete this news item?')">
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
                    {{ $news->withQueryString()->links('vendor.pagination.bootstrap-5-always') }}
                </div>
            </div>
        </div>
    </div>
@endsection
