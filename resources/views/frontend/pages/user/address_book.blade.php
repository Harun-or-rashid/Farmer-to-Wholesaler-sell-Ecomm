
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
                    <div class="col-md-12">
                        <div class="card custom-card">
                            <div class="card-body">
                                <h4 class="card-title">
                                    All Addresses
                                </h4>
                                <table class="table table-bordered table-hover table-striped">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th>
                                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#addAddressModal">
                                                +
                                            </button>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Full Name</th>
                                        <th>Address</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(!empty($all_addresses))
                                        @foreach($all_addresses as $address)

                                            <tr>
                                                <td>{!! $address->full_name !!}</td>
                                                <td>
                                                    {!! $address->address !!},
                                                    {!! $address->post_code !!},
                                                    {!! $address->upazila->name !!},
                                                    {!! $address->district->name !!},
                                                    {!! $address->division->name !!}
                                                </td>
                                                <td>
                                                    @if($address->address_type == 2)
                                                        <span class="text-success">Default</span>
                                                    @elseif($address->status == 1)
                                                        <span class="text-primary">Active</span>
                                                    @else
                                                        <span class="text-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0)" class="btn btn-sm btn-primary">Edit</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /box_cart -->
    </main>
    <!--/main-->


    <!-- Add Address Modal -->
    <div id="addAddressModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Address</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="{!! route('frontend.user.add-address-book') !!}" method="post">
                        @csrf
                        <div class="account-login">
                            <div class="box-authentication">
                                <label for="division">Division<span class="required">*</span></label>
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

                                <label for="district">District<span class="required">*</span></label>
                                <select name="district" id="district" onchange="getUpazilas(this.value)" required class="form-control">
                                    <option value="">--Select Division First--</option>
                                </select>
                                @if($errors->has('district'))
                                    <span class="help-block">{!! $errors->first('district') !!}</span>
                                @endif

                                <label for="Upazila">Upazila<span class="required">*</span></label>
                                <select name="upazila" id="upazila" required class="form-control">
                                    <option value="">--Select District First--</option>
                                </select>
                                @if($errors->has('upazila'))
                                    <span class="help-block">{!! $errors->first('upazila') !!}</span>
                                @endif

                                <label for="post_code">Post Code<span class="required">*</span></label>
                                <input type="text" class="form-control" name="post_code" value="{!! old('post_code') !!}" required>
                                @if($errors->has('post_code'))
                                    <span class="help-block">{!! $errors->first('post_code') !!}</span>
                                @endif

                                <label for="address">Address<span class="required">*</span></label>
                                <textarea name="address" id="address" class="form-control" required placeholder="Enter Address">{!! old('address') !!}</textarea>
                                @if($errors->has('address'))
                                    <span class="help-block">{!! $errors->first('address') !!}</span>
                                @endif
                            </div>
                            <div class="box-authentication">
                                <label for="full_name">Full Name<span class="required">*</span></label>
                                <input id="full_name" name="full_name" value="{!! old('full_name') !!}" type="text" class="form-control" required>
                                @if($errors->has('full_name'))
                                    <span class="help-block">{!! $errors->first('full_name') !!}</span>
                                @endif
                                <label for="phone_number">Phone Number<span class="required">*</span></label>
                                <input id="phone_number" name="phone_number" value="{!! old('phone_number') !!}" type="text" class="form-control" required>
                                @if($errors->has('phone_number'))
                                    <span class="help-block">{!! $errors->first('phone_number') !!}</span>
                                @endif

                                <button class="button btn btn-success" type="submit">
                                    <i class="fa fa-plus-circle"></i>&nbsp;
                                    <span>Add</span>
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
@endsection


@section('page_level_css_plugins')
@endsection

@section('page_level_css_files')
@endsection

@section('page_level_js_plugins')
@endsection

@section('page_level_js_files')
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
