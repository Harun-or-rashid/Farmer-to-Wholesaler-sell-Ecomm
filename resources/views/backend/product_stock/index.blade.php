@extends('backend.layouts.master')

@section('page_level_css_plugins')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">

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
                            <a href="{!! route('backend.admin.product.stock.create') !!}" class="btn btn-success btn-sm" data-toggle="tooltip" title="View">Create</a>
                        </div>
                        <div class="tools" id="tools">
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="sample_2_wrapper" class="">
                            <div class="table-responsive">
                                <table id="stockTable" name="stockTable" class="data-table table-bordered table table-striped nowrap table-hover" width='100%' border="1" style='border-collapse: collapse;'>
                                    <thead>
                                    <tr>
                                        <!--<td>Employee UID</td>-->
                                        <td>SL</td>
                                        <td>Total Quantity</td>
                                        <td>Ordered Quantity</td>
                                        <td>Sold Quantity</td>
                                        <td>Available Quantity </td>
                                        <td>Options</td>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
{{--    <script src="{!! asset('assets/backend/plugins/datatables/jquery.dataTables.js') !!}" type="text/javascript"></script>--}}

    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>
@endsection
<!-- END PAGE LEVEL PLUGINS -->


<!-- BEGIN PAGE LEVEL SCRIPTS -->
@section('page_level_js_scripts')
{{--    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>--}}
    <!-- Custom Script for this pages -->
{{--    <script>--}}
{{--        $('#stockTable').DataTable( {--}}
{{--            dom: 'Bfrtip',--}}
{{--            buttons: [--}}
{{--                'print', 'pdf', 'excel', 'csv', 'copy'--}}
{{--            ],--}}
{{--            fixedColumns: true,--}}
{{--            columnDefs: [--}}
{{--                { width: 100, targets: 3 }--}}
{{--            ]--}}
{{--        } );--}}

{{--        $("#stockTable").on("click", ".list_delete_form", function(e){--}}
{{--            e.preventDefault();--}}
{{--            var $form=$(this);--}}
{{--            if (confirm("Do you want to delete this product?")) {--}}
{{--                $form.submit();--}}
{{--            }--}}

{{--        });--}}

{{--    </script>--}}
    <script type="text/javascript">

        var dataTable =  $('#stockTable');

        $(document).ready(function(){
            // DataTable
            stocktable();
        });


        function stocktable(){
            dataTable.DataTable({
                processing: true,
                serverSide: true,
                searchable:true,
                ajax: "{{route('backend.admin.product.stock.getstocks')}}",
                columns: [
                    { data: 'id' },
                    { data: 'total_quantity' },
                    { data: 'ordered_quantity' },
                    { data: 'sold_quantity' },
                    { data: 'available_quantity' },
                    { data: 'options' },
                ],
                "pageLength": 10
            });
        }


    </script>

@endsection
<!-- END PAGE LEVEL SCRIPTS -->
