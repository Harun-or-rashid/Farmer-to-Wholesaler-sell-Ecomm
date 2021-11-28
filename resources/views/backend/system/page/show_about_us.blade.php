@extends('backend.layouts.master')

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
                @include('backend.layout_partials.messages.success')
                @include('backend.layout_partials.messages.warning')
                @include('backend.layout_partials.messages.failed')
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet box green">
                            <div class="portlet-title">

                            </div>
                            <div class="portlet-body">
                                <div class="card-footer ml-5">
                                    <a href="{!! route('backend.admin.page.about-us.edit') !!}" class="btn btn-danger">Edit</a>
                                </div>
                                <!-- /.card-footer-->
                                <table class="table table-bordered">
                                    <tr>
                                        <td><strong>Image</strong></td>
                                        <td><img src="{!! asset($about_us->image) !!}"
                                                 alt="About Us Image" style="max-width: 200px;" ></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Text</strong></td>
                                        <td>{!! $about_us->about_text !!}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Status</strong></td>
                                        <td>
                                            @if($about_us->deleted == 1)
                                                <span class="label label-sm label-danger">Deleted</span>
                                            @else
                                                @if($about_us->status == 1)
                                                    <span class="label label-sm label-success">Active</span>
                                                @else
                                                    <span class="label label-sm label-warning">Inactive</span>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>

                                    @if($about_us->created_at)
                                        <tr>
                                            <td><strong>Created At</strong></td>
                                            <td>{!! $about_us->created_at !!}</td>
                                        </tr>
                                    @endif
                                    @if($about_us->created_by)
                                        <tr>
                                            <td><strong>Created By</strong></td>
                                            <td>{!! $about_us->createdBy->name !!}</td>
                                        </tr>
                                    @endif

                                    @if($about_us->updated_at)
                                        <tr>
                                            <td><strong>Updated At</strong></td>
                                            <td>{!! $about_us->updated_at !!}</td>
                                        </tr>
                                    @endif

                                    @if($about_us->deleted_by)
                                        <tr>
                                            <td><strong>Updated By</strong></td>
                                            <td>{!! $about_us->updatedBy->name !!}</td>
                                        </tr>
                                    @endif

                                    @if($about_us->deleted)
                                        <tr>
                                            <td><strong>Deleted</strong></td>
                                            <td>
                                                <span class="label label-sm label-danger">Yes</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Deleted At</strong></td>
                                            <td>{!! $about_us->deleted_at !!}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Deleted By</strong></td>
                                            <td>{!! $about_us->deletedBy->name !!}</td>
                                        </tr>
                                    @endif

                                    <tr>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.card-body -->
            <div class="card-footer ml-5">
                <a href="{!! route('backend.admin.page.about-us.edit') !!}" class="btn btn-danger">Edit</a>
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
@endsection

@section('page_level_css_plugins')

@endsection

@section('page_level_css_files')

@endsection

<!-- BEGIN PAGE LEVEL PLUGINS -->
@section('page_level_js_plugins')

@endsection
<!-- END PAGE LEVEL PLUGINS -->


<!-- BEGIN PAGE LEVEL SCRIPTS -->
@section('page_level_js_scripts')

@endsection
<!-- END PAGE LEVEL SCRIPTS -->
