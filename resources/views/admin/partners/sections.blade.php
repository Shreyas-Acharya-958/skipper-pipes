@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Partner Sections - {{ $partner->title }}</h4>
                    <a href="{{ route('admin.partners.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" id="sectionTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="section-one-tab" data-bs-toggle="tab" data-bs-target="#section-one"
                                type="button" role="tab" aria-controls="section-one" aria-selected="true">Why Become a
                                Skipper Distributor/Dealer?</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="section-two-tab" data-bs-toggle="tab" data-bs-target="#section-two"
                                type="button" role="tab" aria-controls="section-two" aria-selected="false">What Skipper
                                Pipes Offers</button>
                        </li>
                        <li class="nav-item" role="presentation" style="display:none">
                            <button class="nav-link" id="pipes-offers-tab" data-bs-toggle="tab"
                                data-bs-target="#pipes-offers" type="button" role="tab" aria-controls="pipes-offers"
                                aria-selected="false">Pipes Offer Images</button>
                        </li>
                    </ul>
                    <div class="tab-content mt-4" id="sectionTabsContent">
                        <!-- Section One Tab -->
                        <div class="tab-pane fade" id="section-one" role="tabpanel" aria-labelledby="section-one-tab">
                            <form action="{{ route('admin.partners.sections.one.save', $partner) }}" method="POST"
                                enctype="multipart/form-data" id="sectionOneForm" class="tab-form" data-tab="section-one">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Description <span
                                                    class="text-danger">*</span></label>
                                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                                rows="5" required>{{ old('description', $partner->sectionOne->description ?? '') }}</textarea>
                                            @error('description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row" id="imageInputs">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Images</label>
                                            <input type="file" class="form-control mb-2" name="images[]" multiple>
                                        </div>
                                    </div>
                                </div>

                                @if ($partner->sectionOne && $partner->sectionOne->image)
                                    <div class="row mb-4">
                                        <div class="col-md-12">
                                            <h5>Current Images</h5>
                                            <div class="row">
                                                @foreach (explode(',', $partner->sectionOne->image) as $image)
                                                    <div class="col-md-3 mb-3">
                                                        <div class="card">
                                                            <img src="{{ asset('storage/' . trim($image)) }}"
                                                                class="card-img-top" alt="Section Image">

                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Save Section One</button>
                                </div>
                            </form>
                        </div>

                        <!-- Section Two Tab -->
                        <div class="tab-pane fade" id="section-two" role="tabpanel" aria-labelledby="section-two-tab">
                            <div class="mb-3">
                                <button type="button" class="btn btn-success" id="addSectionTwoItem">
                                    <i class="fas fa-plus"></i> Add New Item
                                </button>
                            </div>

                            <form action="{{ route('admin.partners.sections.two.save', $partner) }}" method="POST"
                                id="sectionTwoForm" class="tab-form" data-tab="section-two" enctype="multipart/form-data">
                                @csrf
                                <div id="sectionTwoItems">
                                    @if ($partner->sectionTwo && count(json_decode($partner->sectionTwo->title)) > 0)
                                        @foreach (json_decode($partner->sectionTwo->title) as $key => $title)
                                            <div class="row mb-3 section-two-item">
                                                <div class="col-md-2">
                                                    <div class="mb-3">
                                                        <label class="form-label">Image</label>
                                                        @php
                                                            $sectionTwoImages = $partner->sectionTwo
                                                                ? json_decode($partner->sectionTwo->image, true)
                                                                : [];
                                                        @endphp
                                                        @if (!empty($sectionTwoImages) && isset($sectionTwoImages[$key]))
                                                            <div class="mb-2 image-preview">
                                                                <img src="{{ asset('storage/' . $sectionTwoImages[$key]) }}"
                                                                    alt="Section Image"
                                                                    style="max-width: 100px; height: auto;">
                                                            </div>
                                                        @endif
                                                        <input type="file" class="form-control image-input"
                                                            name="images[]" accept="image/*,.svg"
                                                            onchange="previewImage(this)">
                                                        <input type="hidden" name="existing_images[]"
                                                            value="{{ isset($sectionTwoImages[$key]) ? $sectionTwoImages[$key] : '' }}">
                                                        <div class="mt-2 new-image-preview" style="display: none;">
                                                            <img src="" alt="New Image Preview"
                                                                style="max-width: 100px; height: auto;">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Title <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="titles[]"
                                                            value="{{ $title }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="mb-3">
                                                        <label class="form-label">Description <span
                                                                class="text-danger">*</span></label>
                                                        <textarea class="form-control" name="descriptions[]" rows="3" required>{{ json_decode($partner->sectionTwo->description)[$key] }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="mb-3">
                                                        <label class="form-label">&nbsp;</label>
                                                        <button type="button"
                                                            class="btn btn-danger d-block w-100 remove-item">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>

                                <div class="text-end mt-3">
                                    <button type="submit" class="btn btn-primary">Save Section Two</button>
                                </div>
                            </form>
                        </div>

                        <!-- Pipes Offers Tab -->
                        <div class="tab-pane fade" id="pipes-offers" role="tabpanel" aria-labelledby="pipes-offers-tab">
                            <form action="{{ route('admin.partners.sections.pipes-offers.save', $partner) }}"
                                method="POST" enctype="multipart/form-data" class="tab-form" data-tab="pipes-offers">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="offer_images" class="form-label">Add Images</label>
                                            <input type="file"
                                                class="form-control @error('images.*') is-invalid @enderror"
                                                id="offer_images" name="images[]" multiple accept="image/*,.svg">
                                            @error('images.*')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end mb-4">
                                    <button type="submit" class="btn btn-primary">Upload Images</button>
                                </div>
                            </form>

                            <div class="row">
                                @foreach ($partner->pipesOffers as $offer)
                                    <div class="col-md-3 mb-4">
                                        <div class="card">
                                            <img src="{{ asset('storage/' . $offer->image) }}" class="card-img-top"
                                                alt="Offer Image">
                                            <div class="card-body text-center">
                                                <form
                                                    action="{{ route('admin.partners.sections.pipes-offers.delete', [$partner, $offer]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure you want to delete this image?')">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </button>
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
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get active tab from URL or session flash
            const urlParams = new URLSearchParams(window.location.search);
            const tabParam = urlParams.get('tab');
            const sessionTab = '{{ session('active_tab') }}';

            // Function to activate tab
            function activateTab(tabId) {
                const tab = document.querySelector(`#${tabId}-tab`);
                if (tab) {
                    const bsTab = new bootstrap.Tab(tab);
                    bsTab.show();
                }
            }

            // Set active tab from URL, session, or default to first tab
            if (tabParam) {
                activateTab(tabParam);
            } else if (sessionTab) {
                activateTab(sessionTab);
            } else {
                activateTab('section-one');
            }

            // Update URL when tab changes
            const tabs = document.querySelectorAll('[data-bs-toggle="tab"]');
            tabs.forEach(tab => {
                tab.addEventListener('shown.bs.tab', function(event) {
                    const tabId = event.target.id.replace('-tab', '');
                    const url = new URL(window.location.href);
                    url.searchParams.set('tab', tabId);
                    window.history.pushState({}, '', url);
                });
            });

            // Handle form submissions
            const forms = document.querySelectorAll('.tab-form');
            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    const tabId = this.dataset.tab;
                    const formData = new FormData(this);
                    formData.append('active_tab', tabId);
                });
            });

            // Section Two Item Template
            const sectionTwoTemplate = `
                <div class="row mb-3 section-two-item">
                    <div class="col-md-2">
                        <div class="mb-3">
                            <label class="form-label">Image</label>
                            <input type="file" class="form-control image-input" name="images[]" accept="image/*,.svg" onchange="previewImage(this)">
                            <input type="hidden" name="existing_images[]" value="">
                            <div class="mt-2 new-image-preview" style="display: none;">
                                <img src="" alt="New Image Preview" style="max-width: 100px; height: auto;">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="titles[]" required>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="mb-3">
                            <label class="form-label">Description <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="descriptions[]" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="mb-3">
                            <label class="form-label">&nbsp;</label>
                            <button type="button" class="btn btn-danger d-block w-100 remove-item">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `;

            // Add Section Two Item
            document.getElementById('addSectionTwoItem').addEventListener('click', function() {
                document.getElementById('sectionTwoItems').insertAdjacentHTML('beforeend',
                    sectionTwoTemplate);
            });

            // Remove Section Two Item
            document.getElementById('sectionTwoItems').addEventListener('click', function(e) {
                if (e.target.closest('.remove-item')) {
                    e.target.closest('.section-two-item').remove();
                }
            });

            // Delete Image
            document.querySelectorAll('.delete-image').forEach(button => {
                button.addEventListener('click', function() {
                    if (confirm('Are you sure you want to delete this image?')) {
                        const image = this.dataset.image;
                        fetch(`{{ route('admin.partners.sections.one.delete-image', $partner->id) }}`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    image: image
                                })
                            }).then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    this.closest('.col-md-3').remove();
                                }
                            });
                    }
                });
            });

            // Image preview function
            function previewImage(input) {
                const previewContainer = input.closest('.mb-3').querySelector('.new-image-preview');
                const previewImage = previewContainer.querySelector('img');
                const existingPreview = input.closest('.mb-3').querySelector('.image-preview');

                if (input.files && input.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                        previewContainer.style.display = 'block';
                        if (existingPreview) {
                            existingPreview.style.display = 'none';
                        }
                    }

                    reader.readAsDataURL(input.files[0]);
                } else {
                    previewContainer.style.display = 'none';
                    if (existingPreview) {
                        existingPreview.style.display = 'block';
                    }
                }
            }

            // Add image preview to new items
            document.getElementById('addSectionTwoItem').addEventListener('click', function() {
                const newItem = document.createElement('div');
                newItem.innerHTML = `
                    <div class="row mb-3 section-two-item">
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label class="form-label">Image</label>
                                <input type="file" class="form-control image-input" name="images[]" accept="image/*,.svg" onchange="previewImage(this)">
                                <input type="hidden" name="existing_images[]" value="">
                                <div class="mt-2 new-image-preview" style="display: none;">
                                    <img src="" alt="New Image Preview" style="max-width: 100px; height: auto;">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="titles[]" required>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="mb-3">
                                <label class="form-label">Description <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="descriptions[]" rows="3" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="mb-3">
                                <label class="form-label">&nbsp;</label>
                                <button type="button" class="btn btn-danger d-block w-100 remove-item">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                `;
                document.getElementById('sectionTwoItems').appendChild(newItem.firstElementChild);
            });
        });
    </script>
@endpush
