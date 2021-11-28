<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Array_;

class DashboardController extends Controller
{
    /*get show dashboard page*/
    public function showDashboard()
    {
        $common_data = new Array_();
        $common_data->title = 'Dashboard';
        $common_data->sub_title = 'Dashboard';
        $common_data->main_menu = 'dashboard';
        $common_data->sub_menu = '';
        $common_data->current_menu = '';

        /*$new_orders = Order::where('order_status', 1)->count();
        $all_orders = Order::all()->count();
        $rejected_orders = Order::where('order_status', 3)->count();
        if ($rejected_orders == 0 ) {
            $bounce_rate = 0;
        } else {
            $bounce_rate = 100 / ($all_orders / $rejected_orders) ?? 0;
        }
        $bounce_rate = round($bounce_rate);

        $customer_count = User::whereIn('type', [2])->count();
        $unique_visitor = VisitorData::totalUniqueVisitor();*/
        return view('backend.dashboard',
            compact(
                'common_data'
            ));
    }
}
