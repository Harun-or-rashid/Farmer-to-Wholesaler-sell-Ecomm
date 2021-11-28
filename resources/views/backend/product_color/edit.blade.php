@extends('backend.layouts.master')

@section('page_level_css_plugins')
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('assets/backend/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/backend/plugins/select2/css/select2.min.css') }}">
@endsection

@section('page_level_css_files')

@endsection

@section('main_content')
    <section class="content">

        @include('backend.layout_partials.messages.success')
        @include('backend.layout_partials.messages.failed')
        @include('backend.layout_partials.messages.form_failed')
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <a href="{!! route('backend.admin.product.color.index') !!}" class="btn btn-success btn-sm">List</a>
                    </div>
                    <div class="card-body">
                        <div id="sample_2_wrapper" class="">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Color</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                @if(!empty($colors))
                                    @foreach($colors as $color)
                                        <tr>
                                            <td>{!! $loop->iteration !!}</td>
                                            <td>{!! $color->title !!}</td>
                                            <td>{!! $color->color_code !!}</td>
                                            <td>{!! ($color->status == 1)?'Active':'Inactive' !!}</td>
                                            <td>
                                                <a href="{!! route('backend.admin.product.color.edit', $color->id) !!}" class="btn btn-danger btn-xs"><i class="fa fa-pencil-alt"></i></a>
                                            </td>

                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>

                        </div>
                    </div>
                    <div class="card-footer">

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <a href="#" class="btn btn-success btn-sm">Edit</a>
                    </div>
                    <div class="card-body">
                        <form action="{!! route('backend.admin.product.color.update', $edit_color->id) !!}" class="horizontal-form" method="post">
                            @method('patch')
                            {!! csrf_field() !!}
                            <div class="form-body">
                                <h3 class="form-section">Color Info</h3>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group @if ($errors->has('title')) has-error @endif">
                                            <label class="control-label">Title</label>
                                            <input type="text" name="title" id="title" value="{!! $edit_color->title !!}"
                                                   class="form-control" placeholder="Enter Category Title" required>

                                            @if($errors->has('title'))
                                                <span class="help-block">{!! $errors->first('title') !!}</span>
                                            @else
                                                <span class="help-block"> This field is required. </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!--/row-->
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group @if ($errors->has('color_code')) has-error @endif">
                                            <label for="color" class="control-label">Color</label>
                                            <input type="color" name="color_code" id="color" value="{!! $edit_color->color_code !!}" class="form-control">

                                            @if($errors->has('color_code'))
                                                <span class="help-block">{!! $errors->first('color_code') !!}</span>
                                            @else
                                                <span class="help-block"> This field is nullable. </span>
                                            @endif
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->

                            </div>

                            <div class="form-actions left">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-check"></i> Save
                                </button>
                                <button type="reset" class="btn btn-danger">Cancel</button>
                            </div>
                        </form>
                        <!-- END FORM-->
                    </div>
                    <div class="card-footer">

                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </section>
@endsection

@section('page_level_js_plugins')
    <!-- date-range-picker -->
    {{--<script src="{{ asset('adminLTE2/bower_components/moment/min/moment.min.js') }}"></script>--}}
    <!-- bootstrap datepicker -->
    <script src="{{ asset('assets/backend/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('assets/backend/plugins/select2/js/select2.full.min.js') }}"></script>
@endsection

@section('page_level_js_scripts')
    <!-- Page script -->
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2();

            //Date picker
            $('.datepicker').datepicker({
                autoclose: true,
                todayHighlight: true,
                format: 'yyyy-mm-dd'
            });
        });

    </script>
@endsection
