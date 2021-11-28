<header class="version_1">
    <div class="layer"></div><!-- Mobile menu overlay mask -->
    <div class="main_header">
        <div class="container">
            <div class="row small-gutters">
                <div class="col-xl-3 col-lg-3 d-lg-flex align-items-center">
                    <div id="logo">
                        <a href="{!! route('frontend.home') !!}"><img src="{{ asset($system_website_information->logo) }}" alt="" width="100" height="35"></a>
                    </div>
                </div>
                <nav class="col-xl-6 col-lg-7">
                    <a class="open_close" href="javascript:void(0);">
                        <div class="hamburger hamburger--spin">
                            <div class="hamburger-box">
                                <div class="hamburger-inner"></div>
                            </div>
                        </div>
                    </a>
                    <!-- Mobile menu button -->
                    <div class="main-menu">
                        <div id="header_menu">
                            <a href="{!! route('frontend.home') !!}"><img src="{!! asset('assets/frontend/img/') !!}/logo_black.svg" alt="" width="100" height="35"></a>
                            <a href="#" class="open_close" id="close_in"><i class="ti-close"></i></a>
                        </div>
                        <ul>
                            <li class=""    >
                                <a href="{!! route('frontend.home') !!}" class="">Home</a>

                            </li>
                            <li class="">
                                <a href="{!! route('frontend.faq') !!}" class="">FAQ</a>

                                <!-- /menu-wrapper -->
                            </li>
                            <li class="">
                                <a href="{!! route('frontend.privacy-and-policy') !!}" class="">Privacy & Policy</a>

                            </li>

                            <li>
                                <a href="{{route('frontend.page.contact-us')}}">Contact Us</a>
                            </li>
                        </ul>
                    </div>
                    <!--/main-menu -->
                </nav>
                <div class="col-xl-3 col-lg-2 d-lg-flex align-items-center justify-content-end text-right">
                    <a class="phone_top" href="tel://9438843343"><strong><span>Need Help?</span>+94 423-23-221</strong></a>
                </div>
            </div>
            <!-- /row -->
        </div>
    </div>
    <!-- /main_header -->

    <div class="main_nav Sticky">
        <div class="container">
            <div class="row small-gutters">
                <div class="col-xl-3 col-lg-3 col-md-3">
                    <nav class="categories">
                        <ul class="clearfix">
                            <li><span>
										<a href="#">
											<span class="hamburger hamburger--spin">
												<span class="hamburger-box">
													<span class="hamburger-inner"></span>
												</span>
											</span>
											Categories
										</a>
									</span>
                                <div id="menu">
                                    <ul>
                                        @if(!empty($system_product_categories))
                                            @foreach($system_product_categories as $system_category)
                                                <li><span><a href="{!! route('frontend.category-products', ['category_slug' => $system_category->slug]) !!}">{!! $system_category->title !!}</a></span>
                                                    @if(count($system_category->childs) > 0)
                                                        <ul>
                                                            @foreach($system_category->childs as $child_system_category)
                                                                <li><a href="{!! route('frontend.category-products', ['category_slug' => $system_category->slug, 'sub_category_slug' => $child_system_category->slug]) !!}">{!! $child_system_category->title !!}</a></li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="col-xl-6 col-lg-7 col-md-6 d-none d-md-block">
                    <form action="{!! route('frontend.search-products') !!}" method="GET">
                        <div class="custom-search-input">
                            <input type="text" placeholder="Search over 10.000 products" name="q" value="{!! request()->q !!}">
                            <button type="submit"><i class="header-icon_search_custom"></i></button>
                        </div>
                    </form>
                </div>
                <div class="col-xl-3 col-lg-2 col-md-3">
                    <ul class="top_tools">
                        <li>
                            <div class="dropdown dropdown-cart">
                                <a href="{{route('frontend.viewcart')}}" class="cart_bt"><strong  id="top-cart-content-qty">0</strong></a>
                                <div class="dropdown-menu" id="top-cart-content-wrapper">

                                </div>
                            </div>
                            <!-- /dropdown-cart-->
                        </li>
                        <li>
                            <a href="#0" class="wishlist"><span>Wishlist</span></a>
                        </li>
                        <li>
                            <div class="dropdown dropdown-access">
                                <a href="{!! route('frontend.user.profile') !!}" class="access_link"><span>Account</span></a>
                                <div class="dropdown-menu">
                                    @if(!auth()->guard('customer')->check())
                                        <a href="javascript:void(0)" class="btn_1" data-toggle="modal" data-target="#signInModal">Sign In or Sign Up</a>
                                    @endif
                                    <ul>
                                        @if(auth()->guard('customer')->check())
                                            {{--<li>
                                                <a href="track-order.html"><i class="ti-truck"></i>Track your Order</a>
                                            </li>--}}
                                            <li>
                                                <a href="{{ route('frontend.user.my-orders') }}"><i class="ti-package"></i>My Orders</a>
                                            </li>

                                            <li>
                                                <a href="{!! route('frontend.user.profile') !!}"><i class="ti-user"></i>My Profile</a>
                                            </li>
                                        @endif
                                        <li>
                                            <a href="help.html"><i class="ti-help-alt"></i>Help and Faq</a>
                                        </li>
                                        @if(auth()->guard('customer')->check())
                                            <li>
                                                <a href="{{ route('frontend.logout') }}"><i class="ti-export"></i>Logout</a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <!-- /dropdown-access-->
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="btn_search_mob"><span>Search</span></a>
                        </li>
                        <li>
                            <a href="#menu" class="btn_cat_mob">
                                <div class="hamburger hamburger--spin" id="hamburger">
                                    <div class="hamburger-box">
                                        <div class="hamburger-inner"></div>
                                    </div>
                                </div>
                                Categories
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /row -->
        </div>
        <div class="search_mob_wp">
            <form action="{!! route('frontend.search-products') !!}" method="GET">
                <input type="text" class="form-control" placeholder="Search over 10.000 products" name="q" value="{!! request()->q !!}">
                <input type="submit" class="btn_1 full-width" value="Search">
            </form>
        </div>
        <!-- /search_mobile -->
    </div>
    <!-- /main_nav -->
</header>
