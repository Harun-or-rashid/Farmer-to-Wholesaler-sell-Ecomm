<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductStock;
use Illuminate\Http\Request;

use Cart;
use PhpParser\Node\Expr\Array_;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
//        Cart::instance('shopping')->destroy();
        $product = Product::where('id', $request->product_id)->where('status', 1)->first();
        if (empty($product)) {
            return [
                'status' => 400,
                'text' => 'Invalid Product',
            ];
        }
        $stock = ProductStock::where('product_id', $request->product_id)
            ->where('product_color_id', $request->color_id)
            ->first();
        if (empty($stock)) {
            return [
                'status' => 401,
                'text' => 'Empty Stock',
            ];
        }

        $color = ProductColor::where('id', $stock->product_color_id)->first();
        if (empty($color)) {
            $colorName = '';
        } else {
            $colorName = $color->title;
        }

        $cart_data = Cart::instance('shopping')->content()->where('id', $stock->id)->first();

        if (!empty($cart_data)) {
            $qty = $request->qty + $cart_data->qty;
        } else {
            $qty = $request->qty;
        }
        if ($stock->available_quantity < $qty) {
            return [
                'status' => 402,
                'text' => 'Maximum Quantity is : '.$stock->available_quantity,
            ];
        }
        /*cart add($id, $name = null, $qty = null, $price = null, array $options = [])*/
        Cart::instance('shopping')->add([
            'id' => $stock->id,
            'name' => $product->title,
            'qty' => $request->qty,
            'price' => $product->sell_price,
            'weight' => 0,
            'options' => [
                'image' => $product->mainImage->image,
                'product_id' => $product->id,
                'product_slug' => $product->slug,
                'category_slug' => $product->category->slug,
                'color_id' => $request->color_id,
                'color' => $colorName
            ]
        ]);
        return [
            'status' => 200,
            'text' => 'Added Success',
        ];
    }

    public function getTopCartContent()
    {
        $cartContents = Cart::instance('shopping')->content();
        $totalQty = Cart::instance('shopping')->count();
        $totalPrice = Cart::instance('shopping')->subtotal();
        $view = view('frontend.layout_partials.ajax._ajax_top_cart_content')
            ->with(compact(
                'cartContents',
                'totalQty',
                'totalPrice'
            ))->render();
        return [
            'status' => 200,
            'totalQty' => $totalQty,
            'view' => $view
        ];
    }

    public function removeTopCartContent(Request $request)
    {
        Cart::instance('shopping')->remove($request->row_id);
        return response()->json([
            'message' => 'Remove Success',
            'status' => 200
        ]);
    }

    public function removeCart(Request $request)
    {
        $cart_data = Cart::instance('shopping')->content()->where('id', $request->cart_id)->first();
        Cart::instance('shopping')->remove($cart_data->rowId);
        return response()->json([
            'message' => 'Remove Success',
            'status' => 200
        ]);
    }


    public function getCartContent()
    {
        $cart_contents = Cart::instance('shopping')->content();
        $totalPrice = Cart::instance('shopping')->subtotal();
        $totalQty = Cart::instance('shopping')->count();

        $view = view('frontend.pages._ajax_get_cart_content')->with(compact(
            'cart_contents',
            'totalPrice'
        ))->render();
        return [
            'status' => 200,
            'view' => $view,
            'totalQty' => $totalQty
        ];
    }

    public function updateCartContentQuantity(Request $request)
    {
        $cart_data = Cart::instance('shopping')->content()->where('id', $request->cart_id)->first();
        $pre_quantity = $cart_data->qty;
        if ($request->type == 'increment') {
            $qty = $pre_quantity + 1;
        } else {
            if ($pre_quantity == 1) {
                Cart::instance('shopping')->remove($cart_data->rowId);
            } else {
                $qty = $pre_quantity - 1;
            }
        }
        Cart::instance('shopping')->update($cart_data->rowId, ['qty' => $qty]);
        return response()->json([
            'message' => 'Update Success',
            'status' => 200
        ]);
    }

    public function viewcart()
    {

        $common_data = new Array_();
        $common_data->title = 'Home';
        $common_data->sub_title = '';
        $common_data->main_menu = 'home';
        $common_data->sub_menu = 'home';
        $common_data->current_menu = 'home';

        $cart_contents = Cart::instance('shopping')->content();
        $totalPrice   = Cart::instance('shopping')->subtotal();
        $totalQty    = Cart::instance('shopping')->count();
//        dd($totalPrice);
       return view('frontend.pages.viewcart')->with(compact(
           'cart_contents',
           'totalPrice',
           'totalQty',
           'common_data'
       ))->render();
    }
}
