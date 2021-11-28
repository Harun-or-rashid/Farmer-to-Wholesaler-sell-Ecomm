@extends('backend.layouts.master')

@section('page_level_css_plugins')
    <link href="{!! asset('assets/backend/global/plugins/select2/css/select2.min.css') !!}" rel="stylesheet"
          type="text/css"/>
    <link href="{!! asset('assets/backend/global/plugins/select2/css/select2-bootstrap.min.css') !!}" rel="stylesheet"
          type="text/css"/>
    <link rel="stylesheet"
          href="{!! asset('assets/backend/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') !!}">
@endsection

@section('page_level_css_files')

@endsection

@section('main_content')

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3>{!! $user->last_name !!}</h3>
                <div class="tools">

                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 ml-5">
                        <div class="portlet">
                            <div class="portlet-body form">
                                <!-- BEGIN FORM-->
                                <form action="{!! route('backend.admin.profile.edit') !!}" class="horizontal-form"
                                      method="post">
                                    {!! csrf_field() !!}

                                    <div class="form-body">
                                        <h3 class="form-section">Authentication Information</h3>
                                        <div class="row">
                                            {{--<div class="col-md-4">
                                                <div class="form-group @if ($errors->has('username')) has-error @endif">
                                                    <label class="control-label">Username</label>
                                                    <input type="text" name="username" id="username" value="{!! $user->username !!}"
                                                           class="form-control" placeholder="Enter Username" required>

                                                    @if($errors->has('username'))
                                                        <span class="help-block">{!! $errors->first('username') !!}</span>
                                                    @else
                                                        <span class="help-block"> This field is required. </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <!--/span-->
        --}}
                                            <div class="col-md-4">
                                                <div class="form-group @if ($errors->has('email')) has-error @endif">
                                                    <label class="control-label">Email</label>
                                                    <input type="text" name="email" id="email"
                                                           value="{!! $user->email !!}"
                                                           class="form-control" placeholder="Email" required>

                                                    @if($errors->has('email'))
                                                        <span class="text-danger">{!! $errors->first('email') !!}</span>
                                                    @else
                                                        <span class="help-block"> This field is required. </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group @if ($errors->has('password')) has-error @endif">
                                                    <label class="control-label">Password</label>
                                                    <input type="password" name="password" id="password"
                                                           class="form-control" placeholder="Enter Password">

                                                    @if($errors->has('password'))
                                                        <span class="text-danger">{!! $errors->first('password') !!}</span>
                                                    @else
                                                        <span class="help-block"> [If you don't want to change keep it blank]</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <!--/span-->

                                            <div class="col-md-4">
                                                <div class="form-group @if ($errors->has('password_confirmation')) has-error @endif">
                                                    <label class="control-label">Confirm password</label>
                                                    <input type="password" name="password_confirmation"
                                                           id="password_confirmation" class="form-control"
                                                           placeholder="Enter Password Again">

                                                    @if($errors->has('password_confirmation'))
                                                        <span class="text-danger">{!! $errors->first('password_confirmation') !!}</span>
                                                    @else
                                                        <span class="help-block"> [If you don't want to change keep it blank]</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>


                                        <h3 class="form-section">Profile Information</h3>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group @if ($errors->has('first_name')) has-error @endif">
                                                    <label for="first_name" class="control-label">First Name</label>
                                                    <input type="text" id="first_name" name="first_name"
                                                           value="{!! $user->first_name !!}" class="form-control">

                                                    @if($errors->has('first_name'))
                                                        <span class="text-danger">{!! $errors->first('first_name') !!}</span>
                                                    @else
                                                        <span class="help-block"> This field is nullable. </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <!--/span-->

                                            <div class="col-md-4">
                                                <div class="form-group @if ($errors->has('last_name')) has-error @endif">
                                                    <label for="last_name" class="control-label">Last Name</label>
                                                    <input type="text" id="last_name" name="last_name"
                                                           value="{!! $user->last_name !!}" class="form-control">

                                                    @if($errors->has('last_name'))
                                                        <span class="text-danger">{!! $errors->first('last_name') !!}</span>
                                                    @else
                                                        <span class="help-block"> This field is nullable. </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->

                                        <div class="row">

                                        {{--<div class="col-md-4">
                                            <div class="form-group @if ($errors->has('gender')) has-error @endif">
                                                <label class="control-label">Gender</label>
                                                <select name="gender" id="gender" class="form-control select2">
                                                    <option value="">Select Gender</option>
                                                    <option value="1" {!! ($user->gender == 1)?'selected':'' !!}>Male</option>
                                                    <option value="2" {!! ($user->gender == 2)?'selected':'' !!}>Female</option>
                                                    <option value="3" {!! ($user->gender == 3)?'selected':'' !!}>Other</option>
                                                </select>

                                                @if($errors->has('gender'))
                                                    <span class="help-block">{!! $errors->first('gender') !!}</span>
                                                @else
                                                    <span class="help-block"> This field is nullable. </span>
                                                @endif
                                            </div>
                                        </div>--}}
                                        <!--/span-->
                                        </div>
                                        <!--/row-->
                                    </div>
                                    <div class="form-actions left">
                                        <button type="submit" class="btn btn-primary">
                                            Update
                                        </button>

                                        <button type="reset" class="btn btn-default" data-toggle="tooltip" title="List">
                                            Cancel
                                        </button>
                                    </div>
                                </form>
                                <!-- END FORM-->
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.card-body -->
            <div class="card-footer ml-5">

            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
@endsection

<!-- BEGIN PAGE LEVEL PLUGINS -->
@section('page_level_js_plugins')
    <script src="{!! asset('assets/backend/global/plugins/select2/js/select2.full.min.js') !!}"
            type="text/javascript"></script>
    <script src="{!! asset('assets/backend/pages/scripts/components-select2.js') !!}" type="text/javascript"></script>
    <script src="{!! asset('assets/backend/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') !!}"></script>
@endsection
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->
@section('page_level_js_scripts')
    <script>
        $('.datepicker').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'yyyy-mm-dd',
            endDate: new Date()
        });
        $('.select2').select2();
    </script>
@endsection
<!-- END PAGE LEVEL SCRIPTS -->
