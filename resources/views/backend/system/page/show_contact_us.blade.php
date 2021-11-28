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
                                    <a href="{!! route('backend.admin.page.contact-us.edit') !!}" class="btn btn-danger">Edit</a>
                                </div>
                                <!-- /.card-footer-->
                                <table class="table table-bordered">
                                    <tr>
                                        <td style="min-width: 140px;"><strong>Support Mail</strong></td>
                                        <td>{!! $contact_us->support_mail !!}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Contact Mail</strong></td>
                                        <td>{!! $contact_us->contact_mail !!}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Office Phone</strong></td>
                                        <td>{!! $contact_us->office_phone !!}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Fax</strong></td>
                                        <td>{!! $contact_us->fax !!}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Address</strong></td>
                                        <td>{!! $contact_us->address !!}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Text</strong></td>
                                        <td>{!! $contact_us->contact_text !!}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Status</strong></td>
                                        <td>
                                            @if($contact_us->deleted == 1)
                                                <span class="label label-sm label-danger">Deleted</span>
                                            @else
                                                @if($contact_us->status == 1)
                                                    <span class="label label-sm label-success">Active</span>
                                                @else
                                                    <span class="label label-sm label-warning">Inactive</span>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>

                                    @if($contact_us->created_at)
                                        <tr>
                                            <td><strong>Created At</strong></td>
                                            <td>{!! $contact_us->created_at !!}</td>
                                        </tr>
                                    @endif
                                    @if($contact_us->created_by)
                                        <tr>
                                            <td><strong>Created By</strong></td>
                                            <td>{!! $contact_us->createdBy->name !!}</td>
                                        </tr>
                                    @endif

                                    @if($contact_us->updated_at)
                                        <tr>
                                            <td><strong>Updated At</strong></td>
                                            <td>{!! $contact_us->updated_at !!}</td>
                                        </tr>
                                    @endif

                                    @if($contact_us->deleted_by)
                                        <tr>
                                            <td><strong>Updated By</strong></td>
                                            <td>{!! $contact_us->updatedBy->name !!}</td>
                                        </tr>
                                    @endif

                                    @if($contact_us->deleted)
                                        <tr>
                                            <td><strong>Deleted</strong></td>
                                            <td>
                                                <span class="label label-sm label-danger">Yes</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Deleted At</strong></td>
                                            <td>{!! $contact_us->deleted_at !!}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Deleted By</strong></td>
                                            <td>{!! $contact_us->deletedBy->name !!}</td>
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
                <a href="{!! route('backend.admin.page.contact-us.edit') !!}" class="btn btn-danger">Edit</a>
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
