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
                                                    <option value="{{ $menu->id }}">{{ $menu->title }}</option>
                                                @endforeach
                                            </select>
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
                    tolerance: 'pointer',
                    cursor: 'move',
                    connectWith: '.menu-tree, .submenu',
                    update: function(event, ui) {
                        if (this === ui.item.parent()[0]) {
                            updateOrder();
                        }
                    }
                });
            }

            // Initialize sortable on the main menu and all submenus
            initializeSortable('.menu-tree');
            initializeSortable('.submenu');

            // Update menu order
            function updateOrder() {
                const items = [];
                let sequence = 0;

                function traverseMenu(element, parentId = null) {
                    $(element).children('li').each(function() {
                        const id = $(this).data('id');
                        items.push({
                            id: id,
                            parent_id: parentId,
                            sequence: sequence++
                        });

                        // Traverse submenu if exists
                        const submenu = $(this).children('.submenu');
                        if (submenu.length) {
                            traverseMenu(submenu, id);
                        }
                    });
                }

                traverseMenu('#menu-tree');

                $.ajax({
                    url: '{{ route('admin.menus.update-order') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        items: items
                    },
                    success: function(response) {
                        orderToast.show();
                    },
                    error: function(error) {
                        console.error('Error updating order:', error);
                        const errorToast = document.getElementById('orderToast');
                        errorToast.classList.remove('bg-success');
                        errorToast.classList.add('bg-danger');
                        errorToast.querySelector('.toast-body').textContent =
                            'Error updating menu order!';
                        bootstrap.Toast.getOrCreateInstance(errorToast).show();
                    }
                });
            }

            // Edit menu
            window.editMenu = function(id) {
                const menu = findMenu(id);
                if (menu) {
                    $('#menu_id').val(menu.id);
                    $('#title').val(menu.title);
                    $('#link').val(menu.link);
                    $('#parent_id').val(menu.parent_id);
                    $('#status').val(menu.status ? '1' : '0');
                    $('#is_active').val(menu.is_active ? '1' : '0');
                    $('#method').val('PUT');
                    $('#menuForm').attr('action', `/admin/menus/${id}`);
                    $('#submitBtn').text('Update Menu');
                }
            };

            // Delete menu
            window.deleteMenu = function(id) {
                if (confirm('Are you sure you want to delete this menu?')) {
                    $(`form#delete-form-${id}`).submit();
                }
            };

            // Reset form
            window.resetForm = function() {
                $('#menuForm')[0].reset();
                $('#menu_id').val('');
                $('#method').val('POST');
                $('#menuForm').attr('action', '{{ route('admin.menus.store') }}');
                $('#submitBtn').text('Create Menu');
            };

            // Helper function to find menu data
            function findMenu(id) {
                const menuItem = $(`#menu-${id}`);
                return {
                    id: id,
                    title: menuItem.find('.menu-title').text().trim(),
                    link: menuItem.data('link'),
                    parent_id: menuItem.data('parent-id'),
                    status: menuItem.data('status'),
                    is_active: menuItem.data('is-active')
                };
            }
        });
    </script>
@endpush
