<div class="modal fade" id="productBrochurePopup" tabindex="-1" role="dialog" aria-labelledby="productBrochurePopupTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered brochure-modal-dialog" role="document">
        <div class="modal-content brochure-modal-content">
            <button type="button" class="close brochure-popup-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <div class="brochure-popup-inner">
                <div id="brochureFormSection">
                    <h3 id="productBrochurePopupTitle"> Get Access to Our Skipper Pipes Product Brochure <span>Fill Out the Form Below!</span> </h3>
                    <form id="productBrochureForm" class="product-brochure-form" action="{{  route('front.products.save-inquiry-brochure',['slug'=>$product->slug]) }}" method="POST">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="product_id" id="inquiry_product_id">
                            <input type="hidden" name="brochure_type" id="inquiry_brochure_type">
                            <input type="text" name="website" tabindex="-1" autocomplete="off" style="display:none;">
                            <div class="col-md-6"><div class="form-group"><input type="text" class="form-control" autocomplete="none" name="name" placeholder="Name *" required> </div></div>
                            <div class="col-md-6"><div class="form-group"><input type="email" class="form-control" autocomplete="none" name="email" placeholder="Email" > </div></div>
                            <div class="col-md-6"><div class="form-group"><input type="tel" class="form-control" autocomplete="none" name="mobile" placeholder="Mobile Number *" required> </div></div>
                            <div class="col-md-6"><div class="form-group"><input type="text"  class="form-control" autocomplete="none" name="pincode" placeholder="Pincode *" required></div></div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="brochure-submit-btn"> Submit </button>
                        </div>
                    </form>
                </div>
                <div id="brochureThankYouSection" style="display: none;">
                    <h3>Thank You!</h3>
                    <p> Thank you for filling the form. Here is the Product Brochure link to download. </p>
                    <div class="text-center">
                        <a class="btn effect btn-md brochure-download-btn"
                            href="#"
                            data-file-name="{{ $product->brochure }}"
                            download>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
