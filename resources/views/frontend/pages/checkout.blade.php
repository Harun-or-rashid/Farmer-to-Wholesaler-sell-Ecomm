
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
            <form action="{!! route('frontend.checkout') !!}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-8 col-md-8">
                        <div class="step first payments">
                            <h3>1. Order Summary</h3>
                            <div class="box_general summary">
                                <ul>
                                    @if(!empty($cart_contents))
                                        @foreach($cart_contents as $content)
                                            <li class="clearfix"><em>{!! $content->qty !!}x {!! $content->name !!} - {!! $content->options->color !!} </em>  <span>{!! $content->price !!} Tk.</span></li>
                                        @endforeach
                                    @endif
                                </ul>
                                <ul>
                                    <li class="clearfix"><em><strong>Subtotal</strong></em>  <span>{!! $totalPrice !!} Tk.</span></li>
                                    <li class="clearfix"><em><strong>Shipping</strong></em> <span>$0</span></li>

                                </ul>
                                <div class="total clearfix">TOTAL <span>{!! $totalPrice !!} Tk.</span></div>
                            </div>
                            <!-- /box_general -->
                        </div>
                        <!-- /step -->
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="step last">
                            <h3>2. User Info and Billing address</h3>

                            <div class="card custom-card">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        Addresses
                                        &nbsp; &nbsp;<a href="{!! route('frontend.user.address-book') !!}" class="text-primary">Change</a>
                                    </h5>
                                    <p class="card-text">
                                        <input type="hidden" name="address" value="{!! @$user->defaultAddress->id !!}" required>
                                        @if(!empty($user->defaultAddress))
                                            <b>Default Address</b> <br>
                                            <b>Full Name : </b>{!! $user->defaultAddress->full_name !!} <br>
                                            <b>Phone Number : </b>{!! $user->defaultAddress->phone_number !!} <br>
                                            <b>Division : </b>{!! $user->defaultAddress->division->name !!} <br>
                                            <b>District : </b>{!! $user->defaultAddress->district->name !!} <br>
                                            <b>Upazila : </b>{!! $user->defaultAddress->upazila->name !!} <br>
                                            <b>Post Code : </b>{!! $user->defaultAddress->post_code !!} <br>
                                            <b>Address : </b>{!! $user->defaultAddress->address !!}
                                        @endif
                                    </p>
                                </div>
                                <button type="submit" class="btn_1 full-width">Confirm and Pay</button>
                            </div>

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
