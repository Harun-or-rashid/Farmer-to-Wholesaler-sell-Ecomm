
@extends('frontend.layouts.master')

@section('main_content')

    <main>
        <div class="container margin_30">
            {{--<div class="countdown_inner">
                -20% This offer ends in
                <div data-countdown="2022/05/15" class="countdown"></div>
            </div>--}}
            <div class="row">
                <div class="col-md-6">
                    <div class="all">
                        <div class="slider">
                            <div class="owl-carousel owl-theme main">
                                @if(!empty($product->images))
                                    @foreach($product->images as $product_image)
                                        <div style="background-image: url({!! asset($product_image->image) !!});" class="item-box"></div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="left nonl"><i class="ti-angle-left"></i></div>
                            <div class="right"><i class="ti-angle-right"></i></div>
                        </div>
                        <div class="slider-two">
                            <div class="owl-carousel owl-theme thumbs">
                                @if(!empty($product->images))
                                    @foreach($product->images as $product_image)
                                        <div style="background-image: url({!! asset($product_image->image) !!});" class="item {!! ($loop->first)? 'active':'' !!}"></div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="left-t nonl-t"></div>
                            <div class="right-t"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="{!! route('frontend.home') !!}">Home</a></li>
                            <li><a href="#">{!! $product->category->title !!}</a></li>
                            <li>{!! $product->title !!}</li>
                        </ul>
                    </div>
                    <!-- /page_header -->
                    <div class="prod_info">
                        <h1>{!! $product->title !!}</h1>
                        <span class="rating">
                            <i class="icon-star voted"></i>
                            <i class="icon-star voted"></i>
                            <i class="icon-star voted"></i>
                            <i class="icon-star voted"></i>
                            <i class="icon-star"></i>
                            <em>4 reviews</em>
                        </span>
                        {!! $product->quick_text !!}
                        <br>
                        <br>
                        @if($product->emi_available == 1)
                            <span class="text-primary">
                                EMI available in this product.
                            </span>
                        @endif

                        <div class="prod_options">
                            @if(count($available_product_colors) > 0)
                                <div class="row">
                                    <label class="col-xl-5 col-lg-5  col-md-6 col-6 pt-0"><strong>Color</strong></label>
                                    <div class="col-xl-4 col-lg-5 col-md-6 col-6 colors">
                                        <ul>
                                            @foreach($available_product_colors as $color)
                                                <li>
                                                    <label for="color_input">
                                                        <a href="javascript:void(0)" onclick="setColorValue({!! $color->id !!})" style="background-color: {!! $color->color_code !!};" class="color {!! ($loop->first)?'':'' !!}"></a>
                                                    </label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <input type="hidden" name="color_input" id="color_input" required>
                            @else
                                <input type="hidden" name="color_input" id="color_input" value="0" required>
                            @endif
                            <div class="row">
                                <label class="col-xl-5 col-lg-5  col-md-6 col-6"><strong>Quantity</strong></label>
                                <div class="col-xl-4 col-lg-5 col-md-6 col-6">
                                    <div class="numbers-row">
                                        <input type="text" value="1" id="quantity_1" class="qty2" name="qty">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5 col-md-6">
                                <div class="price_main">
                                    <span class="new_price"><span class="currency">৳</span>{!! $product->sell_price !!}</span>
                                    @if($product->sell_price != $product->product_price)
                                        <span class="percentage">-{!! number_format(100 / ($product->product_price / ($product->product_price - $product->sell_price)),1) !!}%</span>
                                        <span class="old_price"><span class="currency">৳</span>{!! $product->product_price !!}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                @if(!empty($product->stockAvailability))
                                    <div class="xbtn_add_to_cart"><a href="javascript:void(0)" class="btn_1 btn-block" onclick="addToCart({!! $product->id !!})">Add to Cart</a></div>
                                @else
                                    <span>Stock is empty</span>
                                    <div class="xbtn_add_to_cart"><a href="{!! route('frontend.place-pre-order', ['product_id'=>$product->id,'quantity' => 1]) !!}" class="btn_1 btn-block">Place an pre order</a></div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- /prod_info -->
                    <div class="product_actions">
                        <ul>
                            <li>
                                <a href="#"><i class="ti-heart"></i><span>Add to Wishlist</span></a>
                            </li>
                        </ul>
                    </div>
                    <!-- /product_actions -->
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->

        <div class="tabs_product">
            <div class="container">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a id="tab-A" href="#pane-A" class="nav-link active" data-toggle="tab" role="tab">Description</a>
                    </li>
                    <li class="nav-item">
                        <a id="tab-B" href="#pane-B" class="nav-link" data-toggle="tab" role="tab">Reviews</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /tabs_product -->
        <div class="tab_content_wrapper">
            <div class="container">
                <div class="tab-content" role="tablist">
                    <div id="pane-A" class="card tab-pane fade active show" role="tabpanel" aria-labelledby="tab-A">
                        <div class="card-header" role="tab" id="heading-A">
                            <h5 class="mb-0">
                                <a class="collapsed" data-toggle="collapse" href="#collapse-A" aria-expanded="false" aria-controls="collapse-A">
                                    Description
                                </a>
                            </h5>
                        </div>
                        <div id="collapse-A" class="collapse" role="tabpanel" aria-labelledby="heading-A">
                            <div class="card-body">
                                <div class="row justify-content-between">
                                    <div class="col-lg-12">
                                        {!! $product->product_details !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /TAB A -->
                    <div id="pane-B" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-B">
                        <div class="card-header" role="tab" id="heading-B">
                            <h5 class="mb-0">
                                <a class="collapsed" data-toggle="collapse" href="#collapse-B" aria-expanded="false" aria-controls="collapse-B">
                                    Reviews
                                </a>
                            </h5>
                        </div>
                        <div id="collapse-B" class="collapse" role="tabpanel" aria-labelledby="heading-B">
                            <div class="card-body">
                                <div class="row justify-content-between">
                                    <div class="col-lg-6">
                                        <div class="review_content">
                                            <div class="clearfix add_bottom_10">
                                                <span class="rating"><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><em>5.0/5.0</em></span>
                                                <em>Published 54 minutes ago</em>
                                            </div>
                                            <h4>"Commpletely satisfied"</h4>
                                            <p>Eos tollit ancillae ea, lorem consulatu qui ne, eu eros eirmod scaevola sea. Et nec tantas accusamus salutatus, sit commodo veritus te, erat legere fabulas has ut. Rebum laudem cum ea, ius essent fuisset ut. Viderer petentium cu his.</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="review_content">
                                            <div class="clearfix add_bottom_10">
                                                <span class="rating"><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star empty"></i><i class="icon-star empty"></i><em>4.0/5.0</em></span>
                                                <em>Published 1 day ago</em>
                                            </div>
                                            <h4>"Always the best"</h4>
                                            <p>Et nec tantas accusamus salutatus, sit commodo veritus te, erat legere fabulas has ut. Rebum laudem cum ea, ius essent fuisset ut. Viderer petentium cu his.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- /row -->
                                <div class="row justify-content-between">
                                    <div class="col-lg-6">
                                        <div class="review_content">
                                            <div class="clearfix add_bottom_10">
                                                <span class="rating"><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star empty"></i><em>4.5/5.0</em></span>
                                                <em>Published 3 days ago</em>
                                            </div>
                                            <h4>"Outstanding"</h4>
                                            <p>Eos tollit ancillae ea, lorem consulatu qui ne, eu eros eirmod scaevola sea. Et nec tantas accusamus salutatus, sit commodo veritus te, erat legere fabulas has ut. Rebum laudem cum ea, ius essent fuisset ut. Viderer petentium cu his.</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="review_content">
                                            <div class="clearfix add_bottom_10">
                                                <span class="rating"><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><em>5.0/5.0</em></span>
                                                <em>Published 4 days ago</em>
                                            </div>
                                            <h4>"Excellent"</h4>
                                            <p>Sit commodo veritus te, erat legere fabulas has ut. Rebum laudem cum ea, ius essent fuisset ut. Viderer petentium cu his.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- /row -->
                                <p class="text-right"><a href="leave-review.html" class="btn_1">Leave a review</a></p>
                            </div>
                            <!-- /card-body -->
                        </div>
                    </div>
                    <!-- /tab B -->
                </div>
                <!-- /tab-content -->
            </div>
            <!-- /container -->
        </div>
        <!-- /tab_content_wrapper -->

        <div class="container margin_60_35">
            <div class="main_title">
                <h2>Related</h2>
                <span>Products</span>
                <p>Cum doctus civibus efficiantur in imperdiet deterruisset.</p>
            </div>
            <div class="owl-carousel owl-theme products_carousel">
                <div class="item">
                    <div class="grid_item">
                        <span class="ribbon new">New</span>
                        <figure>
                            <a href="product-detail-1.html">
                                <img class="owl-lazy" src="/assets/frontend/img/products/product_placeholder_square_medium.jpg" data-src="/assets/frontend/img/products/shoes/4.jpg" alt="">
                            </a>
                        </figure>
                        <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div>
                        <a href="product-detail-1.html">
                            <h3>ACG React Terra</h3>
                        </a>
                        <div class="price_box">
                            <span class="new_price">$110.00</span>
                        </div>
                        <ul>
                            <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a></li>
                            <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to compare</span></a></li>
                            <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
                        </ul>
                    </div>
                    <!-- /grid_item -->
                </div>
                <!-- /item -->
                <div class="item">
                    <div class="grid_item">
                        <span class="ribbon new">New</span>
                        <figure>
                            <a href="product-detail-1.html">
                                <img class="owl-lazy" src="/assets/frontend/img/products/product_placeholder_square_medium.jpg" data-src="/assets/frontend/img/products/shoes/5.jpg" alt="">
                            </a>
                        </figure>
                        <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div>
                        <a href="product-detail-1.html">
                            <h3>Air Zoom Alpha</h3>
                        </a>
                        <div class="price_box">
                            <span class="new_price">$140.00</span>
                        </div>
                        <ul>
                            <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a></li>
                            <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
                        </ul>
                    </div>
                    <!-- /grid_item -->
                </div>
                <!-- /item -->
                <div class="item">
                    <div class="grid_item">
                        <span class="ribbon hot">Hot</span>
                        <figure>
                            <a href="product-detail-1.html">
                                <img class="owl-lazy" src="/assets/frontend/img/products/product_placeholder_square_medium.jpg" data-src="/assets/frontend/img/products/shoes/8.jpg" alt="">
                            </a>
                        </figure>
                        <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div>
                        <a href="product-detail-1.html">
                            <h3>Air Color 720</h3>
                        </a>
                        <div class="price_box">
                            <span class="new_price">$120.00</span>
                        </div>
                        <ul>
                            <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a></li>
                            <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
                        </ul>
                    </div>
                    <!-- /grid_item -->
                </div>
                <!-- /item -->
                <div class="item">
                    <div class="grid_item">
                        <span class="ribbon off">-30%</span>
                        <figure>
                            <a href="product-detail-1.html">
                                <img class="owl-lazy" src="/assets/frontend/img/products/product_placeholder_square_medium.jpg" data-src="/assets/frontend/img/products/shoes/2.jpg" alt="">
                            </a>
                        </figure>
                        <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div>
                        <a href="product-detail-1.html">
                            <h3>Okwahn II</h3>
                        </a>
                        <div class="price_box">
                            <span class="new_price">$90.00</span>
                            <span class="old_price">$170.00</span>
                        </div>
                        <ul>
                            <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a></li>
                            <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
                        </ul>
                    </div>
                    <!-- /grid_item -->
                </div>
                <!-- /item -->
                <div class="item">
                    <div class="grid_item">
                        <span class="ribbon off">-50%</span>
                        <figure>
                            <a href="product-detail-1.html">
                                <img class="owl-lazy" src="/assets/frontend/img/products/product_placeholder_square_medium.jpg" data-src="/assets/frontend/img/products/shoes/3.jpg" alt="">
                            </a>
                        </figure>
                        <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div>
                        <a href="product-detail-1.html">
                            <h3>Air Wildwood ACG</h3>
                        </a>
                        <div class="price_box">
                            <span class="new_price">$75.00</span>
                            <span class="old_price">$155.00</span>
                        </div>
                        <ul>
                            <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a></li>
                            <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
                        </ul>
                    </div>
                    <!-- /grid_item -->
                </div>
                <!-- /item -->
            </div>
            <!-- /products_carousel -->
        </div>
        <!-- /container -->

        <div class="feat">
            <div class="container">
                <ul>
                    <li>
                        <div class="box">
                            <i class="ti-gift"></i>
                            <div class="justify-content-center">
                                <h3>Free Shipping</h3>
                                <p>For all oders over $99</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="box">
                            <i class="ti-wallet"></i>
                            <div class="justify-content-center">
                                <h3>Secure Payment</h3>
                                <p>100% secure payment</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="box">
                            <i class="ti-headphone-alt"></i>
                            <div class="justify-content-center">
                                <h3>24/7 Support</h3>
                                <p>Online top support</p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!--/feat-->
    </main>
    <!-- /main -->
    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
@endsection


@section('page_level_css_plugins')
@endsection

@section('page_level_css_files')
    <!-- SPECIFIC CSS -->
    <link href="{!! asset('assets/frontend/css/product_page.css') !!}" rel="stylesheet">
@endsection

@section('page_level_js_plugins')
@endsection

@section('page_level_js_files')
    <!-- SPECIFIC SCRIPTS -->
    <script src="{!! asset('assets/frontend/js/carousel_with_thumbs.js') !!}"></script>

    <script>
        function setColorValue(color_id) {
            $("#color_input").val(color_id);
        }
        function addToCart(product_id) {
            var color_id = $("#color_input").val();
            if (color_id == '') {
                toastr.warning("Please select a color.", "Warning", {
                    "positionClass": "toast-top-center",
                });
                return false;
            }

            var qty = $("#quantity_1").val();

            var csrf_token = $("[name='_token']").val();
            var post_url = "{!! route('frontend.cart.add-to-cart') !!}";

            $.ajax({
                type: "POST",
                url: post_url,
                data: {product_id: product_id, color_id: color_id, qty: qty, _token: csrf_token},
                beforeSend: function() {
                    $("#loading").show();
                },
                success: function( data ) {
                    if (data.status == 200) {
                        toastr.success("Added to Cart", "Success", {
                            "positionClass": "toast-top-center",
                        });

                    } else {
                        toastr.error(data.text, "Warning", {
                            "positionClass": "toast-top-center",
                        });
                    }
                    getTopCartContent();
                },
                complete: function () {
                    $("#loading").hide();
                }
            });
        }
    </script>
@endsection