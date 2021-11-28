@extends('backend.layouts.master')

@section('page_level_css_plugins')
    <link href="{!! asset('assets/backend/plugins/datatables/jquery.dataTables.min.css') !!}" rel="stylesheet" type="text/css" />
@endsection

@section('page_level_css_files')

@endsection

@section('main_content')
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">

        @include('backend.layout_partials.messages.success')
        @include('backend.layout_partials.messages.failed')
        @include('backend.layout_partials.messages.form_failed')

        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <div class="caption">
                            <a href="{!! route('backend.admin.products.create') !!}" class="btn btn-success btn-sm" data-toggle="tooltip" title="View">Create</a>
                        </div>
                        <div class="tools" id="tools">
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="sample_2_wrapper" class="">
                            <table id="sample_2" class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th class="text-center"> # </th>
                                    <th class="text-center"> Category </th>
                                    <th class="text-center"> Sub Category </th>
                                    <th class="text-center"> Title </th>
                                    <th class="text-center"> Price </th>
                                    <th class="text-center"> Sell Price </th>
                                    <th class="text-center"> Published </th>
                                    <th class="text-center"> Featured </th>
                                    <th class="text-center"> Slider </th>
                                    <th class="text-center"> Status </th>
                                    <th class="text-center"> Actions </th>
                                </tr>
                                </thead>

                                <tbody>
                                @if(!empty($products))
                                    @foreach($products as $row)
                                        <tr>
                                            <td class="text-center"> {!! $loop->iteration !!} </td>
                                            <td class="text-center"> {!! @$row->category->parent->title !!} </td>
                                            <td class="text-center"> {!! $row->category->title !!} </td>
                                            <td class="text-center" title="{!! $row->title !!}"> {!! substr($row->title,0,20) !!}... </td>
                                            <td class="text-center"> ${!! $row->product_price !!} </td>
                                            <td class="text-center"> ${!! $row->sell_price !!} </td>
                                            <td class="text-center">
                                                @if($row->published == 1)
                                                    <span class="label label-sm text-success">Published</span>
                                                @else
                                                    <span class="label label-sm text-primary">Upcoming</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($row->featured == 1)
                                                    <span class="label label-sm text-success">Yes</span>
                                                @else
                                                    <span class="label label-sm text-primary">No</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($row->slider == 1)
                                                    <span class="label label-sm text-success">Yes</span>
                                                @else
                                                    <span class="label label-sm text-primary">No</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($row->deleted == 1)
                                                    <span class="label label-sm label-danger">Deleted</span>
                                                @else
                                                    @if($row->status == 1)
                                                        <span class="label label-sm text-success">Active</span>
                                                    @else
                                                        <span class="label label-sm text-danger">Inactive</span>
                                                    @endif
                                                @endif
                                            </td>

                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a href="{!! route('backend.admin.products.show', $row->id) !!}" class="btn btn-success btn-square btn-xs blue" data-toggle="tooltip" title="View">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    &nbsp;
                                                    <a href="{!! route('backend.admin.products.edit', $row->id) !!}" class="btn btn-primary btn-square btn-xs green" data-toggle="tooltip" title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    &nbsp;
                                                    @if($row->deleted == 0)
                                                        <form method="POST" class="list_delete_form" action="{!! route('backend.admin.products.destroy', $row->id) !!}" accept-charset="UTF-8" >
                                                            {!! csrf_field() !!}
                                                            <input name="_method" type="hidden" value="DELETE">
                                                            <button type="submit" class="btn btn-danger btn-square btn-xs red" data-toggle="tooltip" title="Delete">
                                                                <i class="fa fa-trash-alt"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
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

        <div class="clearfix"></div>
    </div>
    <!-- END CONTENT BODY -->
@endsection

<!-- BEGIN PAGE LEVEL PLUGINS -->
@section('page_level_js_plugins')
    <script src="{!! asset('assets/backend/plugins/datatables/jquery.dataTables.js') !!}" type="text/javascript"></script>
@endsection
<!-- END PAGE LEVEL PLUGINS -->


<!-- BEGIN PAGE LEVEL SCRIPTS -->
@section('page_level_js_scripts')

    <!-- Custom Script for this pages -->
    <script>
        $('#sample_2').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'print', 'pdf', 'excel', 'csv', 'copy'
            ],
            fixedColumns: true,
            columnDefs: [
                { width: 100, targets: 3 }
            ]
        } );

        $("#sample_2").on("click", ".list_delete_form", function(e){
            e.preventDefault();
            var $form=$(this);
            if (confirm("Do you want to delete this product?")) {
                $form.submit();
            }

        });

    </script>
@endsection
<!-- END PAGE LEVEL SCRIPTS -->
