<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Models\Order;
use App\Models\PaymentDetail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Array_;

class OrderPaymentController extends Controller
{
    public function showPaymentPage($order_id)
    {
        if (!Auth::guard('customer')->check()) {
            return redirect()
                ->route('frontend.login-register', [
                    'redirect_to' => route('frontend.checkout')
                ]);
        }
        $common_data = new Array_();
        $common_data->title = 'Order Payment';
        $common_data->sub_title = '';
        $common_data->main_menu = 'payment';
        $common_data->sub_menu = 'payment';
        $common_data->current_menu = 'payment';

        $user = Auth::guard('customer')->user();

        $order = Order::where('id', $order_id)->where('user_id', $user->id)->first();
        if (empty($order)) {
            abort(404, 'Invalid Order');
        }

        if ($order->payment_status == 1) {
            return redirect()->back()->with(['warning' => 'Already paid for this order.']);
        }

        $payable_amount = $order->payable_amount - $order->paid_amount;

        return view('frontend.pages.order_payment')->with(compact(
            'common_data',
            'payable_amount',
            'order'
        ));
    }


    public function makeOrderPayment($order_id, Request $request)
    {
        if (!Auth::guard('customer')->check()) {
            return redirect()
                ->route('frontend.login-register', [
                    'redirect_to' => route('frontend.checkout')
                ]);
        }


        $user = Auth::guard('customer')->user();

        $order = Order::where('id', $order_id)->where('user_id', $user->id)->first();
        if (empty($order)) {
            abort(404, 'Invalid Order');
        }

        if ($order->payment_status == 1) {
            return redirect()->back()->with(['warning' => 'Already paid for this order.']);
        }

        if ($request->payment == 1) {
            return redirect()->route('frontend.home')->with(['success' => 'Order Placed Success']);
        }

        $order->payment_method = $request->payment;
        $order->save();

        $payable_amount = $order->payable_amount - $order->paid_amount;
        if ($payable_amount < 10) {
            return redirect()->back()->with(['failed' => 'You cant not pay less than 10 tk']);
        }


        $available_emi = false;
        if (count($order->orderDetailsProduct) == 1) {
            $order_details = $order->orderDetails->first();
            if ($order_details->product->emi_available == 1) {
                if ($payable_amount >= 5000) {
                    $available_emi = true;
                }

            }
        }


        $payment_post_data = $this->makePaymentPostData($order->id, $user, $available_emi);
//        dd($payment_post_data);
        $sslc = new SslCommerzNotification();
        $payment_options = $sslc->makePayment($payment_post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }


    public function successPayment(Request $request)
    {

        DB::beginTransaction();
        try {
            $payment = new PaymentDetail();

            $payment->tran_id = $request->tran_id;
            $payment->order_id = $request->value_a;
            $payment->val_id = $request->val_id;
            $payment->amount = $request->amount;
            $payment->store_amount = $request->store_amount;
            $payment->card_type = $request->card_type;
            $payment->card_no = $request->card_no;
            $payment->bank_tran_id = $request->bank_tran_id;
            $payment->transaction_status = $request->status;
            $payment->tran_date = $request->tran_date;
            $payment->error = $request->error;
            $payment->currency = $request->currency;
            $payment->card_issuer = $request->card_issuer;
            $payment->card_brand = $request->card_brand;
            $payment->card_sub_brand = $request->card_sub_brand;
            $payment->card_issuer_country = $request->card_issuer_country;
            $payment->card_issuer_country_code = $request->card_issuer_country_code;
            $payment->store_id = $request->store_id;
            $payment->currency_type = $request->currency_type;
            $payment->currency_amount = $request->currency_amount;
            $payment->currency_rate = $request->currency_rate;
            $payment->base_fair = $request->base_fair;
            $payment->risk_level = $request->risk_level;
            $payment->risk_title = $request->risk_title;
            $payment->status = 1;
            $payment->created_at = Carbon::now();
            $payment->created_by = $request->value_b;

            $payment->save();

            $order = Order::find($request->value_a);
            if (!empty($order)) {
                $order->paid_amount = ($order->paid_amount + $request->amount);

                if ($order->due_amount > $request->amount) {
                    $order->payment_status = 2;
                } else {
                    $order->payment_status = 1;
                }
                $order->save();
            }

        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with(['warning' => 'Something went wrong. please contact with admin. '.$exception->getMessage()]);
        }
        DB::commit();
        return redirect()->route('frontend.home')->with(['success' => 'Payment Success']);
    }

    public function failedPayment(Request $request)
    {
        /*dump("failed");
        $request->dd();*/
        $order = Order::find($request->value_a);
        if (!empty($order)) {
            return redirect()->route('frontend.order.payment', $order->id)->with(['failed' => 'Payment Failed']);
        } else {
            return redirect()->route('frontend.home')->with(['failed' => 'Payment Failed']);
        }
    }

    public function cancelPayment(Request $request)
    {
        /*dump("cancel");
        $request->dd();*/
        $order = Order::find($request->value_a);
        if (!empty($order)) {
            return redirect()->route('frontend.order.payment', $order->id)->with(['failed' => 'Payment Canceled']);
        } else {
            return redirect()->route('frontend.home')->with(['failed' => 'Payment Canceled']);
        }
    }

    public function ipnPayment(Request $request)
    {
        /*dump("ipn");
        $request->dd();*/
    }

    public function makePaymentPostData($order_id, $user, $available_emi=false)
    {
        $order = Order::where('id', $order_id)->where('user_id', $user->id)->first();
        $payable_amount = $order->payable_amount - $order->paid_amount;
        $tran_id = PaymentDetail::getNewTranId();

        $post_data = array();
        $post_data['total_amount'] = $payable_amount; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = $tran_id; // tran_id must be unique

        $address = $order->orderAddress;

        if ($available_emi === true) {
            $post_data['emi_option'] = 1;
            $post_data['emi_max_inst_option'] = 9;
        }
        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $user->full_name;
        $post_data['cus_email'] = $user->email;
        $post_data['cus_add1'] = @$user->defaultAddress->address;
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = @$user->defaultAddress->division->name;
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = @$user->defaultAddress->post_code;
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = @$user->defaultAddress->address;
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = $address->full_name;
        $post_data['ship_add1'] = $address->address;
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = $address->division->name;
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = $address->post_code;
        $post_data['ship_phone'] = $address->phone_number;
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Multi Products";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = $order->id;
        $post_data['value_b'] = $user->id;
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";

        return $post_data;
    }

    public function myorders()
    {

        $user = Auth::guard('customer')->user();
        $users=new  User();
        $orders=$users->myorders()->get();
dd($orders);
//        foreach ($orders as $od){
//var_dump($od);
//        }
    }
}
