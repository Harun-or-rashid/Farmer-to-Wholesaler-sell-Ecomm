
@extends('frontend.layouts.master')

@section('main_content')

    <main class="bg_gray">
        <div class="container margin_30">
            <div class="page_header">
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li>User</li>
                    </ul>
                </div>
                <h1>My Orders</h1>
            </div>
            <!-- /page_header -->
        </div>
        <!-- /container -->

        <div class="box_cart">
            <div class="container">
                <div class="row pb-5" style="min-height: 250px;">
                    <div class="col-md-12">
                        <div class="card custom-card">
                            <div class="card-body">
                                <h4 class="card-title">
                                    My Order List
                                </h4>
                                <table id="sample_2" class="table table-bordered table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th class="text-center"> # </th>
                                        <th class="text-center"> OrderID </th>
                                        <th class="text-center"> Order Type </th>
                                        <th class="text-center"> Total Amount </th>
                                        <th class="text-center"> Paid Amount </th>
                                        <th class="text-center"> Payment Status </th>
                                        <th class="text-center"> Customer Name </th>
                                        <th class="text-center"> Mobile </th>
                                        <th class="text-center"> Order Status </th>
                                        <th class="text-center"> Delivery Status </th>
                                        {{--<th class="text-center"> Actions </th>--}}
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @if(!empty($orders))
                                        @foreach($orders as $row)
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
                                                <td class="text-center"> {!! $row->payable_amount !!} Tk. </td>
                                                <td class="text-center"> {!! $row->paid_amount !!} Tk. </td>
                                                <td class="text-center">
                                                    @if($row->payment_status == 0)
                                                        <span class="text-danger">Pending</span>
                                                    @elseif($row->payment_status == 1)
                                                        <span class="text-success">Paid</span>
                                                    @else
                                                        <span class="text-success">Partially Paid</span>
                                                    @endif
                                                </td>
                                                <td class="text-center"> {!! $row->orderAddress->full_name !!} </td>
                                                <td class="text-center"> {!! $row->orderAddress->phone_number !!} </td>
                                                <td class="text-center">
                                                    @if($row->order_status == 3)
                                                        <span class="text-danger">Reject/Cancel</span>
                                                    @elseif($row->order_status == 1)
                                                        <span class="text-warning">Pending</span>
                                                    @else
                                                        <span class="text-success">Accepted</span>
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
                                                {{--<td class="text-center">
                                                    <div class="btn-group">
                                                        <a href="{!! route('backend.admin.order.pending-order.show', $row->id) !!}" class="btn btn-success btn-square btn-xs blue" data-toggle="tooltip" title="View">
                                                            <i class="ti-eye"></i>
                                                        </a>
                                                    </div>
                                                </td>--}}
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
        </div>
        <!-- /box_cart -->
    </main>
    <!--/main-->
@endsection


@section('page_level_css_plugins')
    <link href="{!! asset('assets/backend/plugins/datatables/jquery.dataTables.min.css') !!}" rel="stylesheet" type="text/css" />
@endsection

@section('page_level_css_files')
@endsection

@section('page_level_js_plugins')
    <script src="{!! asset('assets/backend/plugins/datatables/jquery.dataTables.js') !!}" type="text/javascript"></script>
@endsection

@section('page_level_js_files')
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

    </script>
@endsection
