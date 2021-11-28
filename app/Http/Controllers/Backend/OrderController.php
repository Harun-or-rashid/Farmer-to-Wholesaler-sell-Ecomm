<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Array_;

class OrderController extends Controller
{
    public function showPendingOrderList()
    {

        $common_data = new Array_();
        $common_data->title = 'Pending Order';
        $common_data->sub_title = 'Pending Order';
        $common_data->main_menu = 'pending_orders';
        $common_data->sub_menu = '';
        $common_data->current_menu = '';

        $pending_orders = Order::where('order_status', 1)->get();

        return view('backend.order.pending_orders')
            ->with(compact('common_data', 'pending_orders'));
    }

    public function showPendingOrderDetails($order_id)
    {
        $common_data = new Array_();
        $common_data->title = 'Pending Order';
        $common_data->sub_title = 'Pending Order';
        $common_data->main_menu = 'pending_orders';
        $common_data->sub_menu = '';
        $common_data->current_menu = '';

        $order = Order::where('id', $order_id)->where('order_status', 1)->first();
        if (empty($order)) {
            return redirect()->back()->with(['failed' => 'Invalid Order']);
        }

        return view('backend.order.pending_order_details')
            ->with(compact('common_data', 'order'));
    }


    public function acceptPendingOrder($id)
    {
        try {
            $order = Order::where('id', $id)
                ->where('order_status', 1)
                ->where('status', 1)
                ->where('deleted', 0)
                ->first();

            if (empty($order)) {
                return redirect()->back()->with(['failed' => 'Invalid Order']);
            }

            $order->order_status = 2;
            $order->save();

            return redirect()->route('backend.admin.order.pending-list')->with(['success' => 'Order Accepted Successfully']);

        } catch (\Exception $exception) {
            return redirect()->back()->with(['failed' => 'Something went wrong! Please Contact with admin']);
        }
    }


    public function rejectPendingOrder($id)
    {
        try {
            $order = Order::where('id', $id)
                ->where('order_status', 1)
                ->where('status', 1)
                ->where('deleted', 0)
                ->first();

            if (empty($order)) {
                return redirect()->back()->with(['failed' => 'Invalid Order']);
            }

            $order->order_status = 3;
            $order->save();

            return redirect()->route('backend.admin.order.pending-list')->with(['success' => 'Order Rejected Successfully']);

        } catch (\Exception $exception) {
            return redirect()->back()->with(['failed' => 'Something went wrong! Please Contact with admin']);
        }
    }

    public function showAcceptedOrderList()
    {
        $common_data = new Array_();
        $common_data->title = 'Accepted Order';
        $common_data->sub_title = 'Accepted Order';
        $common_data->main_menu = 'accepted_orders';
        $common_data->sub_menu = '';
        $common_data->current_menu = '';

        $accepted_orders = Order::where('order_status', 2)->where('delivery_status', '!=', 3)->get();

        return view('backend.order.accepted_orders')
            ->with(compact('common_data', 'accepted_orders'));
    }

    public function showAcceptedOrderDetails($order_id)
    {
        $common_data = new Array_();
        $common_data->title = 'Accepted Order';
        $common_data->sub_title = 'Accepted Order';
        $common_data->main_menu = 'accepted_orders';
        $common_data->sub_menu = '';
        $common_data->current_menu = '';

        $order = Order::where('id', $order_id)->where('order_status', 2)->where('delivery_status', '!=', 3)->first();
        if (empty($order)) {
            return redirect()->back()->with(['failed' => 'Invalid Order']);
        }

        return view('backend.order.accepted_order_details')
            ->with(compact('common_data', 'order'));
    }

    public function updateDeliveryStatus(Request $request, $order_id)
    {
        $order = Order::where('id', $order_id)->where('order_status', 2)->first();
        if (empty($order)) {
            return redirect()->back()->with(['failed' => 'Invalid Order']);
        }

        $order->delivery_status = $request->delivery_status ?? 1;
        $order->save();
        if ($request->delivery_status == 3) {
            return redirect()
                ->route('backend.admin.order.completed-order.show', $order->id)
                ->with(['success' => 'Order Delivered Success']);
        } else {
            return redirect()->back()->with(['success' => 'Delivery Status Updated!']);
        }
    }

    public function showCompletedOrderList()
    {
        $common_data = new Array_();
        $common_data->title = 'Completed Order';
        $common_data->sub_title = 'Completed Order';
        $common_data->main_menu = 'completed_orders';
        $common_data->sub_menu = '';
        $common_data->current_menu = '';

        $completed_orders = Order::where('order_status', 2)->where('delivery_status', 3)->get();

        return view('backend.order.completed_orders')
            ->with(compact('common_data', 'completed_orders'));
    }

    public function showCompletedOrderDetails($order_id)
    {
        $common_data = new Array_();
        $common_data->title = 'Completed Order';
        $common_data->sub_title = 'Completed Order';
        $common_data->main_menu = 'completed_orders';
        $common_data->sub_menu = '';
        $common_data->current_menu = '';

        $order = Order::where('id', $order_id)->where('order_status', 2)->where('delivery_status', 3)->first();
        if (empty($order)) {
            return redirect()->back()->with(['failed' => 'Invalid Order']);
        }

        return view('backend.order.completed_order_details')
            ->with(compact('common_data', 'order'));
    }

    public function showRejectedOrderList()
    {
        $common_data = new Array_();
        $common_data->title = 'Rejected Order';
        $common_data->sub_title = 'Rejected Order';
        $common_data->main_menu = 'rejected_orders';
        $common_data->sub_menu = '';
        $common_data->current_menu = '';

        $rejected_orders = Order::where('order_status', 3)->get();

        return view('backend.order.rejected_orders')
            ->with(compact('common_data', 'rejected_orders'));
    }

    public function showRejectedOrderDetails($order_id)
    {
        $common_data = new Array_();
        $common_data->title = 'Rejected Order';
        $common_data->sub_title = 'Rejected Order';
        $common_data->main_menu = 'rejected_orders';
        $common_data->sub_menu = '';
        $common_data->current_menu = '';

        $order = Order::where('id', $order_id)->where('order_status', 3)->first();
        if (empty($order)) {
            return redirect()->back()->with(['failed' => 'Invalid Order']);
        }

        return view('backend.order.rejected_order_details')
            ->with(compact('common_data', 'order'));
    }

}
