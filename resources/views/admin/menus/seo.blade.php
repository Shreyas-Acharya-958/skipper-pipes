@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Menu SEO Metadata</h4>
                    <a href="{{ route('admin.menus.index') }}" class="btn btn-secondary btn-sm">Back to Menu Management</a>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <div id="seo-success-message" class="alert alert-success d-none"></div>
                    <div id="seo-error-message" class="alert alert-danger d-none"></div>
                    <div class="container-fluid">
                        <h5 class="mb-4">Manage SEO Metadata for Each Menu</h5>
                        <div class="accordion" id="menuSeoAccordion">
                            @foreach ($menus as $menu)
                                @php $meta = $seoMetadata[$menu->id] ?? null; @endphp
                                <div class="accordion-item mb-2">
                                    <h2 class="accordion-header" id="heading-{{ $menu->id }}">
                                        <button
                                            class="accordion-button collapsed d-flex justify-content-between align-items-center"
                                            type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse-{{ $menu->id }}" aria-expanded="false"
                                            aria-controls="collapse-{{ $menu->id }}">
                                            <span>
                                                <strong>{{ $menu->title }}</strong>
                                                <small class="text-muted">({{ $menu->link }})</small>
                                            </span>
                                            <span class="badge ms-2 {{ $meta ? 'bg-success' : 'bg-secondary' }}">
                                                {{ $meta ? 'SEO Set' : 'No SEO' }}
                                            </span>
                                        </button>
                                    </h2>
                                    <div id="collapse-{{ $menu->id }}" class="accordion-collapse collapse show"
                                        aria-labelledby="heading-{{ $menu->id }}" data-bs-parent="#menuSeoAccordion">
                                        <div class="accordion-body bg-white">
                                            @if ($meta)
                                                <div class="mb-3">
                                                    <div class="small text-muted mb-1">Current SEO:</div>
                                                    <ul class="list-unstyled mb-2">
                                                        <li><strong>Title:</strong> {{ $meta->meta_title }}</li>
                                                        <li><strong>Description:</strong> {{ $meta->meta_description }}
                                                        </li>
                                                        <li><strong>Keywords:</strong> {{ $meta->meta_keywords }}</li>
                                                    </ul>
                                                </div>
                                                <hr>
                                            @endif
                                            <form action="{{ route('admin.seo.store') }}" method="POST"
                                                class="row g-2 align-items-end seo-form"
                                                data-menu-id="{{ $menu->id }}">
                                                @csrf
                                                <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                                                <div class="col-12 mb-2">
                                                    <label class="form-label mb-1">Meta Title</label>
                                                    <input type="text" name="meta_title" class="form-control"
                                                        value="{{ old('meta_title', $meta->meta_title ?? '') }}"
                                                        placeholder="Enter meta title">
                                                </div>
                                                <div class="col-12 mb-2">
                                                    <label class="form-label mb-1">Meta Description</label>
                                                    <input type="text" name="meta_description" class="form-control"
                                                        value="{{ old('meta_description', $meta->meta_description ?? '') }}"
                                                        placeholder="Enter meta description">
                                                </div>
                                                <div class="col-12 mb-2">
                                                    <label class="form-label mb-1">Meta Keywords</label>
                                                    <input type="text" name="meta_keywords" class="form-control"
                                                        value="{{ old('meta_keywords', $meta->meta_keywords ?? '') }}"
                                                        placeholder="Enter meta keywords">
                                                </div>
                                                <div class="col-12 text-end">
                                                    <button type="submit"
                                                        class="btn {{ $meta ? 'btn-success' : 'btn-primary' }}">
                                                        {{ $meta ? 'Update' : 'Add' }}
                                                    </button>
                                                </div>
                                                <div class="seo-success-message alert alert-success d-none"></div>
                                                <div class="seo-error-message alert alert-danger d-none"></div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            $('.seo-form').on('submit', function(e) {
                e.preventDefault();
                var $form = $(this);
                var formData = $form.serialize();
                var menuId = $form.data('menu-id');
                var $successMsg = $form.find('.seo-success-message');
                var $errorMsg = $form.find('.seo-error-message');
                $successMsg.addClass('d-none').text('');
                $errorMsg.addClass('d-none').text('');

                $.ajax({
                    url: $form.attr('action'),
                    method: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]', $form).val()
                    },
                    success: function(response) {
                        console.log('AJAX success', response);
                        let msg = response.message || 'SEO metadata saved successfully!';
                        $successMsg.removeClass('d-none').text(msg);
                        setTimeout(function() {
                            location.reload(); // Reloads the page
                        }, 1000); // 1 second delay so user sees the message
                    },
                    error: function(xhr) {
                        let msg = 'An error occurred.';
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            // Show the first validation error
                            msg = Object.values(xhr.responseJSON.errors).flat().join(' ');
                        } else if (xhr.responseJSON && xhr.responseJSON.message) {
                            msg = xhr.responseJSON.message;
                        }
                        $errorMsg.removeClass('d-none').text(msg);
                        setTimeout(function() {
                            $errorMsg.addClass('d-none');
                        }, 3000);
                    }
                });
            });
        });
    </script>
@endpush
