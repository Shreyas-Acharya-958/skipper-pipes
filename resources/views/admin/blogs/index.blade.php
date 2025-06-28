@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Blogs</h4>

                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <form id="searchForm" method="GET" action="{{ url()->current() }}" class="d-flex"
                            style="max-width: 400px;">
                            <input type="text" name="search" class="form-control me-2" placeholder="Search..."
                                value="{{ request('search') }}">

                        </form>
                        <a href="{{ route('admin.blogs.create') }}" class="btn btn-warning">
                            <i class="fas fa-plus"></i> Add New Blog
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Tags</th>
                                    <th>Status</th>
                                    <th>Published At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="blogTableBody">
                                @foreach ($blogs as $blog)
                                    <tr>
                                        <td>{{ $blog->id }}</td>
                                        <td>{{ $blog->title }}</td>
                                        <td>{{ $blog->category->title ?? 'N/A' }}</td>
                                        <td>
                                            @foreach ($blog->tags as $tag)
                                                <span class="badge bg-info me-1">{{ $tag->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @if ($blog->status)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $blog->published_at ? \Carbon\Carbon::parse($blog->published_at)->format('d-m-Y H:i:s') : 'Not Published' }}
                                        </td>

                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.blogs.show', $blog) }}" class="me-2"
                                                    title="View">
                                                    <i class="fas fa-eye text-info" style="font-size: 1.2rem;"></i>
                                                </a>
                                                <a href="{{ route('admin.blogs.edit', $blog) }}" class="me-2"
                                                    title="Edit">
                                                    <i class="fas fa-edit text-warning" style="font-size: 1.2rem;"></i>
                                                </a>
                                                <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn p-0"
                                                        style="background: none; border: none;" title="Delete"
                                                        onclick="return confirm('Are you sure?')">
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
                    <div id="paginationLinks">
                        {{ $blogs->withQueryString()->links('vendor.pagination.bootstrap-5-always') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    function ajaxifyPagination() {
        document.querySelectorAll('#paginationLinks .pagination a').forEach(function(link) {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                fetch(this.href, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(res => res.text())
                    .then(html => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');
                        document.getElementById('blogTableBody').innerHTML = doc.getElementById(
                            'blogTableBody').innerHTML;
                        document.getElementById('paginationLinks').innerHTML = doc.getElementById(
                            'paginationLinks').innerHTML;
                        ajaxifyPagination(); // re-attach after DOM update!
                    });
            });
        });
    }

    // Initial attach
    ajaxifyPagination();

    // Also call ajaxifyPagination() after your search AJAX updates the DOM!
    document.getElementById('searchForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const form = this;
        const url = form.action + '?' + new URLSearchParams(new FormData(form)).toString();
        fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(res => res.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                document.getElementById('blogTableBody').innerHTML = doc.getElementById('blogTableBody')
                    .innerHTML;
                document.getElementById('paginationLinks').innerHTML = doc.getElementById('paginationLinks')
                    .innerHTML;
                ajaxifyPagination(); // re-attach after DOM update!
            });
    });
</script>
