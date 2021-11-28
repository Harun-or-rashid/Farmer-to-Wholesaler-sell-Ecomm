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
                <h3>System Settings</h3>
                <div class="tools">

                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 ml-5">
                        <div class="portlet">
                            <div class="portlet-body form">
                                <!-- BEGIN FORM-->
                                @include('backend.layout_partials.messages.success')
                                @include('backend.layout_partials.messages.failed')
                                @include('backend.layout_partials.messages.form_failed')
                                <form action="{!! route('backend.admin.system-settings.edit') !!}" class="horizontal-form"
                                      method="post" enctype="multipart/form-data">
                                    {!! csrf_field() !!}

                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group @if ($errors->has('website_title')) has-error @endif">
                                                    <label class="control-label">Website Title</label>
                                                    <input type="text" name="website_title" id="website_title"
                                                           value="{!! $settings->website_title !!}"
                                                           class="form-control" placeholder="Website Title" required>

                                                    @if($errors->has('website_title'))
                                                        <span class="text-danger">{!! $errors->first('website_title') !!}</span>
                                                    @else
                                                        <span class="help-block"> This field is required. </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-4">
                                                <div class="form-group @if ($errors->has('website_short_name')) has-error @endif">
                                                    <label class="control-label">Website Short Name</label>
                                                    <input type="text" name="website_short_name" id="website_short_name"
                                                           value="{!! $settings->website_short_name !!}"
                                                           class="form-control" placeholder="Website Short Name" required>

                                                    @if($errors->has('website_short_name'))
                                                        <span class="text-danger">{!! $errors->first('website_short_name') !!}</span>
                                                    @else
                                                        <span class="help-block"> This field is required. </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group @if ($errors->has('email')) has-error @endif">
                                                    <label class="control-label">Email</label>
                                                    <input type="email" name="email" id="email"
                                                           value="{!! $settings->email !!}"
                                                           class="form-control" placeholder="Email" required>

                                                    @if($errors->has('email'))
                                                        <span class="text-danger">{!! $errors->first('email') !!}</span>
                                                    @else
                                                        <span class="help-block"> This field is required. </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <!--/span-->

                                            <div class="col-md-4">
                                                <div class="form-group @if ($errors->has('phone_number')) has-error @endif">
                                                    <label class="control-label">Phone Number</label>
                                                    <input type="text" name="phone_number" id="phone_number"
                                                           value="{!! $settings->phone_number !!}"
                                                           class="form-control" placeholder="Phone Number" required>

                                                    @if($errors->has('phone_number'))
                                                        <span class="text-danger">{!! $errors->first('phone_number') !!}</span>
                                                    @else
                                                        <span class="help-block"> This field is required. </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group @if ($errors->has('logo')) has-error @endif">
                                                    <label class="control-label">Logo</label>
                                                    <input type="file" name="logo" id="logo"
                                                           class="form-control" placeholder="Logo">
                                                    @if($errors->has('logo'))
                                                        <span class="text-danger">{!! $errors->first('logo') !!}</span>
                                                    @else
                                                        <span class="help-block"> [If you don't want to change keep it blank]. </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <!--/span-->

                                            <div class="col-md-4">
                                                <div class="form-group @if ($errors->has('favicon')) has-error @endif">
                                                    <label class="control-label">Favicon</label>
                                                    <input type="file" name="favicon" id="favicon"
                                                           class="form-control" placeholder="Favicon">
                                                    @if($errors->has('favicon'))
                                                        <span class="text-danger">{!! $errors->first('favicon') !!}</span>
                                                    @else
                                                        <span class="help-block"> [If you don't want to change keep it blank]. </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group @if ($errors->has('facebook_url')) has-error @endif">
                                                    <label class="control-label">Facebook Url</label>
                                                    <input type="text" name="facebook_url" id="facebook_url"
                                                           value="{!! $settings->facebook_url !!}"
                                                           class="form-control" placeholder="Facebook Url">

                                                    @if($errors->has('facebook_url'))
                                                        <span class="text-danger">{!! $errors->first('facebook_url') !!}</span>
                                                    @else
                                                        <span class="help-block"> This field is nullable. </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <!--/span-->

                                            <div class="col-md-4">
                                                <div class="form-group @if ($errors->has('twitter_url')) has-error @endif">
                                                    <label class="control-label">Twitter Url</label>
                                                    <input type="text" name="twitter_url" id="twitter_url"
                                                           value="{!! $settings->twitter_url !!}"
                                                           class="form-control" placeholder="Twitter Url">

                                                    @if($errors->has('twitter_url'))
                                                        <span class="text-danger">{!! $errors->first('twitter_url') !!}</span>
                                                    @else
                                                        <span class="help-block"> This field is nullable. </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group @if ($errors->has('pinterest_url')) has-error @endif">
                                                    <label class="control-label">Pinterest Url</label>
                                                    <input type="text" name="pinterest_url" id="pinterest_url"
                                                           value="{!! $settings->pinterest_url !!}"
                                                           class="form-control" placeholder="Pinterest Url">

                                                    @if($errors->has('pinterest_url'))
                                                        <span class="text-danger">{!! $errors->first('pinterest_url') !!}</span>
                                                    @else
                                                        <span class="help-block"> This field is nullable. </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <!--/span-->

                                            <div class="col-md-4">
                                                <div class="form-group @if ($errors->has('instagram_url')) has-error @endif">
                                                    <label class="control-label">Instagram Url</label>
                                                    <input type="text" name="instagram_url" id="instagram_url"
                                                           value="{!! $settings->twitter_url !!}"
                                                           class="form-control" placeholder="Instagram Url">

                                                    @if($errors->has('instagram_url'))
                                                        <span class="text-danger">{!! $errors->first('instagram_url') !!}</span>
                                                    @else
                                                        <span class="help-block"> This field is nullable. </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>

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
