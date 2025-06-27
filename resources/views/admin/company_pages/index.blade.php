@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Company Pages</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <form id="searchForm" method="GET" action="{{ url()->current() }}" class="d-flex"
                            style="max-width: 400px;">
                            <input type="text" name="search" class="form-control me-2" placeholder="Search..."
                                value="{{ request('search') }}">
                        </form>
                        <a href="{{ route('admin.company_pages.create') }}" class="btn btn-warning">
                            <i class="fas fa-plus"></i> Add New Page
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Slug</th>
                                    <th>Meta Title</th>
                                    <th>Status</th>
                                    <th>Is Active</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="pagesTableBody">
                                @forelse ($pages as $page)
                                    <tr>
                                        <td>{{ $page->id }}</td>
                                        <td>
                                            @if ($page->image)
                                                <img src="{{ asset('storage/' . $page->image) }}" alt="Page Image"
                                                    class="img-thumbnail" style="max-height: 50px;">
                                            @else
                                                <span class="text-muted">No image</span>
                                            @endif
                                        </td>
                                        <td>{{ $page->title }}</td>
                                        <td>{{ $page->slug }}</td>
                                        <td>{{ $page->meta_title }}</td>
                                        <td>
                                            <span class="badge bg-{{ $page->status ? 'success' : 'danger' }}">
                                                {{ $page->status ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ $page->is_active ? 'success' : 'danger' }}">
                                                {{ $page->is_active ? 'Yes' : 'No' }}
                                            </span>
                                        </td>
                                        <td>{{ $page->created_at->format('d-m-Y H:i:s') }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.company_pages.show', $page) }}" class="me-2"
                                                    title="View">
                                                    <i class="fas fa-eye text-info" style="font-size: 1.2rem;"></i>
                                                </a>
                                                <a href="{{ route('admin.company_pages.edit', $page) }}" class="me-2"
                                                    title="Edit">
                                                    <i class="fas fa-edit text-warning" style="font-size: 1.2rem;"></i>
                                                </a>
                                                <form action="{{ route('admin.company_pages.destroy', $page) }}"
                                                    method="POST" class="d-inline">
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
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">No company pages found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div id="paginationLinks">
                        {{ $pages->withQueryString()->links('vendor.pagination.bootstrap-5-always') }}
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
                        document.getElementById('pagesTableBody').innerHTML = doc.getElementById(
                            'pagesTableBody').innerHTML;
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
                document.getElementById('pagesTableBody').innerHTML = doc.getElementById('pagesTableBody')
                    .innerHTML;
                document.getElementById('paginationLinks').innerHTML = doc.getElementById('paginationLinks')
                    .innerHTML;
                ajaxifyPagination(); // re-attach after DOM update!
            });
    });
</script>
