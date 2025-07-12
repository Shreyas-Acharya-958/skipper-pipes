@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Sections</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <form id="searchForm" method="GET" action="{{ url()->current() }}" class="d-flex"
                            style="max-width: 400px;">
                            <input type="text" name="search" class="form-control me-2" placeholder="Search..."
                                value="{{ request('search') }}">
                        </form>
                        <a href="{{ route('admin.sections.create') }}" class="btn btn-warning">
                            <i class="fas fa-plus"></i> Add New Section
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Slug</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sections as $section)
                                    <tr>
                                        <td>{{ $section->id }}</td>
                                        <td>{{ $section->title }}</td>
                                        <td>{{ $section->slug }}</td>
                                        <td>
                                            @if ($section->image)
                                                <img src="{{ asset('storage/' . $section->image) }}"
                                                    alt="{{ $section->title }}" style="max-width: 100px; height: auto;">
                                            @else
                                                No Image
                                            @endif
                                        </td>
                                        <td>
                                            @if ($section->status)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.sections.edit', $section) }}"
                                                    class="btn btn-warning btn-sm me-2" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.sections.destroy', $section) }}"
                                                    method="POST" class="d-inline delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $sections->withQueryString()->links('vendor.pagination.bootstrap-5-always') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Initialize delete confirmations
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                if (confirm('Are you sure you want to delete this section?')) {
                    this.submit();
                }
            });
        });
    </script>
@endpush
