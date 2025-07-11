@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Menu Management</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Menu Form -->
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <form id="menuForm" action="{{ route('admin.menus.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" id="menu_id">
                                        <input type="hidden" name="_method" id="method" value="POST">

                                        <div class="mb-3">
                                            <label for="title" class="form-label">Title</label>
                                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                                id="title" name="title" required>
                                            @error('title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="link" class="form-label">Link</label>
                                            <input type="text" class="form-control @error('link') is-invalid @enderror"
                                                id="link" name="link">
                                            @error('link')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="parent_id" class="form-label">Parent Menu</label>
                                            <select class="form-select @error('parent_id') is-invalid @enderror"
                                                id="parent_id" name="parent_id">
                                                <option value="">None</option>
                                                @foreach ($menus as $menu)
                                                    <option value="{{ $menu->id }}" class="fw-bold">{{ $menu->title }}
                                                    </option>
                                                    @if ($menu->children->count() > 0)
                                                        @foreach ($menu->children as $child)
                                                            <option value="{{ $child->id }}" style="padding-left: 20px">
                                                                └─ {{ $child->title }}</option>
                                                            @if ($child->children->count() > 0)
                                                                @foreach ($child->children as $grandchild)
                                                                    <option value="{{ $grandchild->id }}"
                                                                        style="padding-left: 40px">└─
                                                                        {{ $grandchild->title }}</option>
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            </select>
                                            <div class="form-text">
                                                Select a parent menu to create nested menus. Items with no indentation are
                                                top-level, single indent (└─) are second level, double indent (└─) are third
                                                level.
                                            </div>
                                            @error('parent_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="status" class="form-label">Status</label>
                                                    <select class="form-select @error('status') is-invalid @enderror"
                                                        id="status" name="status" required>
                                                        <option value="1">Active</option>
                                                        <option value="0">Inactive</option>
                                                    </select>
                                                    @error('status')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="is_active" class="form-label">Is Active</label>
                                                    <select class="form-select @error('is_active') is-invalid @enderror"
                                                        id="is_active" name="is_active" required>
                                                        <option value="1">Yes</option>
                                                        <option value="0">No</option>
                                                    </select>
                                                    @error('is_active')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-between">
                                            <button type="button" class="btn btn-secondary"
                                                onclick="resetForm()">Reset</button>
                                            <button type="submit" class="btn btn-warning" id="submitBtn">Create
                                                Menu</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Menu Tree -->
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <ul id="menu-tree" class="menu-tree">
                                        @foreach ($menus as $menu)
                                            @include('admin.menus.menu-item', ['menu' => $menu])
                                        @endforeach
                                        <li class="menu-item">
                                            <div class="menu-handle">
                                                <i class="handle-icon fas fa-home"></i>
                                                <span class="menu-title">Home Page</span>
                                                <div class="menu-actions">
                                                    <a href="{{ route('admin.home-page.index') }}"
                                                        class="btn btn-sm btn-primary">View</a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Container -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="orderToast" class="toast align-items-center text-white bg-success border-0" role="alert"
            aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    Menu order updated successfully!
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .menu-tree {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .menu-item {
            margin: 5px 0;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 3px;
        }

        .menu-handle {
            padding: 10px 15px;
            background: #f8f9fa;
            cursor: move;
            position: relative;
            display: flex;
            align-items: center;
        }

        .menu-handle:hover {
            background: #e9ecef;
        }

        .handle-icon {
            color: #999;
            margin-right: 10px;
            font-size: 1.2rem;
        }

        .menu-title {
            flex-grow: 1;
            margin-right: 100px;
        }

        .menu-actions {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
        }

        .submenu {
            list-style: none;
            padding: 0 0 0 30px;
            margin: 0;
            border-left: 1px dashed #ddd;
        }

        .sortable-placeholder {
            border: 1px dashed #b6bcbf;
            background: #f2fbff;
            margin: 5px 0;
            min-height: 42px;
        }

        .sortable-dragging {
            opacity: 0.8;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script>
        $(document).ready(function() {
            const orderToast = new bootstrap.Toast(document.getElementById('orderToast'));

            function initializeSortable(element) {
                $(element).sortable({
                    handle: '.menu-handle',
                    items: '> li',
                    placeholder: 'sortable-placeholder',
                    forcePlaceholderSize: true,
                    tolerance: 'pointer',
                    cursor: 'move',
                    opacity: 0.8,
                    update: function(event, ui) {
                        updateMenuOrder();
                    }
                });
            }

            initializeSortable('#menu-tree');
            initializeSortable('.submenu');

            function updateMenuOrder() {
                const items = [];
                $('#menu-tree li.menu-item').each(function(index) {
                    const $item = $(this);
                    items.push({
                        id: $item.data('id'),
                        parent_id: $item.parent().closest('.menu-item').data('id') || null,
                        sequence: index
                    });
                });

                $.ajax({
                    url: '{{ route('admin.menus.update-order') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        items: items
                    },
                    success: function(response) {
                        orderToast.show();
                    }
                });
            }
        });

        function editMenu(id) {
            const menuItem = $(`#menu-${id}`);
            $('#menu_id').val(id);
            $('#title').val(menuItem.find('.menu-title').text().trim());
            $('#link').val(menuItem.data('link'));
            $('#parent_id').val(menuItem.data('parent-id'));
            $('#status').val(menuItem.data('status'));
            $('#is_active').val(menuItem.data('is-active'));
            $('#method').val('PUT');
            $('#menuForm').attr('action', `{{ url('admin/menus') }}/${id}`);
            $('#submitBtn').text('Update Menu');
        }

        function resetForm() {
            $('#menu_id').val('');
            $('#menuForm').trigger('reset');
            $('#method').val('POST');
            $('#menuForm').attr('action', '{{ route('admin.menus.store') }}');
            $('#submitBtn').text('Create Menu');
        }

        function deleteMenu(id) {
            if (confirm('Are you sure you want to delete this menu item?')) {
                $(`#delete-form-${id}`).submit();
            }
        }
    </script>
@endpush
