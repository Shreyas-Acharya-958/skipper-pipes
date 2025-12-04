@php use Illuminate\Support\Str; @endphp
@extends('lead-management.layouts.app')

@section('title', 'Dashboard')
@section('content')
    <style>
        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
        }
    </style>
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="mb-4">Lead Management Dashboard</h2>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-12">
            <ul class="nav nav-tabs" id="inquiryTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="career-tab" data-bs-toggle="tab" data-bs-target="#career"
                        type="button" role="tab" aria-controls="career" aria-selected="true">
                        Career<span class="badge bg-secondary">{{ $inquiries['career'] }}</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button"
                        role="tab" aria-controls="contact" aria-selected="false">
                        Contacts <span class="badge bg-secondary">{{ $inquiries['contact'] }}</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="dealer-tab" data-bs-toggle="tab" data-bs-target="#dealer" type="button"
                        role="tab" aria-controls="dealer" aria-selected="false">
                        Become Dealer <span class="badge bg-secondary">{{ $inquiries['dealer'] }}</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="distributor-tab" data-bs-toggle="tab" data-bs-target="#distributor"
                        type="button" role="tab" aria-controls="distributor" aria-selected="false">
                        Become Distributor <span class="badge bg-secondary">{{ $inquiries['distributor'] }}</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="blog-comment-tab" data-bs-toggle="tab" data-bs-target="#blog-comment"
                        type="button" role="tab" aria-controls="blog-comment" aria-selected="false">
                        Blog Comments <span class="badge bg-secondary">{{ $inquiries['blog_comment'] }}</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="jal-rakshak-tab" data-bs-toggle="tab" data-bs-target="#jal-rakshak"
                        type="button" role="tab" aria-controls="jal-rakshak" aria-selected="false">
                        Jal Rakshak <span class="badge bg-secondary">{{ $inquiries['jal_rakshak'] }}</span>
                    </button>
                </li>
            </ul>
            <div class="tab-content p-3 border border-top-0" id="inquiryTabsContent">
                <div class="tab-pane fade show active" id="career" role="tabpanel" aria-labelledby="career-tab">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5>Career Applications</h5>
                        <a href="{{ route('lead-management.dashboard.export.career') }}" class="btn btn-success btn-sm">
                            <i class="fas fa-download"></i> Export Excel
                        </a>
                    </div>
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
                                            onclick="toggleRow('career-{{ $item->id }}')">Details</button>
                                        <button class="btn btn-sm btn-danger delete-inquiry" data-type="career"
                                            data-id="{{ $item->id }}">Delete</button>
                                    </td>
                                </tr>
                                <tr id="career-{{ $item->id }}" style="display:none; background:#f9f9f9;">
                                    <td colspan="5">
                                        <strong>DOB:</strong> {{ $item->dob }}<br>
                                        <strong>Resume:</strong>
                                        @if ($item->resume_path)
                                            <a href="{{ asset('storage/' . $item->resume_path) }}" target="_blank"
                                                class="btn btn-sm btn-primary">Download Resume</a>
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
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5>Contacts</h5>
                        <a href="{{ route('lead-management.dashboard.export.contacts') }}" class="btn btn-success btn-sm">
                            <i class="fas fa-download"></i> Export Excel
                        </a>
                    </div>
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
                                            onclick="toggleRow('contact-{{ $item->id }}')">Details</button>
                                        <button class="btn btn-sm btn-danger delete-inquiry" data-type="contact"
                                            data-id="{{ $item->id }}">Delete</button>
                                    </td>
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
                <div class="tab-pane fade" id="dealer" role="tabpanel" aria-labelledby="dealer-tab">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5>Become Dealer</h5>
                        <a href="{{ route('lead-management.dashboard.export.dealer') }}" class="btn btn-success btn-sm">
                            <i class="fas fa-download"></i> Export Excel
                        </a>
                    </div>
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
                            @foreach (\App\Models\PartnerEnquiry::where('partner_id', 1)->latest()->take(20)->get() as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->firm_name }}</td>
                                    <td><button class="btn btn-sm btn-link text-primary" type="button"
                                            onclick="toggleRow('dealer-{{ $item->id }}')">Details</button>
                                        <button class="btn btn-sm btn-danger delete-inquiry" data-type="partner"
                                            data-id="{{ $item->id }}">Delete</button>
                                    </td>
                                </tr>
                                <tr id="dealer-{{ $item->id }}" style="display:none; background:#f9f9f9;">
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
                <div class="tab-pane fade" id="distributor" role="tabpanel" aria-labelledby="distributor-tab">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5>Become Distributor</h5>
                        <a href="{{ route('lead-management.dashboard.export.distributor') }}" class="btn btn-success btn-sm">
                            <i class="fas fa-download"></i> Export Excel
                        </a>
                    </div>
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
                            @foreach (\App\Models\PartnerEnquiry::where('partner_id', 2)->latest()->take(20)->get() as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->firm_name }}</td>
                                    <td><button class="btn btn-sm btn-link text-primary" type="button"
                                            onclick="toggleRow('distributor-{{ $item->id }}')">Details</button>
                                        <button class="btn btn-sm btn-danger delete-inquiry" data-type="partner"
                                            data-id="{{ $item->id }}">Delete</button>
                                    </td>
                                </tr>
                                <tr id="distributor-{{ $item->id }}" style="display:none; background:#f9f9f9;">
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
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5>Blog Comments</h5>
                        <a href="{{ route('lead-management.dashboard.export.blog-comments') }}" class="btn btn-success btn-sm">
                            <i class="fas fa-download"></i> Export Excel
                        </a>
                    </div>
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
                                    </td>
                                    <td><button class="btn btn-sm btn-link text-primary" type="button"
                                            onclick="toggleRow('blogcomment-{{ $item->id }}')">Details</button>
                                        <button class="btn btn-sm btn-danger delete-inquiry" data-type="blog_comment"
                                            data-id="{{ $item->id }}">Delete</button>
                                    </td>
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
                <div class="tab-pane fade" id="jal-rakshak" role="tabpanel" aria-labelledby="jal-rakshak-tab">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5>Jal Rakshak</h5>
                        <a href="{{ route('lead-management.dashboard.export.jal-rakshak') }}" class="btn btn-success btn-sm">
                            <i class="fas fa-download"></i> Export Excel
                        </a>
                    </div>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Water Saving Commitment</th>
                                <th>Created At</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (\App\Models\JalRakshakSubmission::latest()->take(20)->get() as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ Str::limit($item->water_saving_commitment, 50) }}</td>
                                    <td>{{ $item->created_at ? date('Y-m-d H:i:s', strtotime($item->created_at)) : '' }}
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-link text-primary" type="button"
                                            onclick="toggleRow('jalrakshak-{{ $item->id }}')">Details</button>
                                        <button class="btn btn-sm btn-danger delete-inquiry" data-type="jal_rakshak"
                                            data-id="{{ $item->id }}">Delete</button>
                                    </td>
                                </tr>
                                <tr id="jalrakshak-{{ $item->id }}" style="display:none; background:#f9f9f9;">
                                    <td colspan="6">
                                        <strong>Water Saving Commitment:</strong> {{ $item->water_saving_commitment }}
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
            document.querySelectorAll('.delete-inquiry').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    if (!confirm('Are you sure you want to delete this entry?')) return;
                    var type = this.getAttribute('data-type');
                    var id = this.getAttribute('data-id');
                    var row = this.closest('tr');
                    var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    fetch("{{ route('lead-management.dashboard.delete-inquiry') }}", {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': token,
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                            },
                            body: JSON.stringify({
                                type: type,
                                id: id
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                var detailsRow = row.nextElementSibling;
                                if (detailsRow && detailsRow.style && detailsRow.style.display !== undefined) {
                                    detailsRow.remove();
                                }
                                row.remove();
                            } else {
                                alert('Failed to delete.');
                            }
                        })
                        .catch(() => alert('Failed to delete.'));
                });
            });
        });
    </script>
@endsection

