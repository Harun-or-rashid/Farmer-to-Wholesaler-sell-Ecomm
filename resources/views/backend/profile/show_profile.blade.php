@extends('backend.layouts.master')

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
                                        <td><strong>Full Name</strong></td>
                                        <td>{!! $user->first_name . ' ' . $user->last_name !!}</td>
                                    </tr>
                                    {{--<tr>
                                        <td><strong>User Name</strong></td>
                                        <td>{!! $user->username !!}</td>
                                    </tr>--}}
                                    <tr>
                                        <td><strong>Email</strong></td>
                                        <td>{!! $user->email !!}</td>
                                    </tr>
                                    {{--<tr>
                                        <td><strong>Type</strong></td>
                                        <td>{!! $user->typeInfo->title !!}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Birthday</strong></td>
                                        <td>{!! $user->dob !!}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Gender</strong></td>
                                        <td>
                                            @if($user->gender == 1)
                                                Male
                                            @elseif($user->gender == 2)
                                                Female
                                            @elseif($user->gender == 3)
                                                Other
                                            @endif
                                        </td>
                                    </tr>--}}

                                    <tr>
                                        <td><strong>Status</strong></td>
                                        <td>
                                            @if($user->deleted == 1)
                                                <span class="label label-sm label-danger">Deleted</span>
                                            @else
                                                @if($user->status == 1)
                                                    <span class="label label-sm label-success">Active</span>
                                                @else
                                                    <span class="label label-sm label-warning">Inactive</span>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>

                                    @if($user->created_at)
                                        <tr>
                                            <td><strong>Created At</strong></td>
                                            <td>{!! $user->created_at !!}</td>
                                        </tr>
                                    @endif
                                    @if($user->created_by)
                                        <tr>
                                            <td><strong>Created By</strong></td>
                                            <td>{!! $user->createdBy->name !!}</td>
                                        </tr>
                                    @endif

                                    @if($user->updated_at)
                                        <tr>
                                            <td><strong>Updated At</strong></td>
                                            <td>{!! $user->updated_at !!}</td>
                                        </tr>
                                    @endif

                                    @if($user->deleted_by)
                                        <tr>
                                            <td><strong>Updated By</strong></td>
                                            <td>{!! $user->updatedBy->name !!}</td>
                                        </tr>
                                    @endif

                                    @if($user->deleted)
                                        <tr>
                                            <td><strong>Deleted</strong></td>
                                            <td>
                                                <span class="label label-sm label-danger">Yes</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Deleted At</strong></td>
                                            <td>{!! $user->deleted_at !!}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Deleted By</strong></td>
                                            <td>{!! $user->deletedBy->name !!}</td>
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
                <a href="{!! route('backend.admin.profile.edit') !!}" class="btn btn-danger">Edit</a>
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
