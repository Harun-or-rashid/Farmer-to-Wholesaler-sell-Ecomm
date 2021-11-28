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
                                <table class="table table-bordered">
                                    <tr>
                                        <td><strong>Website Title</strong></td>
                                        <td>{!! $settings->website_title !!}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Website Short Name</strong></td>
                                        <td>{!! $settings->website_short_name !!}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Email</strong></td>
                                        <td>{!! $settings->email !!}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Phone Number</strong></td>
                                        <td>{!! $settings->phone_number !!}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Logo</strong></td>
                                        <td><img src="{!! asset($settings->logo) !!}"
                                                 alt="{!! $settings->website_title !!} Logo" style="max-height: 100px;" ></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Favicon</strong></td>
                                        <td><img src="{!! asset($settings->favicon) !!}"
                                                 alt="{!! $settings->website_title !!} Logo" style="max-height: 100px;" ></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Facebook URL</strong></td>
                                        <td>{!! $settings->facebook_url !!}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Twitter URL</strong></td>
                                        <td>{!! $settings->twitter_url !!}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Pinterest URL</strong></td>
                                        <td>{!! $settings->pinterest_url !!}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Instagram URL</strong></td>
                                        <td>{!! $settings->instagram_url !!}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Status</strong></td>
                                        <td>
                                            @if($settings->deleted == 1)
                                                <span class="label label-sm label-danger">Deleted</span>
                                            @else
                                                @if($settings->status == 1)
                                                    <span class="label label-sm label-success">Active</span>
                                                @else
                                                    <span class="label label-sm label-warning">Inactive</span>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>

                                    @if($settings->created_at)
                                        <tr>
                                            <td><strong>Created At</strong></td>
                                            <td>{!! $settings->created_at !!}</td>
                                        </tr>
                                    @endif
                                    @if($settings->created_by)
                                        <tr>
                                            <td><strong>Created By</strong></td>
                                            <td>{!! $settings->createdBy->name !!}</td>
                                        </tr>
                                    @endif

                                    @if($settings->updated_at)
                                        <tr>
                                            <td><strong>Updated At</strong></td>
                                            <td>{!! $settings->updated_at !!}</td>
                                        </tr>
                                    @endif

                                    @if($settings->deleted_by)
                                        <tr>
                                            <td><strong>Updated By</strong></td>
                                            <td>{!! $settings->updatedBy->name !!}</td>
                                        </tr>
                                    @endif

                                    @if($settings->deleted)
                                        <tr>
                                            <td><strong>Deleted</strong></td>
                                            <td>
                                                <span class="label label-sm label-danger">Yes</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Deleted At</strong></td>
                                            <td>{!! $settings->deleted_at !!}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Deleted By</strong></td>
                                            <td>{!! $settings->deletedBy->name !!}</td>
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
                <a href="{!! route('backend.admin.system-settings.edit') !!}" class="btn btn-danger">Edit</a>
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
