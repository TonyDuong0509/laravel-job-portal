<section class="section-box subscription_box">
    <div class="container">
        <div class="box-newsletter">
            <div class="newsletter_textarea">
                <div class="row">
                    <div class="col-lg-6">
                        <h2 class="text-md-newsletter">Subscribe our newsletter</h2>
                    </div>
                    <div class="col-lg-6">
                        <div class="box-form-newsletter">
                            <form class="form-newsletter" method="POST" action="">
                                @csrf
                                <input class="input-newsletter" type="email" name="email"
                                    placeholder="Enter your email here">
                                <button type="submit"
                                    class="btn btn-default font-heading newsletter-btn">Subscribe</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<footer class="footer pt-165">
    <div class="container">
        <div class="row justify-content-between">
            <div class="footer-col-1 col-md-3 col-sm-12">
                <a class="footer_logo" href="{{ url('/') }}">
                    <img alt="joblist" src="{{ asset('frontend/assets/imgs/template/logo_2.png') }}">
                </a>
                <div class="mt-20 mb-20 font-xs color-text-paragraph-2">joblist is the heart of the design community and
                    the
                    best resource to discover and connect with designers and jobs worldwide.
                </div>
                <div class="footer-social">
                    <a class="icon-socials icon-facebook" href="https://www.facebook.com/duonganh.hao.96"
                        target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <a class="icon-socials icon-linkedin" href="https://www.instagram.com/_francis.duong/"
                        target="_blank"><i class="fab fa-instagram"></i></a>
                    <a class="icon-socials icon-twitter" href="https://x.com/DngAnhHo7" target="_blank"><i
                            class="fab fa-twitter"></i></a>
                </div>
            </div>
            <div class="footer-col-2 col-md-2 col-xs-6">
                <h6 class="mb-20">Resources</h6>
                <ul class="menu-footer">
                    <li><a href="#">About us</a></li>
                    <li><a href="#">Our Team</a></li>
                    <li><a href="#">Products</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
            <div class="footer-col-3 col-md-2 col-xs-6">
                <h6 class="mb-20">Community</h6>
                <ul class="menu-footer">
                    <li><a href="#">Feature</a></li>
                    <li><a href="#">Pricing</a></li>
                    <li><a href="#">Credit</a></li>
                    <li><a href="#">FAQ</a></li>
                </ul>
            </div>
            <div class="footer-col-4 col-md-2 col-xs-6">
                <h6 class="mb-20">Quick links</h6>
                <ul class="menu-footer">
                    <li><a href="#">iOS</a></li>
                    <li><a href="#">Android</a></li>
                    <li><a href="#">Microsoft</a></li>
                    <li><a href="#">Desktop</a></li>
                </ul>
            </div>
            <div class="footer-col-5 col-md-2 col-xs-6">
                <h6 class="mb-20">More</h6>
                <ul class="menu-footer">
                    <li><a href="#">Privacy</a></li>
                    <li><a href="#">Help</a></li>
                    <li><a href="#">Terms</a></li>
                    <li><a href="#">FAQ</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom mt-50">
            <div class="row">
                <div class="col-md-6"><span class="font-xs color-text-paragraph">Copyright &copy; 2025.</span></div>
                <div class="col-md-6 text-md-end text-start">
                    <div class="footer-social"><a class="font-xs color-text-paragraph" href="#">Privacy
                            Policy</a><a class="font-xs color-text-paragraph mr-30 ml-30" href="#">Terms &amp;
                            Conditions</a><a class="font-xs color-text-paragraph" href="#">Security</a></div>
                </div>
            </div>
        </div>
    </div>
</footer>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.form-newsletter').on('submit', function(event) {
                event.preventDefault();
                let formData = $(this).serialize();
                let button = $('.newsletter-btn');
                $.ajax({
                    type: "POST",
                    url: "{{ route('newsletter.store') }}",
                    data: formData,
                    beforeSend: function() {
                        button.text('Processing...');
                        button.prop('disabled', true);
                    },
                    success: function(response) {
                        button.text('Subscribe');
                        button.prop('disabled', false);
                        $('.form-newsletter').trigger('reset');
                        notyf.success(response.message);
                    },
                    error: function(xhr, status, error) {
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function(indexInArray, valueOfElement) {
                            notyf.error(valueOfElement[0]);
                        });
                        button.text('Subscribe');
                        button.prop('disabled', false);
                    }
                });
            });
        });
    </script>
@endpush
