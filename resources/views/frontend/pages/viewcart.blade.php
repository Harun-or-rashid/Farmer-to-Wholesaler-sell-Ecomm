
@extends('frontend.layouts.master')

@section('main_content')

    <main class="bg_gray">
        <div class="container margin_30">
            <div class="page_header">
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Category</a></li>
                        <li>Page active</li>
                    </ul>
                </div>
                <h1>Cart page</h1>
            </div>
            <!-- /page_header -->
            <table class="table table-striped cart-list">
                <thead>
                <tr>
                    <th>
                        Product
                    </th>
                    <th>
                        Price
                    </th>
                    <th>
                        Quantity
                    </th>
                    <th>
                        Subtotal
                    </th>
                    <th>

                    </th>
                </tr>
                </thead>
                <tbody>

                @foreach($cart_contents as $content)
                <tr>
                    <td>
                        <div class="thu mb_cart">
                            <img src="/assets/frontend/img/products/product_placeholder_square_small.jpg" data-src="img/products/shoes/1.jpg" class="lazy" alt="Image">
                        </div>
                        <span class="item_cart">{!! $content->name !!}</span>
                    </td>
                    <td>
                        <strong>{!! $content->price !!}</strong>
                    </td>
                    <td>
                        <strong>{!! $content->qty !!}</strong>
                    </td>
                    <td>
                        <strong>{!! $totalPrice !!}</strong>
                    </td>
                    <td class="options">
                        <a href="#"><i class="ti-trash"></i></a>
                    </td>
                </tr>
                @endforeach

                </tbody>
            </table>

            <div class="row add_top_30 flex-sm-row-reverse cart_actions">
                <div class="col-sm-4 text-right">
{{--                    <button type="button" class="btn_1 gray">Update Cart</button>--}}
                </div>
                <div class="col-sm-8">
                    <div class="apply-coupon">
                        <div class="form-group form-inline">
                            <input type="text" name="coupon-code" value="" placeholder="Promo code" class="form-control"><button type="button" class="btn_1 outline">Apply Coupon</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /cart_actions -->

        </div>
        <!-- /container -->

        <div class="box_cart">
            <div class="container">
                <div class="row justify-content-end">
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <ul>
                            <li>
                                <span>Subtotal</span> {!! $totalPrice !!}
                            </li>
                            <li>
                                <span>Shipping</span> $7.00
                            </li>
                            <li>
                                <span>Total</span> $247.00
                            </li>
                        </ul>
                        <a href="{!! route('frontend.checkout') !!}" class="btn_1 full-width cart">Proceed to Checkout</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /box_cart -->

    </main>
    <!--/main-->
@endsection


@section('page_level_css_plugins')
@endsection

@section('page_level_css_files')
    <!-- SPECIFIC CSS -->
@endsection

@section('page_level_js_plugins')
@endsection

@section('page_level_js_files')
    <!-- SPECIFIC SCRIPTS -->
    <script src="{!! asset('assets/frontend/js/carousel-home.min.js') !!}"></script>
@endsection
