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
                            <a href="javascript:void(0)" class="btn btn-success btn-sm" data-toggle="tooltip" title="View">Accepted Order Details</a>
                        </div>
                        <div class="tools" id="tools">
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="sample_2_wrapper" class="">
                            <h4 class="text-uppercase">Order ID# {!! $order->order_id !!}</h4>
                            <h6 class="">Order Date: {!! $order->created_at->format('d M, Y') !!}</h6>
                            <h5 class="bold">Products:</h5>

                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th class="text-center"> # </th>
                                    <th class="text-center">Title</th>
                                    <th class="text-center">Color</th>
                                    <th class="text-right">Price</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-right">Subtotal</th>
                                </tr>
                                </thead>

                                <tbody>
                                @php($total_amount = 0)
                                @php($delivery_charge = [])
                                @foreach($order->orderDetails as $order_detail)
                                    @if($order_detail->product_type == 1)
                                        <tr>
                                            <td class="text-center"> {!! $loop->iteration !!} </td>
                                            <td class="text-center">
                                                {!! $order_detail->product->title !!}
                                            </td>
                                            <td class="text-center">
                                                {!! @$order_detail->stock->color->title !!}
                                            </td>
                                            <td class="text-right">{!! $order_detail->price !!}</td>
                                            <td class="text-center">{!! $order_detail->quantity !!}</td>
                                            <td class="text-right">{!! $order_detail->payable_amount !!}</td>
                                        </tr>
                                    @endif
                                    @php($total_amount += $order_detail->payable_amount)
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="5" class="text-right"><b>Total</b></td>
                                    <td class="text-right">{!! number_format($total_amount, 2) !!}</td>
                                </tr>
                                </tfoot>
                            </table>
                            <div class="text-right">
                                <h4>
                                    Order Status#
                                    @if($order->order_status == 1)
                                        Pending
                                    @elseif($order->order_status == 2)
                                        Accepted
                                    @else
                                        Rejected/Cancel
                                    @endif
                                </h4>
                                <h5>
                                    Payment Status#
                                    @if($order->payment_status == 1)
                                        Paid
                                    @elseif($order->payment_status == 2)
                                        Partial Paid
                                    @else
                                        Pending
                                    @endif
                                </h5>
                                <h5>
                                    Delivery Status#
                                    @if($order->delivery_status == 1)
                                        Order Processing
                                    @elseif($order->delivery_status == 2)
                                        Waiting for deliver
                                    @else
                                        Delivered
                                    @endif
                                </h5>
                            </div>
                        </div>
                        <div class="form-actions text-center">
                            <div class="row">
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <form action="{!! route('backend.admin.order.accepted-order.update-delivery-status', $order->id) !!}" method="post">
                                        @csrf
                                        <h5>Delivery Status :</h5>
                                        <select name="delivery_status" id="" class="form-control">
                                            <option value="1" {!! ($order->delivery_status == 1)? 'selected':'' !!}>Order Processing</option>
                                            <option value="2" {!! ($order->delivery_status == 2)? 'selected':'' !!}>Waiting For Received</option>
                                            <option value="3" {!! ($order->delivery_status == 3)? 'selected':'' !!}>Delivered</option>
                                        </select>
                                        <button class="btn btn-primary">Update</button>
                                    </form>
                                </div>
                                <div class="col-md-4"></div>
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
