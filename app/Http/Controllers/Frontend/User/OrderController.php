<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Array_;

class OrderController extends Controller
{
    public function showMyOrderList()
    {
        if (!Auth::guard('customer')->check()) {
            return redirect()
                ->route('frontend.login-register', [
                    'redirect_to' => route('frontend.user.profile')
                ]);
        }
        $common_data = new Array_();
        $common_data->title = 'My Orders';
        $common_data->sub_title = '';
        $common_data->main_menu = 'my_orders';
        $common_data->sub_menu = 'my_orders';
        $common_data->current_menu = 'my_orders';

        $user = Auth::guard('customer')->user();
        $orders = Order::where('user_id', $user->id)
            ->where('deleted', 0)
            ->orderBy('id', 'DESC')
            ->get();

        return view('frontend.pages.user.my_order_list')
            ->with(compact(
                'common_data',
                'user',
                'orders'
            ));
    }
}
