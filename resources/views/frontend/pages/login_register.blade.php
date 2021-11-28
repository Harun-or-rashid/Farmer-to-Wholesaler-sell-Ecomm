
@extends('frontend.layouts.master')

@section('main_content')

    <main class="bg_gray">

        <div class="container margin_30">
            <div class="page_header">
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Login</a></li>
                        <li>Page active</li>
                    </ul>
                </div>
                <h1>Sign In or Create an Account</h1>
            </div>
            <!-- /page_header -->
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-6 col-md-8">
                    <div class="box_account">
                        <h3 class="client">Already Client</h3>
                        <div class="form_container">
                            {{--<div class="row no-gutters">
                                <div class="col-lg-6 pr-lg-1">
                                    <a href="{{url('sign-in/facebook')}}" class="social_bt facebook">Login with Facebook</a>
                                </div>
                                <div class="col-lg-6 pl-lg-1">
                                    <a href="#0" class="social_bt google">Login with Google</a>
                                </div>
                            </div>
                            <div class="divider"><span>Or</span></div>--}}
                            <form  action="{!! route('frontend.login') !!}" method="post">
                                @csrf
                                <input type="hidden" name="redirectTo" value="{{ request()->redirect_to }}">
                                <div class="form-group">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Email*">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password" id="password_in" value="" placeholder="Password*">
                                </div>
                                <div class="clearfix add_bottom_15">
                                    <div class="checkboxes float-left">
                                        <label class="container_check">Remember me
                                            <input type="checkbox" name="remember" value="1">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="float-right"><a id="forgot" href="javascript:void(0);">Lost Password?</a></div>
                                </div>
                                <div class="text-center"><input type="submit" value="Log In" class="btn_1 full-width"></div>

                            </form>
                            <div id="forgot_pw">
                                <div class="form-group">
                                    <input type="email" class="form-control" name="email_forgot" id="email_forgot" placeholder="Type your email">
                                </div>
                                <p>A new password will be sent shortly.</p>
                                <div class="text-center"><input type="submit" value="Reset Password" class="btn_1"></div>
                                <div class="float-right mt-1"><a id="back_login" href="javascript:void(0);">Back to login</a></div>
                            </div>
                        </div>
                        <!-- /form_container -->
                    </div>
                    <!-- /box_account -->
                    <div class="row">
                        <div class="col-md-6 d-none d-lg-block">
                            <ul class="list_ok">
                                <li>Find Locations</li>
                                <li>Quality Location check</li>
                                <li>Data Protection</li>
                            </ul>
                        </div>
                        <div class="col-md-6 d-none d-lg-block">
                            <ul class="list_ok">
                                <li>Secure Payments</li>
                                <li>H24 Support</li>
                            </ul>
                        </div>
                    </div>
                    <!-- /row -->
                </div>
                <div class="col-xl-6 col-lg-6 col-md-8">
                    <form action="{{ route('frontend.register') }}" method="post">
                        @csrf
                        <div class="box_account">
                            <h3 class="new_client">New Client</h3> <small class="float-right pt-2">* Required Fields</small>
                            <div class="form_container">
                                <div class="form-group">
                                    <input type="email" class="form-control" name="email" id="email_2" placeholder="Email*" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password" id="password_in_2" value="" placeholder="Password*" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="phone_number" id="phone_number" value="" placeholder="Phone Number*" required>
                                </div>
                                <hr>
                                <div class="private box">
                                    <div class="row no-gutters">
                                        <div class="col-6 pr-1">
                                            <div class="form-group">
                                                <input type="text" name="first_name" class="form-control" placeholder="First Name*" required>
                                            </div>
                                        </div>
                                        <div class="col-6 pl-1">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Last Name*" name="last_name" required>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Full Address*" name="address" required>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /row -->
                                    <div class="row no-gutters">
                                        <div class="col-6 pr-1">

                                            <label>Division *</label>
                                            <select name="division" id="division" onchange="getDistricts(this.value)" required class="form-control">
                                                <option value="">--Select Division--</option>
                                                @if(!empty($divisions))
                                                    @foreach($divisions as $division)
                                                        <option value="{!! $division->id !!}" {!! (old('division') == $division->id)?'selected':'' !!}>{!! $division->name !!} / {!! $division->bn_name !!}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @if($errors->has('division'))
                                                <span class="help-block">{!! $errors->first('division') !!}</span>
                                            @endif
                                        </div>
                                        <div class="col-6 pl-1">
                                            <label>District *</label>
                                            <select name="district" id="district" onchange="getUpazilas(this.value)" required class="form-control">
                                                <option value="">--Select Division First--</option>
                                            </select>
                                            @if($errors->has('district'))
                                                <span class="help-block">{!! $errors->first('district') !!}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row no-gutters mt-3">
                                        <div class="col-6 pr-1">
                                            <label>Upazila *</label>
                                            <select name="upazila" id="upazila" required class="form-control">
                                                <option value="">--Select District First--</option>
                                            </select>
                                            @if($errors->has('upazila'))
                                                <span class="help-block">{!! $errors->first('upazila') !!}</span>
                                            @endif
                                        </div>
                                        <div class="col-6 pl-1">
                                            <label>Post Code</label>
                                            <input type="text" class="form-control" name="post_code" value="{!! old('post_code') !!}" required placeholder="Post Code">
                                            @if($errors->has('post_code'))
                                                <span class="help-block">{!! $errors->first('post_code') !!}</span>
                                            @endif

                                        </div>
                                    </div>
                                    <!-- /row -->

                                </div>
                                <!-- /private -->
                                <hr>
                                <div class="form-group">
                                    <label class="container_check">Accept <a href="#0">Terms and conditions</a>
                                        <input type="checkbox" required name="terms_and_conditions" value="1">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="text-center">
                                    <button class="btn_1 full-width" type="submit">Register</button>
                                </div>
                            </div>
                            <!-- /form_container -->
                        </div>
                        <!-- /box_account -->
                    </form>
                </div>
            </div>
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
    <link href="{!! asset('assets/frontend/css/about.css') !!}" rel="stylesheet">
@endsection

@section('page_level_js_plugins')
@endsection

@section('page_level_js_files')
    <!-- SPECIFIC SCRIPTS -->
    <script src="{!! asset('assets/frontend/js/carousel-home.min.js') !!}"></script>

    <script>
        function getDistricts(division) {
            var csrf_token = $("[name='_token']").val();
            var post_url = "{!! route('ajax.get-districts-by-division') !!}";
            $.ajax({
                type: "POST",
                url: post_url,
                data: {division: division, _token: csrf_token},
                beforeSend: function() {
                    $("#loading").show();
                },
                success: function( data ) {
                    $("#district").html(data);
                },
                complete: function () {
                    $("#loading").hide();
                }
            });
        }

        function getUpazilas(district) {
            var csrf_token = $("[name='_token']").val();
            var post_url = "{!! route('ajax.get-upazilas-by-district') !!}";
            $.ajax({
                type: "POST",
                url: post_url,
                data: {district: district, _token: csrf_token},
                beforeSend: function() {
                    $("#loading").show();
                },
                success: function( data ) {
                    $("#upazila").html(data);
                },
                complete: function () {
                    $("#loading").hide();
                }
            });
        }
    </script>
@endsection
