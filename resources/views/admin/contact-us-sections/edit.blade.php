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
                    keep_styles: true,

                    // Image upload configuration
                    images_upload_url: '{{ route('admin.upload.image') }}',
                    images_upload_handler: function(blobInfo, progress, failure) {
                        return new Promise(function(resolve, reject) {
                            var xhr, formData;
                            xhr = new XMLHttpRequest();
                            xhr.withCredentials = false;
                            xhr.open('POST', '{{ route('admin.upload.image') }}');

                            // Add CSRF token
                            xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                            xhr.setRequestHeader('Accept', 'application/json');

                            xhr.onload = function() {
                                var json;
                                if (xhr.status != 200) {
                                    reject('HTTP Error: ' + xhr.status + ' - ' + xhr
                                        .responseText);
                                    return;
                                }
                                try {
                                    json = JSON.parse(xhr.responseText);
                                    if (!json || typeof json.location != 'string') {
                                        reject('Invalid JSON: ' + xhr.responseText);
                                        return;
                                    }
                                    resolve(json.location);
                                } catch (e) {
                                    reject('Invalid JSON response: ' + xhr
                                        .responseText);
                                }
                            };

                            xhr.onerror = function() {
                                reject('Network error occurred');
                            };

                            formData = new FormData();
                            formData.append('file', blobInfo.blob(), blobInfo
                            .filename());
                            formData.append('_token', '{{ csrf_token() }}');

                            xhr.send(formData);
                        });
                    },

                    // Image upload settings
                    automatic_uploads: true,
                    file_picker_types: 'image',
                    images_upload_credentials: true,
                    images_reuse_filename: true,

                    // Image dialog settings
                    image_title: true,
                    image_description: false,
                    image_dimensions: true,
                    image_class_list: [{
                            title: 'Responsive',
                            value: 'img-fluid'
                        },
                        {
                            title: 'Thumbnail',
                            value: 'img-thumbnail'
                        },
                        {
                            title: 'Rounded',
                            value: 'rounded'
                        }
                    ]
                });
            });
        });
    </script>
@endpush
