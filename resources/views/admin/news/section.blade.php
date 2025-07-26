@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid" style="padding: 20px;">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">News Sections</h4>
                <a href="{{ url('/admin/company') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Pages
                </a>
            </div>
            <div class="card-body">
                {{-- @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif --}}

                <!-- Nav tabs -->
                <ul class="nav nav-tabs mb-3" id="newsSectionTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="head-tab" data-bs-toggle="tab" data-bs-target="#head" type="button"
                            role="tab">
                            Head part
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="section2-tab" data-bs-toggle="tab" data-bs-target="#section2"
                            type="button" role="tab">
                            Main Part(Banner)
                        </button>
                    </li>
                </ul>

                <!-- Tab content -->
                <div class="tab-content" id="newsSectionTabsContent">
                    <div class="tab-pane fade p-3" id="head" role="tabpanel">
                        <div>
                            <span class="fw-bold">Information:</span> News Head Section
                        </div>
                        <form id="headForm" class="section-form" action="{{ route('admin.news.section1.save') }}"
                            method="POST">
                            @csrf
                            <input type="hidden" name="active_tab" value="#head">
                            <div class="d-flex justify-content-end mb-3">
                                <button type="button" class="btn btn-primary me-2 edit-btn">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <button type="submit" class="btn btn-success save-btn" style="display: none;">
                                    <i class="fas fa-save"></i> Save
                                </button>
                            </div>
                            <div class="form-group mb-3">
                                <label for="head_title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="head_title" name="title"
                                    value="{{ $newsSectionOne->title ?? '' }}" readonly>
                            </div>
                            <div class="form-group mb-3">
                                <label for="head_description" class="form-label">Description</label>
                                <textarea class="form-control tinymce" id="head_description" name="description" rows="6" readonly>{{ $newsSectionOne->description ?? '' }}</textarea>
                            </div>
                        </form>
                    </div>
                    <!-- Section 2: Main Part (Banner) -->
                    <div class="tab-pane fade show active p-3" id="section2" role="tabpanel">
                        <div>
                            <span class="fw-bold">Information:</span> News Main Section
                        </div>
                        <form id="section2Form" class="section-form" action="{{ route('admin.news.section2.save') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="active_tab" value="#section2">

                            <div class="d-flex justify-content-end mb-3">
                                <button type="button" class="btn btn-primary me-2 edit-btn">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <button type="submit" class="btn btn-success save-btn" style="display: none;">
                                    <i class="fas fa-save"></i> Save
                                </button>
                            </div>

                            <div class="form-group mb-3">
                                <label for="section2_title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="section2_title" name="title"
                                    value="{{ $newsSectionTwo->title ?? '' }}" readonly>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Image</label>
                                <div class="mb-2">
                                    @if (isset($newsSectionTwo) && $newsSectionTwo->image)
                                        <div class="position-relative d-inline-block">
                                            <img src="{{ asset('storage/' . $newsSectionTwo->image) }}"
                                                alt="Section Two Image" style="max-width: 200px; height: auto;">
                                        </div>
                                    @endif
                                </div>
                                <input type="file" class="form-control" name="image" accept="image/*,.svg" disabled>
                            </div>

                            <div class="form-group mb-3">
                                <label for="section2_description" class="form-label">Description</label>
                                <textarea class="form-control tinymce" id="section2_description" name="description" rows="6" readonly>{{ $newsSectionTwo->description ?? '' }}</textarea>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.1.1/tinymce.min.js"></script>
        <script>
            $(document).ready(function() {
                // Get the tab ID from URL hash or localStorage
                let activeTab = window.location.hash;
                if (!activeTab) {
                    activeTab = localStorage.getItem('activeNewsSectionTab') || '#section2';
                }

                // Show the active tab
                $(`button[data-bs-target="${activeTab}"]`).tab('show');

                // Store the active tab when tab is changed
                $('#newsSectionTabs button[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
                    const targetTab = $(e.target).data('bs-target');
                    localStorage.setItem('activeNewsSectionTab', targetTab);
                    window.location.hash = targetTab;
                });

                // Initialize TinyMCE for all textareas with class 'tinymce'
                const editors = ['section2_description', 'head_description'];
                editors.forEach(editor => {
                    tinymce.init({
                        selector: `#${editor}`,
                        height: 300,
                        menubar: false,
                        plugins: 'lists link image code',
                        toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist | link image | code',
                        verify_html: false,
                        cleanup: false,
                        valid_elements: '*[*]',
                        extended_valid_elements: '*[*]',
                        valid_children: '+*[*]',
                        preserve_cdata: true,
                        entity_encoding: 'raw',
                        force_br_newlines: false,
                        force_p_newlines: false,
                        forced_root_block: '',
                        keep_styles: true
                    });
                });

                // Edit button click handler
                $('.edit-btn').click(function() {
                    const form = $(this).closest('form');
                    form.find('input:not([type="hidden"]), textarea:not(.tinymce), select').removeAttr(
                        'readonly disabled');
                    form.find('.save-btn').show();
                    $(this).hide();

                    // Enable TinyMCE editors
                    editors.forEach(editor => {
                        const tinyEditor = tinymce.get(editor);
                        if (tinyEditor) {
                            tinyEditor.mode.set('design');
                        }
                    });
                });

                // Handle form submission
                $('.section-form').on('submit', function() {
                    // Enable all fields before submit
                    $(this).find('input:not([type="hidden"]), textarea, select').removeAttr(
                        'readonly disabled');

                    // Get TinyMCE content
                    $(this).find('.tinymce').each(function() {
                        const editor = tinymce.get($(this).attr('id'));
                        if (editor) {
                            $(this).val(editor.getContent());
                        }
                    });

                    // Update active tab
                    const activeTab = localStorage.getItem('activeNewsSectionTab') || '#section2';
                    $(this).find('input[name="active_tab"]').val(activeTab);
                });
            });
        </script>
    @endpush
@endsection
