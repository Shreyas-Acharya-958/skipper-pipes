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
                            <button type="button" class="btn btn-primary" id="openMediaSequenceModalBtn">
                                <i class="fas fa-arrows-alt"></i> Set Sequence
                            </button>
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
                                    <th>Sequence</th>
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
                                        <td>{{ $item->sequence ?? 0 }}</td>
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

<div class="modal fade" id="mediaSequenceModal" tabindex="-1" aria-labelledby="mediaSequenceModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediaSequenceModalLabel">Set Media Sequence</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-muted small mb-3">Drag and drop the media items to update their order.</p>
                <ul class="list-group" id="mediaSequenceList">
                    <li class="list-group-item text-center text-muted">No media found.</li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveMediaSequenceBtn">
                    <i class="fas fa-save"></i> Save Order
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const openModalBtn = document.getElementById('openMediaSequenceModalBtn');
        const sequenceList = document.getElementById('mediaSequenceList');
        const saveSequenceBtn = document.getElementById('saveMediaSequenceBtn');
        const modalEl = document.getElementById('mediaSequenceModal');
        const mediaSequenceModal = modalEl ? new bootstrap.Modal(modalEl) : null;
        let sortableInstance = null;

        function initializeSortable() {
            if (!sequenceList) return;
            if (sortableInstance) {
                sortableInstance.destroy();
            }
            sortableInstance = Sortable.create(sequenceList, {
                animation: 150,
                handle: '.drag-handle',
                filter: '.sequence-group-header'
            });
        }

        function renderSequenceItems(items) {
            if (!sequenceList) {
                return;
            }
            if (!items.length) {
                sequenceList.innerHTML =
                    '<li class="list-group-item text-center text-muted">No media found.</li>';
                return;
            }
            let currentType = null;
            const htmlParts = [];
            items.forEach(item => {
                if (item.media_type !== currentType) {
                    currentType = item.media_type;
                    htmlParts.push(`
                        <li class="list-group-item sequence-group-header text-uppercase fw-semibold text-muted small">
                            ${currentType}
                        </li>
                    `);
                }
                htmlParts.push(`
                    <li class="list-group-item d-flex justify-content-between align-items-center" data-id="${item.id}">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-grip-vertical me-3 drag-handle text-muted"></i>
                            <div>
                                <span class="badge bg-secondary me-2">ID #${item.id}</span>
                                <span class="fw-semibold">${item.title}</span>
                            </div>
                        </div>
                        <span class="badge bg-light text-dark">#${item.sequence}</span>
                    </li>
                `);
            });
            sequenceList.innerHTML = htmlParts.join('');
        }

        function fetchSequenceData() {
            if (!sequenceList) return;
            sequenceList.innerHTML = '<li class="list-group-item text-center text-muted">Loading...</li>';
            fetch('{{ route('admin.media.sequence.list') }}', {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    renderSequenceItems(data.data || []);
                    initializeSortable();
                    mediaSequenceModal?.show();
                })
                .catch(() => {
                    sequenceList.innerHTML =
                        '<li class="list-group-item text-center text-danger">Failed to load media items.</li>';
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
            fetch('{{ route('admin.media.update-sequence') }}', {
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
                    mediaSequenceModal?.hide();
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
