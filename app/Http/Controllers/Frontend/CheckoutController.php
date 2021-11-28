<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\OrderPlacedMail;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductStock;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Expr\Array_;
use Cart;

class CheckoutController extends Controller
{
    public function showCheckout()
    {
        if (!Auth::guard('customer')->check()) {
            return redirect()
                ->route('frontend.login-register', [
                    'redirect_to' => route('frontend.checkout')
                ]);
        }
        $common_data = new Array_();
        $common_data->title = 'Checkout';
        $common_data->sub_title = '';
        $common_data->main_menu = 'checkout';
        $common_data->sub_menu = 'checkout';
        $common_data->current_menu = 'checkout';

        $user = Auth::guard('customer')->user();

        $cart_contents = Cart::instance('shopping')->content();
        $totalPrice    = Cart::instance('shopping')->subtotal();
        $totalQty      = Cart::instance('shopping')->count();
        if ($totalQty < 1) {
            return redirect()->back()->with(['failed' => 'Empty Cart Content']);
        }
        return view('frontend.pages.checkout')->with(compact(
            'cart_contents',
            'totalPrice',
            'totalQty',
            'common_data',
            'user'
        ));
    }

    public function submitCheckout(Request $request)
    {

        if (!Auth::guard('customer')->check()) {
            return redirect()
                ->route('frontend.login-register', [
                    'redirect_to' => route('frontend.checkout')
                ]);
        }
        DB::beginTransaction();
        try {
            $user = Auth::guard('customer')->user();
            $cart_contents = Cart::instance('shopping')->content();
            $sub_total    = Cart::instance('shopping')->subtotal();
            $totalQty      = Cart::instance('shopping')->count();
            if ($totalQty < 1) {
                return redirect()->back()->with(['failed' => 'Empty Cart Content']);
            }

            $new_order_id = Order::getNewOrderId();
            $user_id = $user->id;

            $sub_total = str_replace(',', '', $sub_total);

            $product_discount = 0;
            $overall_discount = 0;
            $total_discount_amount = $product_discount + $overall_discount;

            $delivery_charge = 0;
            $total_payable_amount = $sub_total - $total_discount_amount + $delivery_charge;

            $order = new Order();
            $order->order_id = $new_order_id;
            $order->user_id = $user_id;
            $order->user_address_id = $request->address;
            $order->sub_total = $sub_total;
            $order->product_discount = $product_discount;
            $order->overall_discount = $overall_discount;
            $order->discount_reference = 0;
            $order->discount_type = 0;
            $order->total_discount = $total_discount_amount;
            $order->delivery_charge = $delivery_charge;
            $order->payable_amount = $total_payable_amount;
            $order->paid_amount = 0;
            $order->payment_method = 1;//1=Cash On Delivery
            $order->payment_status = 0;//0=pending
            $order->order_status = 1;
            $order->delivery_method = 1;//
            $order->delivery_status = 1;//1=Waiting For Received
            $order->status = 1;
            $order->created_at = Carbon::now();
            $order->created_by = $user_id;

            $order->save();

            foreach ($cart_contents as $content) {
                $product_stock = ProductStock::where('id', $content->id)->first();
                $product = Product::where('id', $product_stock->product_id)->first();

                $discount_amount = 0;
                $payable_amount = ($product->sell_price * $content->qty) - $discount_amount;
                $order_detail = new OrderDetail();

                $order_detail->order_id = $order->id;
                $order_detail->user_id = $user_id;
                $order_detail->product_id = $product_stock->product_id;
                $order_detail->stock_id = $product_stock->id;
                $order_detail->quantity = $content->qty;
                $order_detail->price = $product->sell_price;
                $order_detail->discount = $discount_amount;
                $order_detail->payable_amount = $payable_amount;
                $order_detail->product_type = 1;//1=product, 2=delivery charge
                $order_detail->status = 1;
                $order_detail->created_at = Carbon::now();
                $order_detail->created_by = $user_id;
                $order_detail->deleted = 0;

                $order_detail->save();
            }

            /*add delivery charge*/
            $order_detail = new OrderDetail();
            $order_detail->order_id = $order->id;
            $order_detail->user_id = $user_id;
            $order_detail->quantity = 1;
            $order_detail->price = $delivery_charge;
            $order_detail->discount = 0;
            $order_detail->payable_amount = $delivery_charge;
            $order_detail->product_type = 2;//1=product, 2=delivery charge
            $order_detail->status = 1;
            $order_detail->created_at = Carbon::now();
            $order_detail->created_by = $user_id;
            $order_detail->deleted = 0;
            $order_detail->save();

        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with(['failed' => 'Something went wrong. '. $exception->getMessage()]);
        }
        DB::commit();
        try {

            Mail::to($user->email)->send(new OrderPlacedMail($order));
            return redirect()->route('frontend.order.payment', $order->id)->with(['success' => 'Order Placed Success. You will receive a confirmation email soon!']);

        } catch (\Exception $exception) {
            return redirect()->back()->with(['warning' => 'Order Placed Success. But can\'t sent you email. '. $exception->getMessage()]);
        }
    }


