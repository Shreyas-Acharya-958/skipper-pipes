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
                            <button class="nav-link active" id="section-one-tab" data-bs-toggle="tab"
                                data-bs-target="#section-one" type="button" role="tab" aria-controls="section-one"
                                aria-selected="true">Why Become a Skipper Distributor/Dealer?</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="section-two-tab" data-bs-toggle="tab" data-bs-target="#section-two"
                                type="button" role="tab" aria-controls="section-two" aria-selected="false">What Skipper
                                Pipes Offers</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pipes-offers-tab" data-bs-toggle="tab"
                                data-bs-target="#pipes-offers" type="button" role="tab" aria-controls="pipes-offers"
                                aria-selected="false">Pipes Offer Images</button>
                        </li>
                    </ul>
                    <div class="tab-content mt-4" id="sectionTabsContent">
                        <!-- Section One Tab -->
                        <div class="tab-pane fade show active" id="section-one" role="tabpanel"
                            aria-labelledby="section-one-tab">
                            <form action="{{ route('admin.partners.sections.one.save', $partner) }}" method="POST"
                                enctype="multipart/form-data" id="sectionOneForm">
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
                                                            <div class="card-body text-center">
                                                                <button type="button"
                                                                    class="btn btn-danger btn-sm delete-image"
                                                                    data-image="{{ trim($image) }}">
                                                                    <i class="fas fa-trash"></i> Delete
                                                                </button>
                                                            </div>
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
                                id="sectionTwoForm">
                                @csrf
                                <div id="sectionTwoItems">
                                    @if ($partner->sectionTwo && count(json_decode($partner->sectionTwo->title)) > 0)
                                        @foreach (json_decode($partner->sectionTwo->title) as $key => $title)
                                            <div class="row mb-3 section-two-item">
                                                <div class="col-md-5">
                                                    <div class="mb-3">
                                                        <label class="form-label">Title <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="titles[]"
                                                            value="{{ $title }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
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
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="offer_images" class="form-label">Add Images</label>
                                            <input type="file"
                                                class="form-control @error('images.*') is-invalid @enderror"
                                                id="offer_images" name="images[]" multiple accept="image/*">
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
            // Section Two Item Template
            const sectionTwoTemplate = `
                <div class="row mb-3 section-two-item">
                    <div class="col-md-5">
                        <div class="mb-3">
                            <label class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="titles[]" required>
                        </div>
                    </div>
                    <div class="col-md-6">
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
        });
    </script>
@endpush
