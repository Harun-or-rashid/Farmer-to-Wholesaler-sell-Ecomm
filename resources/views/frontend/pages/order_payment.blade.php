
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
            </div>
            <!-- /page_header -->
            <form action="{!! route('frontend.order.payment', $order->id) !!}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-8 col-md-8">
                        <div class="step first payments">
                            <h3>1. Order Summary</h3>
                            <div class="box_general summary">
                                <ul>
                                    @if(!empty($order->orderDetails))
                                        @foreach($order->orderDetails as $content)
                                            @if($content->product_type == 1)
                                            <li class="clearfix">
                                                <em>{!! $content->quantity !!}x
                                                    {!! $content->product->title !!} -
                                                    @if(!empty($content->stock->color))
                                                        {!! $content->stock->color->title !!}
                                                    @endif
                                                </em>
                                                <span>{!! number_format(($content->price * $content->quantity), 2) !!} Tk.</span>
                                            </li>
                                            {{--@else
                                                <li class="clearfix">
                                                    <em>Delivery Charge
                                                    </em>
                                                    <span>{!! $content->payable_amount !!} Tk.</span>
                                                </li>--}}
                                            @endif
                                        @endforeach
                                    @endif
                                </ul>
                                <ul>
                                    <li class="clearfix"><em><strong>Subtotal</strong></em>  <span>{!! number_format($order->sub_total,2) !!} Tk.</span></li>
                                    <li class="clearfix"><em><strong>Shipping</strong></em> <span>{!! $order->delivery_charge !!} Tk.</span></li>

                                </ul>
                                <div class="total clearfix">TOTAL <span>{!! $order->payable_amount !!} Tk.</span></div>
                            </div>
                            <!-- /box_general -->
                        </div>
                        <!-- /step -->
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="step last payments">
                            <h3>2. Payment and Shipping</h3>
                            <ul>
                                <li>
                                    <label class="container_radio">Card Payment<a href="#0" class="info" data-toggle="modal" data-target="#payments_method"></a>
                                        <input type="radio" name="payment" value="2" checked="">
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="container_radio">Mobile Banking<a href="#0" class="info" data-toggle="modal" data-target="#payments_method"></a>
                                        <input type="radio" name="payment" value="3">
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="container_radio">Cash on delivery<a href="#0" class="info" data-toggle="modal" data-target="#payments_method"></a>
                                        <input type="radio" name="payment" value="1">
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                            </ul>
                            <div class="payment_info d-none d-sm-block"><figure><img src="/assets/frontend/img/cards_all.svg" alt=""></figure>	<p>Sensibus reformidans interpretaris sit ne, nec errem nostrum et, te nec meliore philosophia. At vix quidam periculis. Solet tritani ad pri, no iisque definitiones sea.</p></div>


                            <button type="submit" class="btn_1 full-width">Go To Pay</button>
                        </div>
                        <!-- /step -->
                    </div>

                </div>
            </form>
            <!-- /row -->
        </div>
        <!-- /container -->
    </main>
    <!--/main-->

@endsection


@section('page_level_css_plugins')
@endsection

@section('page_level_css_files')
    <!-- SPECIFIC CSS -->
    <link href="{!! asset('assets/frontend/css/checkout.css') !!}" rel="stylesheet">
@endsection

@section('page_level_js_plugins')
@endsection

@section('page_level_js_files')
    <!-- SPECIFIC SCRIPTS -->
    <script src="{!! asset('assets/frontend/js/carousel-home.min.js') !!}"></script>
@endsection
