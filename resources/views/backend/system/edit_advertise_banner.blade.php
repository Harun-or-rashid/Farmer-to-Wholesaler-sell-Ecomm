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
                                <form action="{!! route('backend.admin.advertise-banner-settings.update') !!}" class="horizontal-form"
                                      method="post" enctype="multipart/form-data">
                                    {!! csrf_field() !!}

                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <table class="table table-hover table-striped table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th class="text-center">W:540,H:70 Price</th>
                                                        <th class="text-center">W:540,H:110 Price</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if(!empty($banner_settings))
                                                        @foreach($banner_settings as $banner)
                                                            <tr>
                                                                <th class="text-right">{!! $banner->name !!}:</th>
                                                                <td>
                                                                    <input type="number" step="0.01" class="form-control" value="{!! $banner->size_one_price !!}" placeholder="{!! $banner->name !!} Price" name="size_one_price_{!! $banner->id !!}" required>
                                                                </td>
                                                                <td>
                                                                    <input type="number" step="0.01" class="form-control" value="{!! $banner->size_two_price !!}" placeholder="{!! $banner->name !!} Price" name="size_two_price_{!! $banner->id !!}" required>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions text-center">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <button type="submit" class="btn btn-primary">
                                                    Update
                                                </button>

                                                <button type="reset" class="btn btn-default" data-toggle="tooltip" title="List">
                                                    Cancel
                                                </button>
                                            </div>
                                        </div>

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
