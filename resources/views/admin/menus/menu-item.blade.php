<div class="dd-item" id="menu-{{ $menu->id }}" data-id="{{ $menu->id }}" data-link="{{ $menu->link }}"
    data-parent-id="{{ $menu->parent_id }}" data-status="{{ $menu->status }}" data-is-active="{{ $menu->is_active }}">
    <div class="dd-handle dd3-content">
        {{ $menu->title }}
        <div class="menu-actions">
            <a href="javascript:void(0)" onclick="editMenu({{ $menu->id }})" class="me-2" title="Edit">
                <i class="fas fa-edit text-warning" style="font-size: 1.2rem;"></i>
            </a>
            <form id="delete-form-{{ $menu->id }}" action="{{ route('admin.menus.destroy', $menu->id) }}"
                method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <a href="javascript:void(0)" onclick="deleteMenu({{ $menu->id }})" title="Delete">
                    <i class="fas fa-trash text-danger" style="font-size: 1.2rem;"></i>
                </a>
            </form>
        </div>
    </div>
    @if ($menu->children->count() > 0)
        <ol class="dd-list">
            @foreach ($menu->children as $child)
                @include('admin.menus.menu-item', ['menu' => $child])
            @endforeach
        </ol>
    @endif
</div>
