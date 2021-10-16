<footer class="footer appear-animate" data-animation-options="{
            'name': 'fadeIn'
        }">
    <div class="container">

        <div class="footer-top">
            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="widget widget-about">
                        <div class="widget-body">
                            <img src="/images/logo.png" alt="logo-footer" width="145"
                                 height="45"/>
                            <p class="widget-about-desc">

                                Emargaon Road,Near Kuba Mosjid, <br>
                                Keraniganj Dhaka-1310,<br>
                                Dhaka Division,Bangladesh


                            </p>
                            <label class="label-social d-block text-dark">Social Media</label>
                            <div class="social-icons social-icons-colored">
                                <a href="https://www.facebook.com/firebox.com.bd"
                                   class="social-icon social-facebook w-icon-facebook"></a>
                                <a href="#" class="social-icon social-twitter w-icon-twitter"></a>
                                <a href="#" class="social-icon social-instagram w-icon-instagram"></a>
                                <a href="#" class="social-icon social-youtube w-icon-youtube"></a>
                                <a href="#" class="social-icon social-pinterest w-icon-pinterest"></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-sm-6">
                    <div class="widget">
                        <h4 class="widget-title"> Got Question? Call us 24/7</h4>
                        {{--  <p class="widget-about-title">Got Question? Call us 24/7</p>--}}
                        <a href="tel:{{getPhone()}}" class="widget-about-call">{{getPhone()}}</a>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="widget">
                        <h4 class="widget-title">Links</h4>
                        <ul class="widget-body">
                            <li><a href="/about">About</a></li>
                            <li><a href="/contact-us">Contact Us</a></li>
                            <li><a href="/privacy-policy">Privacy Policy</a></li>
                            <li><a href="/return-policy">Return Policy</a></li>
                            <li><a href="/terms-condition">Term and Conditions</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="footer-left">
                <p class="copyright">Copyright © {{date('Y')}} Firebox. All Rights Reserved.</p>
            </div>
            <div class="footer-right">
                <span class="payment-label mr-lg-8">We're using safe payment for</span>
                <figure class="payment">
                    <img src="/images/ssl.png" alt="payment" width="559" height="25"/>
                </figure>
            </div>
        </div>
    </div>
</footer>
