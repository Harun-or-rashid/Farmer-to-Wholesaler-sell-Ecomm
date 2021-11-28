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
                            <a href="javascript:void(0)" class="btn btn-success btn-sm" data-toggle="tooltip" title="View">Accepted Order List</a>
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
                                    <th class="text-center"> OrderID </th>
                                    <th class="text-center"> Order Type </th>
                                    <th class="text-center"> Total Amount </th>
                                    <th class="text-center"> Paid Amount </th>
                                    <th class="text-center"> Payment Status </th>
                                    <th class="text-center"> Delivery Status </th>
                                    <th class="text-center"> Customer Name </th>
                                    <th class="text-center"> Mobile </th>
                                    <th class="text-center"> Actions </th>
                                </tr>
                                </thead>

                                <tbody>
                                @if(!empty($accepted_orders))
                                    @foreach($accepted_orders as $row)
                                        <tr>
                                            <td class="text-center"> {!! $loop->iteration !!} </td>
                                            <td class="text-center"> {!! $row->order_id !!} </td>
                                            <td class="text-center">
                                                @if($row->order_type == 1)
                                                    Normal Order
                                                @else
                                                    Pre Order
                                                @endif
                                            </td>
                                            <td class="text-center"> {!! $row->payable_amount !!} Tk.</td>
                                            <td class="text-center"> {!! $row->paid_amount !!} Tk.</td>
                                            <td class="text-center">
                                                @if($row->payment_status == 0)
                                                    <span class="text-danger">Pending</span>
                                                @elseif($row->payment_status == 1)
                                                    <span class="text-success">Paid</span>
                                                @else
                                                    <span class="text-success">Partially Paid</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($row->delivery_status == 1)
                                                    Order Processing
                                                @elseif($row->delivery_status == 2)
                                                    Waiting for deliver
                                                @else
                                                    Delivered
                                                @endif
                                            </td>
                                            <td class="text-center"> {!! $row->orderAddress->full_name !!} </td>
                                            <td class="text-center"> {!! $row->orderAddress->phone_number !!} </td>

                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a href="{!! route('backend.admin.order.accepted-order.show', $row->id) !!}" class="btn btn-success btn-square btn-xs blue" data-toggle="tooltip" title="View">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
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
            $('#confirm').modal({ backdrop: 'static', keyboard: false }).on('click', '#delete-btn', function(){
                $form.submit();
            });

        });

    </script>
@endsection
<!-- END PAGE LEVEL SCRIPTS -->
