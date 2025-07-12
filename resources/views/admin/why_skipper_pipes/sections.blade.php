<div class="col-md-12">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Item ${index + 1}</h5>
            <button type="button" class="btn btn-danger btn-sm remove-item">
                <i class="fas fa-trash"></i>
            </button>
        </div>
        <div class="card-body">
            <input type="hidden" name="sections[${index}][id]" value="">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="sections[${index}][title]" required>
