<footer class="revealed">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <h3 data-target="#collapse_1">Quick Links</h3>
                <div class="collapse dont-collapse-sm links" id="collapse_1">
                    <ul>
                        <li><a href="{!! route('frontend.page.about-us') !!}">About us</a></li>
                        <li><a href="{!! route('frontend.faq') !!}">Faq</a></li>
                        <li><a href="{!! route('frontend.privacy-and-policy') !!}">Privacy and Policy</a></li>
                        <li><a href="help.html">Help</a></li>
                        <li><a href="account.html">My account</a></li>
                        <li><a href="blog.html">Blog</a></li>
                        <li><a href="{{route('frontend.page.contact-us')}}">Contacts</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h3 data-target="#collapse_2">Categories</h3>
                <div class="collapse dont-collapse-sm links" id="collapse_2">
                    <ul>
                        <li><a href="listing-grid-1-full.html">Clothes</a></li>
                        <li><a href="listing-grid-2-full.html">Electronics</a></li>
                        <li><a href="listing-grid-1-full.html">Furniture</a></li>
                        <li><a href="listing-grid-3.html">Glasses</a></li>
                        <li><a href="listing-grid-1-full.html">Shoes</a></li>
                        <li><a href="listing-grid-1-full.html">Watches</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h3 data-target="#collapse_3">Contacts</h3>
                <div class="collapse dont-collapse-sm contacts" id="collapse_3">
                    <ul>
                        <li><i class="ti-home"></i>97845 Baker st. 567<br>Los Angeles - US</li>
                        <li><i class="ti-headphone-alt"></i>+94 423-23-221</li>
                        <li><i class="ti-email"></i><a href="#0">info@allaia.com</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h3 data-target="#collapse_4">Keep in touch</h3>
                <div class="collapse dont-collapse-sm" id="collapse_4">
                    <div id="newsletter">
                        <div class="form-group">
                            <input type="email" name="email_newsletter" id="email_newsletter" class="form-control" placeholder="Your email">
                            <button type="submit" id="submit-newsletter"><i class="ti-angle-double-right"></i></button>
                        </div>
                    </div>
                    <div class="follow_us">
                        <h5>Follow Us</h5>
                        <ul>
                            <li><a href="#0"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="{!! asset('assets/frontend/img/') !!}/twitter_icon.svg" alt="" class="lazy"></a></li>
                            <li><a href="#0"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="{!! asset('assets/frontend/img/') !!}/facebook_icon.svg" alt="" class="lazy"></a></li>
                            <li><a href="#0"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="{!! asset('assets/frontend/img/') !!}/instagram_icon.svg" alt="" class="lazy"></a></li>
                            <li><a href="#0"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="{!! asset('assets/frontend/img/') !!}/youtube_icon.svg" alt="" class="lazy"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /row-->
        <hr>
        <div class="row add_bottom_25">
            <div class="col-lg-6">
                <ul class="footer-selector clearfix">
                    <li>
                        <div class="styled-select lang-selector">
                            <select>
                                <option value="English" selected>English</option>
                                <option value="French">French</option>
                                <option value="Spanish">Spanish</option>
                                <option value="Russian">Russian</option>
                            </select>
                        </div>
                    </li>
                    <li>
                        <div class="styled-select currency-selector">
                            <select>
                                <option value="US Dollars" selected>US Dollars</option>
                                <option value="Euro">Euro</option>
                            </select>
                        </div>
                    </li>
                    <li><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="{!! asset('assets/frontend/img/') !!}/cards_all.svg" alt="" width="198" height="30" class="lazy"></li>
                </ul>
            </div>
            <div class="col-lg-6">
                <ul class="additional_links">
                    <li><a href="#0">Terms and conditions</a></li>
                    <li><a href="#0">Privacy</a></li>
                    <li><span>© 2020 {{ config('app.name') }}</span></li>
                </ul>
            </div>
        </div>
    </div>
</footer>


<!-- Sign In Modal -->
<!-- Modal -->
<div id="signInModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal_header">
                <h4 class="modal-title">
                    Sign In
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </h4>

            </div>
            <div class="modal-body">
                <form action="{!! route('frontend.login') !!}" method="post">
                    @csrf
                    <div class="sign-in-wrapper">
                        <div id="login_wrapper">
                            <a href="#0" class="social_bt facebook">Login with Facebook</a>
                            <a href="#0" class="social_bt google">Login with Google</a>
                            <div class="divider"><span>Or</span></div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" id="email" value="{!! old('email') !!}" required>
                                {{--<i class="ti-email"></i>--}}
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" id="password" value="" required>
                                {{--<i class="ti-lock"></i>--}}
                            </div>
                            <div class="clearfix add_bottom_15">
                                <div class="checkboxes float-left">
                                    <label class="container_check">Remember me
                                        <input type="checkbox" name="remember" value="1">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="float-right mt-1"><a id="forgot" href="javascript:void(0);">Forgot Password?</a></div>
                            </div>
                            <div class="text-center">
                                <input type="submit" value="Log In" class="btn_1 full-width">
                                Don’t have an account? <a href="{!! route('frontend.login-register') !!}">Sign up</a>
                            </div>
                        </div>
                        <div id="forgot_pw">
                            <div class="form-group">
                                <label>Please confirm login email below</label>
                                <input type="email" class="form-control" name="email_forgot" id="email_forgot">
                                <i class="ti-email"></i>
                            </div>
                            <p>You will receive an email containing a link allowing you to reset your password to a new preferred one.</p>
                            <div class="text-center"><input type="submit" value="Reset Password" class="btn_1"></div>
                            <div class="float-right mt-1"><a id="back_login" href="javascript:void(0);">Back to login</a></div>
                        </div>
                    </div>
                </form>
                <!--form -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!-- /Sign In Modal -->
