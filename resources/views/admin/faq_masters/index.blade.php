@extends('admin.layouts.app')

@section('styles')
    <style>
        .faq-list-item {
            border: 1px solid #e9ecef;
            margin-bottom: 10px;
            border-radius: 8px;
            background: #fff;
        }

        .faq-list-item:hover {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .faq-header {
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px 8px 0 0;
            border-bottom: 1px solid #e9ecef;
        }

        .faq-content {
            padding: 15px;
        }

        .faq-actions {
            padding: 10px 15px;
            background: #f8f9fa;
            border-radius: 0 0 8px 8px;
            border-top: 1px solid #e9ecef;
        }

        .btn-icon {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            border-radius: 0.2rem;
        }

        .status-badge {
            font-size: 0.75rem;
            padding: 0.25em 0.6em;
            border-radius: 10px;
        }

        .sequence-badge {
            font-size: 0.75rem;
            padding: 0.25em 0.6em;
            background: #e9ecef;
            border-radius: 10px;
            color: #495057;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">FAQ Masters</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <form id="searchForm" method="GET" action="{{ url()->current() }}" class="d-flex"
                            style="max-width: 400px;">
                            <input type="text" name="search" class="form-control me-2" placeholder="Search..."
                                value="{{ request('search') }}">
                        </form>
                        <a href="{{ route('admin.faq_masters.create') }}" class="btn btn-warning">
                            <i class="fas fa-plus"></i> Add New FAQ Master
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>FAQs Count</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($faqMasters as $faqMaster)
                                    <tr>
                                        <td>{{ $faqMaster->id }}</td>
                                        <td>{{ $faqMaster->title }}</td>
                                        <td>
                                            <span class="badge bg-info">
                                                {{ $faqMaster->faq_lists_count }} FAQs
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="javascript:void(0)" class="btn btn-info btn-sm me-2"
                                                    title="Manage FAQs"
                                                    onclick="openFaqListModal({{ $faqMaster->id }}, '{{ $faqMaster->title }}')">
                                                    <i class="fas fa-list"></i> Manage FAQs
                                                    ({{ $faqMaster->faq_lists_count }})
                                                </a>
                                                <a href="{{ route('admin.faq_masters.edit', $faqMaster) }}"
                                                    class="btn btn-warning btn-sm me-2" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.faq_masters.destroy', $faqMaster) }}"
                                                    method="POST" class="d-inline delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $faqMasters->withQueryString()->links('vendor.pagination.bootstrap-5-always') }}
                </div>
            </div>
        </div>
    </div>

    <!-- FAQ List Modal -->
    <div class="modal fade" id="faqListModal" tabindex="-1" aria-labelledby="faqListModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="faqListModalLabel">Manage FAQs</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-4">
                        <button type="button" class="btn btn-success" onclick="showAddFaqForm()">
                            <i class="fas fa-plus"></i> Add New FAQ
                        </button>
                    </div>

                    <!-- Add/Edit FAQ Form -->
                    <div id="faqForm" class="mb-4" style="display: none;">
                        <div class="card border-primary">
                            <div class="card-header bg-primary text-white">
                                <h5 class="card-title mb-0" id="formTitle">Add New FAQ</h5>
                            </div>
                            <div class="card-body">
                                <form id="faqSubmitForm" onsubmit="saveFaq(event)">
                                    <input type="hidden" id="faqId" name="id">
                                    <input type="hidden" id="faqMasterId" name="faq_master_id">

                                    <div class="mb-3">
                                        <label for="question" class="form-label">Question</label>
                                        <input type="text" class="form-control" id="question" name="question" required>
                                        <div class="invalid-feedback" id="questionError"></div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="answer" class="form-label">Answer</label>
                                        <textarea class="form-control" id="answer" name="answer" rows="4" required></textarea>
                                        <div class="invalid-feedback" id="answerError"></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="sequence" class="form-label">Sequence</label>
                                                <input type="number" class="form-control" id="sequence"
                                                    name="sequence" value="0" min="0" required>
                                                <div class="invalid-feedback" id="sequenceError"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label d-block">Status</label>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="status"
                                                        name="status" checked>
                                                    <label class="form-check-label" for="status">Active</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-end">
                                        <button type="button" class="btn btn-secondary"
                                            onclick="hideFaqForm()">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Save FAQ</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ List -->
                    <div id="faqList">
                        <!-- FAQs will be loaded here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let currentFaqMasterId = null;

        // Initialize delete confirmations
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                if (confirm('Are you sure you want to delete this FAQ Master?')) {
                    this.submit();
                }
            });
        });

        function openFaqListModal(faqMasterId, title) {
            currentFaqMasterId = faqMasterId;
            $('#faqListModalLabel').text('Manage FAQs - ' + title);
            $('#faqMasterId').val(faqMasterId);
            loadFaqs(faqMasterId);
            $('#faqListModal').modal('show');
        }

        function loadFaqs(faqMasterId) {
            $.ajax({
                url: `/admin/faq-masters/${faqMasterId}/faqs`,
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    let html = '';
                    if (response.length === 0) {
                        html =
                            '<div class="text-center text-muted py-4">No FAQs found. Click "Add New FAQ" to create one.</div>';
                    } else {
                        response.forEach(faq => {
                            html += `
                            <div class="faq-list-item">
                                <div class="faq-header d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0">${faq.question}</h6>
                                    <div>
                                        <span class="sequence-badge me-2">Sequence: ${faq.sequence}</span>
                                        <span class="status-badge ${faq.status ? 'bg-success' : 'bg-danger'}">${faq.status ? 'Active' : 'Inactive'}</span>
                                    </div>
                                </div>
                                <div class="faq-content">
                                    <p class="mb-0">${faq.answer}</p>
                                </div>
                                <div class="faq-actions text-end">
                                    <button class="btn btn-warning btn-sm me-2" onclick='editFaq(${JSON.stringify(faq).replace(/"/g, "&quot;")})'>
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button class="btn btn-danger btn-sm" onclick="deleteFaq(${faq.id})">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </div>
                            </div>
                        `;
                        });
                    }
                    $('#faqList').html(html);
                },
                error: function(xhr) {
                    toastr.error('Error loading FAQs');
                }
            });
        }

        function showAddFaqForm() {
            $('#formTitle').text('Add New FAQ');
            $('#faqId').val('');
            $('#faqSubmitForm')[0].reset();
            $('#status').prop('checked', true);
            clearValidationErrors();
            $('#faqForm').slideDown();
        }

        function hideFaqForm() {
            $('#faqForm').slideUp();
            clearValidationErrors();
        }

        function clearValidationErrors() {
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').text('');
        }

        function editFaq(faq) {
            $('#formTitle').text('Edit FAQ');
            $('#faqId').val(faq.id);
            $('#question').val(faq.question);
            $('#answer').val(faq.answer);
            $('#sequence').val(faq.sequence);
            $('#status').prop('checked', faq.status);
            clearValidationErrors();
            $('#faqForm').slideDown();
            // Scroll to form
            $('#faqForm')[0].scrollIntoView({
                behavior: 'smooth'
            });
        }

        function saveFaq(event) {
            event.preventDefault();
            clearValidationErrors();

            const form = event.target;
            const formData = new FormData(form);
            const faqId = $('#faqId').val();

            // Convert form data to object
            const data = {
                question: formData.get('question'),
                answer: formData.get('answer'),
                sequence: formData.get('sequence'),
                status: formData.get('status') ? 1 : 0
            };

            const url = faqId ?
                `/admin/faq-masters/${currentFaqMasterId}/faqs/${faqId}` :
                `/admin/faq-masters/${currentFaqMasterId}/faqs`;

            $.ajax({
                url: url,
                method: faqId ? 'PUT' : 'POST',
                data: data,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    loadFaqs(currentFaqMasterId);
                    hideFaqForm();
                    toastr.success(faqId ? 'FAQ updated successfully' : 'FAQ created successfully');
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        Object.keys(errors).forEach(field => {
                            $(`#${field}`).addClass('is-invalid');
                            $(`#${field}Error`).text(errors[field][0]);
                        });
                    }
                    toastr.error('Error saving FAQ');
                }
            });
        }

        function deleteFaq(faqId) {
            if (!confirm('Are you sure you want to delete this FAQ?')) return;

            $.ajax({
                url: `/admin/faq-masters/${currentFaqMasterId}/faqs/${faqId}`,
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    loadFaqs(currentFaqMasterId);
                    toastr.success('FAQ deleted successfully');
                },
                error: function(xhr) {
                    toastr.error('Error deleting FAQ');
                }
            });
        }
    </script>
@endpush