    /*pre order*/
    public function showPreOrderCheckout(Request $request, $product_id)
    {
        if (isset($request->quantity)) {
            $quantity = $request->quantity;
        } else {
            $quantity = 1;
        }
        if (!Auth::guard('customer')->check()) {
            return redirect()
                ->route('frontend.login-register', [
                    'redirect_to' => route('frontend.place-pre-order', ['product_id' => $product_id, 'quantity' => $quantity])
                ]);
        }
        $common_data = new Array_();
        $common_data->title = 'Checkout';
        $common_data->sub_title = '';
        $common_data->main_menu = 'checkout';
        $common_data->sub_menu = 'checkout';
        $common_data->current_menu = 'checkout';

        $user = Auth::guard('customer')->user();

        $product = Product::where('id', $product_id)->where('status', 1)->where('deleted', 0)->first();
        if (empty($product)) {
            return redirect()->back()->with(['failed' => 'Invalid Product']);
        }
        if (!empty($product->stockAvailability)) {
            return redirect()->back()->with(['failed' => 'This product has stock. Please purchase it first']);
        }

        $totalQty      = $quantity;
        if ($totalQty < 1) {
            return redirect()->back()->with(['failed' => 'Empty Cart Content']);
        }
        return view('frontend.pages.pre_order_checkout')->with(compact(
            'product',
            'totalQty',
            'common_data',
            'user'
        ));
    }

    public function submitPreOrderCheckout(Request $request, $product_id)
    {
        if (!Auth::guard('customer')->check()) {
            return redirect()
                ->route('frontend.login-register', [
                    'redirect_to' => route('frontend.place-pre-order', ['product_id' => $product_id, 'quantity' => $quantity])
                ]);
        }
        DB::beginTransaction();
        try {
//            dd($request->all());
            $product = Product::where('id', $product_id)->where('status', 1)->where('deleted', 0)->first();
            if (empty($product)) {
                return redirect()->back()->with(['failed' => 'Invalid Product']);
            }
            if (!empty($product->stockAvailability)) {
                return redirect()->back()->with(['failed' => 'This product has stock. Please purchase it first']);
            }


            $user = Auth::guard('customer')->user();
            $totalQty      = $request->quantity;
            if ($totalQty < 1) {
                return redirect()->back()->with(['failed' => 'Empty Cart Content']);
            }

            $new_order_id = Order::getNewOrderId();
            $user_id = $user->id;

            $sub_total = $product->sell_price * $totalQty;

            $product_discount = 0;
            $overall_discount = 0;
            $total_discount_amount = $product_discount + $overall_discount;

            $delivery_charge = 0;
            $total_payable_amount = $sub_total - $total_discount_amount + $delivery_charge;

            $order = new Order();
            $order->order_id = $new_order_id;
            $order->user_id = $user_id;
            $order->user_address_id = $request->address;
            $order->order_type = 2;
            $order->sub_total = $sub_total;
            $order->product_discount = $product_discount;
            $order->overall_discount = $overall_discount;
            $order->discount_reference = 0;
            $order->discount_type = 0;
            $order->total_discount = $total_discount_amount;
            $order->delivery_charge = $delivery_charge;
            $order->payable_amount = $total_payable_amount;
            $order->paid_amount = 0;
            $order->payment_method = 1;//1=Cash On Delivery
            $order->payment_status = 0;//0=pending
            $order->order_status = 1;
            $order->delivery_method = 1;//
            $order->delivery_status = 1;//1=Waiting For Received
            $order->status = 1;
            $order->created_at = Carbon::now();
            $order->created_by = $user_id;

            $order->save();


            $discount_amount = 0;
            $payable_amount = $sub_total;
            $order_detail = new OrderDetail();

            $order_detail->order_id = $order->id;
            $order_detail->user_id = $user_id;
            $order_detail->product_id = $product->id;
            $order_detail->stock_id = 0;
            $order_detail->quantity = $totalQty;
            $order_detail->price = $product->sell_price;
            $order_detail->discount = $discount_amount;
            $order_detail->payable_amount = $payable_amount;
            $order_detail->product_type = 1;//1=product, 2=delivery charge
            $order_detail->status = 1;
            $order_detail->created_at = Carbon::now();
            $order_detail->created_by = $user_id;
            $order_detail->deleted = 0;

            $order_detail->save();

            /*add delivery charge*/
            $order_detail = new OrderDetail();
            $order_detail->order_id = $order->id;
            $order_detail->user_id = $user_id;
            $order_detail->quantity = 1;
            $order_detail->price = $delivery_charge;
            $order_detail->discount = 0;
            $order_detail->payable_amount = $delivery_charge;
            $order_detail->product_type = 2;//1=product, 2=delivery charge
            $order_detail->status = 1;
            $order_detail->created_at = Carbon::now();
            $order_detail->created_by = $user_id;
            $order_detail->deleted = 0;
            $order_detail->save();

        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with(['failed' => 'Something went wrong. '. $exception->getMessage()]);
        }
        DB::commit();
        try {

            Mail::to($user->email)->send(new OrderPlacedMail($order));
            return redirect()->route('frontend.order.payment', $order->id)->with(['success' => 'Order Placed Success. You will receive a confirmation email soon!']);

        } catch (\Exception $exception) {
            return redirect()->back()->with(['warning' => 'Order Placed Success. But can\'t sent you email. '. $exception->getMessage()]);
        }
    }
}












