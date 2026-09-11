@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Product Inquiries</h4>
                </div>

                <div class="card-body">

                    <form method="GET"
                          action="{{ url()->current() }}"
                          class="d-flex mb-3"
                          style="max-width: 400px;">

                        <input
                            type="text"
                            name="search"
                            class="form-control me-2"
                            placeholder="Search by name, email or mobile..."
                            value="{{ request('search') }}"
                        >

                        <button type="submit" class="btn btn-primary">
                            Search
                        </button>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Product</th>
                                    <th>Brochure Type</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Pincode</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($inquiries as $inquiry)
                                    <tr>
                                        <td>{{ $inquiry->id }}</td>
                                        <td>{{ $inquiry->product_id }}</td>
                                        <td>{{ ucwords($inquiry->brochure_type) }}</td>
                                        <td>{{ $inquiry->name }}</td>
                                        <td>{{ $inquiry->email ?? '-' }}</td>
                                        <td>{{ $inquiry->mobile }}</td>
                                        <td>{{ $inquiry->pincode }}</td>
                                        <td>{{ $inquiry->created_at?->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <form
        action="{{ route('admin.products.inquiries.destroy', $inquiry) }}"
        method="POST"
        class="d-inline"
        onsubmit="return confirm('Are you sure you want to delete this inquiry?')"
    >
        @csrf
        @method('DELETE')

        <button
            type="submit"
            class="btn btn-link p-0"
            title="Delete"
        >
            <i class="fas fa-trash text-danger" style="font-size: 1.2rem;"></i>
        </button>
    </form></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">
                                            No inquiries found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{ $inquiries->links('vendor.pagination.bootstrap-5-always') }}

                </div>
            </div>
        </div>
    </div>
@endsection