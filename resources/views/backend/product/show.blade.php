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
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">

        </div>
        <!-- END PAGE BAR -->

        @include('backend.layout_partials.messages.success')
        @include('backend.layout_partials.messages.failed')
        @include('backend.layout_partials.messages.form_failed')

        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary m-2">
                    <div class="card-header">
                        <a href="{!! route('backend.admin.products.index') !!}" class="btn btn-success btn-sm" data-toggle="tooltip" title="List">List</a>
                        <a href="{!! route('backend.admin.products.edit', $product->id) !!}" class="btn btn-success btn-sm" data-toggle="tooltip" title="Edit">Edit</a>
                        <div class="tools">

                        </div>
                    </div>
                    <div class="card-body ">
                        <table class="table table-bordered">
                            <tr>
                                <td><strong>Title</strong></td>
                                <td><strong> : </strong></td>
                                <td>{!! $product->title !!}</td>
                            </tr>
                            <tr>
                                <td><strong>Short Text</strong></td>
                                <td><strong> : </strong></td>
                                <td>{!! $product->quick_text !!}</td>
                            </tr>
                            <tr>
                                <td><strong>Description</strong></td>
                                <td><strong> : </strong></td>
                                <td>{!! $product->product_details !!}</td>
                            </tr>
                            <tr>
                                <td><strong>Product Image</strong></td>
                                <td><strong> : </strong></td>
                                <td><img src="{!! asset($product_image->image) !!}" style="width: 200px;" alt=""></td>
                            </tr>
                            <tr>
                                <td><strong>Gallery Images</strong></td>
                                <td><strong> : </strong></td>
                                <td>
                                    @if(!empty($product_gallery_images))
                                        @foreach($product_gallery_images as $row)
                                            <img src="{!! asset($row->image) !!}"
                                                 alt="" style="width: 200px; margin: 10px; float: left;">
                                        @endforeach
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Status</strong></td>
                                <td><strong> : </strong></td>
                                <td>
                                    @if($product->deleted == 1)
                                        <span class="label label-sm label-danger">Deleted</span>
                                    @else
                                        @if($product->status == 1)
                                            <span class="label label-sm label-success">Active</span>
                                        @else
                                            <span class="label label-sm label-warning">Inactive</span>
                                        @endif
                                    @endif
                                </td>
                            </tr>

                            @if($product->created_at)
                                <tr>
                                    <td><strong>Created At</strong></td>
                                    <td><strong> : </strong></td>
                                    <td>{!! $product->created_at !!}</td>
                                </tr>
                            @endif
                            @if($product->created_by)
                                <tr>
                                    <td><strong>Created By</strong></td>
                                    <td><strong> : </strong></td>
                                    <td>{!! $product->createdBy->name !!}</td>
                                </tr>
                            @endif

                            @if($product->updated_at)
                                <tr>
                                    <td><strong>Updated At</strong></td>
                                    <td><strong> : </strong></td>
                                    <td>{!! $product->updated_at !!}</td>
                                </tr>
                                <tr>
                                    <td><strong>Updated By</strong></td>
                                    <td><strong> : </strong></td>
                                    <td>{!! $product->updatedBy->name !!}</td>
                                </tr>
                            @endif

                            @if($product->deleted)
                                <tr>
                                    <td><strong>Deleted</strong></td>
                                    <td><strong> : </strong></td>
                                    <td>
                                        <span class="label label-sm label-danger">Yes</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Deleted At</strong></td>
                                    <td><strong> : </strong></td>
                                    <td>{!! $product->deleted_at !!}</td>
                                </tr>
                                <tr>
                                    <td><strong>Deleted By</strong></td>
                                    <td><strong> : </strong></td>
                                    <td>{!! $product->deletedBy->name !!}</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>
    </div>
    <!-- END CONTENT BODY -->
@endsection

<!-- BEGIN PAGE LEVEL PLUGINS -->
@section('page_level_js_plugins')

@endsection
<!-- END PAGE LEVEL PLUGINS -->


<!-- BEGIN PAGE LEVEL SCRIPTS -->
@section('page_level_js_scripts')

@endsection
<!-- END PAGE LEVEL SCRIPTS -->
