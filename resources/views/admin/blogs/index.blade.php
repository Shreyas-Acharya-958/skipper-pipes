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
                        <div class="d-flex gap-2 ms-auto">
                            <button type="button" class="btn btn-primary" id="openSequenceModalBtn">
                                <i class="fas fa-arrows-alt"></i> Set Sequence
                            </button>
                            <a href="{{ route('admin.blogs.create') }}" class="btn btn-warning">
                                <i class="fas fa-plus"></i> Add New Blog
                            </a>
                            <a href="{{ url('admin/blogs/section') }}" class="btn btn-info">
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
                                    <th>Sequence</th>
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
                                        <td>{{ $blog->sequence ?? 0 }}</td>
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

<div class="modal fade" id="sequenceModal" tabindex="-1" aria-labelledby="sequenceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sequenceModalLabel">Set Blog Sequence</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-muted small mb-3">Drag and drop the blogs to update their order.</p>
                <ul class="list-group" id="sequenceList">
                    <li class="list-group-item text-center text-muted">No blogs found.</li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveSequenceBtn">
                    <i class="fas fa-save"></i> Save Order
                </button>
            </div>
        </div>
    </div>
</div>

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

<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const openModalBtn = document.getElementById('openSequenceModalBtn');
        const sequenceList = document.getElementById('sequenceList');
        const saveSequenceBtn = document.getElementById('saveSequenceBtn');
        const modalEl = document.getElementById('sequenceModal');
        const sequenceModal = modalEl ? new bootstrap.Modal(modalEl) : null;
        let sortableInstance = null;

        function initializeSortable() {
            if (!sequenceList) return;
            if (sortableInstance) {
                sortableInstance.destroy();
            }
            sortableInstance = Sortable.create(sequenceList, {
                animation: 150,
                handle: '.drag-handle'
            });
        }

        function renderSequenceItems(items) {
            if (!sequenceList) {
                return;
            }
            if (!items.length) {
                sequenceList.innerHTML =
                    '<li class="list-group-item text-center text-muted">No blogs found.</li>';
                return;
            }
            sequenceList.innerHTML = items.map(item => `
                <li class="list-group-item d-flex justify-content-between align-items-center" data-id="${item.id}">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-grip-vertical me-3 drag-handle text-muted"></i>
                        <span class="fw-semibold">${item.title}</span>
                    </div>
                    <span class="badge bg-light text-dark">#${item.sequence}</span>
                </li>
            `).join('');
        }

        function fetchSequenceData() {
            if (!sequenceList) return;
            sequenceList.innerHTML = '<li class="list-group-item text-center text-muted">Loading...</li>';
            fetch('{{ route('admin.blogs.sequence.list') }}', {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    renderSequenceItems(data.data || []);
                    initializeSortable();
                    sequenceModal?.show();
                })
                .catch(() => {
                    sequenceList.innerHTML =
                        '<li class="list-group-item text-center text-danger">Failed to load blogs.</li>';
                });
        }

        function saveSequence() {
            if (!sequenceList) return;
            const items = Array.from(sequenceList.querySelectorAll('li[data-id]')).map((item, index) => ({
                id: item.getAttribute('data-id'),
                sequence: index + 1
            }));

            if (!items.length) {
                return;
            }

            saveSequenceBtn.disabled = true;
            fetch('{{ route('admin.blogs.update-sequence') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        items
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Failed to update sequence');
                    }
                    return response.json();
                })
                .then(() => {
                    sequenceModal?.hide();
                    window.location.reload();
                })
                .catch(() => {
                    alert('Unable to update sequence. Please try again.');
                })
                .finally(() => {
                    saveSequenceBtn.disabled = false;
                });
        }

        openModalBtn?.addEventListener('click', fetchSequenceData);
        saveSequenceBtn?.addEventListener('click', saveSequence);
    });
</script>
