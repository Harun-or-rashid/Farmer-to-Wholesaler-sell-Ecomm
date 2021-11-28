
@extends('frontend.layouts.master')

@section('main_content')

    <main class="bg_gray">
        <div class="container margin_30">
            <div class="page_header">
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li>Page active</li>
                    </ul>
                </div>
                <h1>Profile</h1>
            </div>
            <!-- /page_header -->
        </div>
        <!-- /container -->

        <div class="box_cart">
            <div class="container">
                <div class="row pb-5" style="min-height: 250px;">
                    <div class="col-md-4">
                        <div class="card custom-card">
                            <div class="card-body">
                                <h5 class="card-title">
                                    Personal Profile
                                    &nbsp; &nbsp;<a href="#" class="text-primary">Edit</a>
                                </h5>

                                <p class="card-text bold">
                                    <b>Full Name:</b> {!! $user->full_name !!} <br>
                                    <b>Mobile:</b> {!! $user->mobile !!} <br>
                                    <b>Email:</b> {!! $user->email !!} <br>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card custom-card">
                            <div class="card-body">
                                <h5 class="card-title">
                                    Addresses
                                    &nbsp; &nbsp;<a href="{!! route('frontend.user.address-book') !!}" class="text-primary">Manage</a>
                                </h5>
                                <p class="card-text">
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
                        </div>
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
@endsection

@section('page_level_js_plugins')
@endsection

@section('page_level_js_files')
@endsection
