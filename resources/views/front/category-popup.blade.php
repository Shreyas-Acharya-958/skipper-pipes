<div class="modal fade" id="categoryBrochurePopup" tabindex="-1" role="dialog" aria-labelledby="categoryBrochurePopupTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered brochure-modal-dialog" role="document">
        <div class="modal-content brochure-modal-content">
            <button type="button" class="close brochure-popup-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <div class="brochure-popup-inner">
                <div id="categoryBrochureFormSection">
                    <h3 id="categoryBrochurePopupTitle">Get Access to Our Skipper Pipes <span class="typeofbrchure" style="display:inline-flex"></span> Brochure <span>Fill Out the Form Below!</span></h3>
                    <form id="categoryBrochureForm" class="product-brochure-form" action="{{ route('front.categories.save-inquiry-brochure', $productCategory->slug) }}" method="POST">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="product_category_id" value="{{ $productCategory->id }}">
                            <input type="hidden" name="brochure_type" id="category_inquiry_brochure_type">
                            <input type="text" name="website" tabindex="-1" autocomplete="off" style="display:none;">
                            <div class="col-md-6"><div class="form-group"><input type="text" class="form-control" autocomplete="none" name="name" placeholder="Name *" required></div></div>
                            <div class="col-md-6"><div class="form-group"><input type="email" class="form-control" autocomplete="none" name="email" placeholder="Email"></div></div>
                            <div class="col-md-6"><div class="form-group"><input type="tel" class="form-control" autocomplete="none" name="mobile" placeholder="Mobile Number *" required></div></div>
                            <div class="col-md-6"><div class="form-group"><input type="text" class="form-control" autocomplete="none" name="pincode" placeholder="Pincode *" required></div></div>
                        </div>
                        <div class="text-center"><button type="submit" class="brochure-submit-btn">Submit</button></div>
                    </form>
                </div>
                <div id="categoryBrochureThankYouSection" style="display:none">
                    <h3>Thank You!</h3>
                    <p>Thank you for filling the form. Here is the brochure link to download.</p>
                    <div class="text-center"><a id="categoryBrochureDownload" class="btn effect btn-md brochure-download-btn" href="#" download>Download Brochure</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
