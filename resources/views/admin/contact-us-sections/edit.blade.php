@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid" style="padding: 20px;">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Contact Us Sections</h4>
            </div>
            <div class="card-body">
                <form id="contactUsSectionForm" action="{{ route('admin.contact-us-sections.update') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-group mb-3">
                        <label for="section1" class="form-label">Section 1 Content</label>
                        <textarea class="form-control tinymce" id="section1" name="section1" rows="6">{{ old('section1', $contactUsSection->section1 ?? '') }}</textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="section2" class="form-label">Section 2 Content</label>
                        <textarea class="form-control tinymce" id="section2" name="section2" rows="6">{{ old('section2', $contactUsSection->section2 ?? '') }}</textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="section3" class="form-label">Section 3 Content</label>
                        <textarea class="form-control tinymce" id="section3" name="section3" rows="6">{{ old('section3', $contactUsSection->section3 ?? '') }}</textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="section4" class="form-label">Section 4 Content</label>
                        <textarea class="form-control tinymce" id="section4" name="section4" rows="6">{{ old('section4', $contactUsSection->section4 ?? '') }}</textarea>
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> Save All Sections
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.1.1/tinymce.min.js"></script>
    <script>
        $(document).ready(function() {
            ['section1', 'section2', 'section3', 'section4'].forEach(editor => {
                tinymce.init({
                    selector: `#${editor}`,
                    height: 200,
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
        });
    </script>
@endpush
