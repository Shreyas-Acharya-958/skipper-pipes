@php use Illuminate\Support\Str; @endphp
@extends('admin.layouts.app')

@section('content')
    <div class="row mb-4">
        <div class="col-sm-6 col-lg-3">
            <div class="card mb-4 text-white bg-primary">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-semibold">
                            {{ \App\Models\Product::count() }}
                        </div>
                        <div>Products</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card mb-4 text-white bg-info">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-semibold">
                            {{ \App\Models\Blog::count() }}
                        </div>
                        <div>Blogs</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card mb-4 text-white bg-success">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-semibold">
                            {{ \App\Models\ProductCategory::count() }}
                        </div>
                        <div>Product Categories</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card mb-4 text-white bg-warning">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-semibold">
                            {{ \App\Models\BlogCategory::count() }}
                        </div>
                        <div>Blog Categories</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-12">
            <ul class="nav nav-tabs" id="inquiryTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="career-tab" data-bs-toggle="tab" data-bs-target="#career"
                        type="button" role="tab" aria-controls="career" aria-selected="true">
                        Career Applications <span class="badge bg-secondary">{{ $inquiries['career'] }}</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button"
                        role="tab" aria-controls="contact" aria-selected="false">
                        Contacts <span class="badge bg-secondary">{{ $inquiries['contact'] }}</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="partner-tab" data-bs-toggle="tab" data-bs-target="#partner" type="button"
                        role="tab" aria-controls="partner" aria-selected="false">
                        Partner Enquiries <span class="badge bg-secondary">{{ $inquiries['partner'] }}</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="blog-comment-tab" data-bs-toggle="tab" data-bs-target="#blog-comment"
                        type="button" role="tab" aria-controls="blog-comment" aria-selected="false">
                        Blog Comments <span class="badge bg-secondary">{{ $inquiries['blog_comment'] }}</span>
                    </button>
                </li>
            </ul>
            <div class="tab-content p-3 border border-top-0" id="inquiryTabsContent">
                <div class="tab-pane fade show active" id="career" role="tabpanel" aria-labelledby="career-tab">
                    <h5>Career Applications</h5>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Subject</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (\App\Models\CareerApplication::latest()->take(20)->get() as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->subject }}</td>
                                    <td><button class="btn btn-sm btn-link text-primary" type="button"
                                            onclick="toggleRow('career-{{ $item->id }}')">Details</button></td>
                                </tr>
                                <tr id="career-{{ $item->id }}" style="display:none; background:#f9f9f9;">
                                    <td colspan="5">
                                        <strong>DOB:</strong> {{ $item->dob }}<br>
                                        <strong>Resume:</strong>
                                        @if ($item->resume_path)
                                            <a href="{{ asset('storage/' . $item->resume_path) }}" target="_blank">View</a>
                                        @endif
                                        <br>
                                        <strong>Address:</strong> {{ $item->address }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <h5>Contacts</h5>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Subject</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (\App\Models\Contact::latest()->take(20)->get() as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->subject }}</td>
                                    <td><button class="btn btn-sm btn-link text-primary" type="button"
                                            onclick="toggleRow('contact-{{ $item->id }}')">Details</button></td>
                                </tr>
                                <tr id="contact-{{ $item->id }}" style="display:none; background:#f9f9f9;">
                                    <td colspan="5">
                                        <strong>Message:</strong> {{ $item->message }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="partner" role="tabpanel" aria-labelledby="partner-tab">
                    <h5>Partner Enquiries</h5>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Firm Name</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (\App\Models\PartnerEnquiry::latest()->take(20)->get() as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->firm_name }}</td>
                                    <td><button class="btn btn-sm btn-link text-primary" type="button"
                                            onclick="toggleRow('partner-{{ $item->id }}')">Details</button></td>
                                </tr>
                                <tr id="partner-{{ $item->id }}" style="display:none; background:#f9f9f9;">
                                    <td colspan="5">
                                        <strong>GST:</strong> {{ $item->gst }}<br>
                                        <strong>Pincode:</strong> {{ $item->pincode }}<br>
                                        <strong>Occupation:</strong> {{ $item->occupation }}<br>
                                        <strong>Experience:</strong> {{ $item->experience }}<br>
                                        <strong>Dealership Type:</strong> {{ $item->dealership_type }}<br>
                                        <strong>Description:</strong> {{ $item->description }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="blog-comment" role="tabpanel" aria-labelledby="blog-comment-tab">
                    <h5>Blog Comments (Pending)</h5>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (\App\Models\BlogComment::latest()->take(20)->get() as $item)
                                <tr id="blogcomment-row-{{ $item->id }}">
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ Str::limit($item->description, 30) }}</td>
                                    <td id="status-{{ $item->id }}">
                                        {{ $item->status == 0 ? 'Pending' : 'Approved' }}
                                        @if ($item->status == 0)
                                            <button type="button" class="btn btn-sm btn-success ms-2 approve-btn"
                                                data-id="{{ $item->id }}">Approve</button>
                                        @endif
                                    </td>
                                    <td><button class="btn btn-sm btn-link text-primary" type="button"
                                            onclick="toggleRow('blogcomment-{{ $item->id }}')">Details</button></td>
                                </tr>
                                <tr id="blogcomment-{{ $item->id }}" style="display:none; background:#f9f9f9;">
                                    <td colspan="5">
                                        <strong>Full Comment:</strong> {{ $item->description }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function toggleRow(id) {
            var row = document.getElementById(id);
            if (row.style.display === 'none') {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.approve-btn').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    var commentId = this.getAttribute('data-id');
                    var url = '/admin/blog-comments/' + commentId + '/approve';
                    var token = document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content');
                    fetch(url, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': token,
                                'Accept': 'application/json',
                            },
                        })
                        .then(response => {
                            if (!response.ok) throw new Error('Network response was not ok');
                            return response.json ? response.json() : response.text();
                        })
                        .then(() => {
                            document.getElementById('status-' + commentId).innerHTML =
                                'Approved';
                            Swal.fire({
                                icon: 'success',
                                title: 'Approved!',
                                text: 'Blog comment approved successfully.'
                            });
                        })
                        .catch(() => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Failed to approve comment.'
                            });
                        });
                });
            });
        });
    </script>
@endsection
