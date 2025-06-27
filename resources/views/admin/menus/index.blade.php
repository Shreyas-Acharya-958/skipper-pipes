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
                                    <div id="menu-tree" class="dd">
                                        <ol class="dd-list">
                                            @foreach ($menus as $menu)
                                                @include('admin.menus.menu-item', ['menu' => $menu])
                                            @endforeach
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.css">
    <style>
        .dd {
            max-width: 100%;
        }

        .dd-handle {
            height: auto;
            padding: 8px 15px;
            margin: 5px 0;
        }

        .dd-item>button {
            height: 30px;
        }

        .menu-actions {
            position: absolute;
            right: 10px;
            top: 5px;
        }

        .dd3-content {
            padding: 8px 15px 8px 40px;
            margin: 5px 0;
            background: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 3px;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize Nestable
            $('.dd').nestable({
                maxDepth: 3
            }).on('change', function() {
                updateOrder();
            });

            // Update menu order
            function updateOrder() {
                const items = $('.dd').nestable('serialize');
                $.ajax({
                    url: '{{ route('admin.menus.update-order') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        items: items
                    },
                    success: function(response) {
                        console.log('Order updated successfully');
                    },
                    error: function(error) {
                        console.error('Error updating order:', error);
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
                // This should be replaced with actual menu data from your backend
                return {
                    id: id,
                    title: $(`#menu-${id} .dd3-content`).text().trim(),
                    link: $(`#menu-${id}`).data('link'),
                    parent_id: $(`#menu-${id}`).data('parent-id'),
                    status: $(`#menu-${id}`).data('status'),
                    is_active: $(`#menu-${id}`).data('is-active')
                };
            }
        });
    </script>
@endpush
