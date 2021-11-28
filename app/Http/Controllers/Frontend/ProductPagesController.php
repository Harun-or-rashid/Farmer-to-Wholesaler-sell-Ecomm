<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductColor;
use App\Models\ProductStock;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Array_;

class ProductPagesController extends Controller
{
    public function showCategoryProducts($category_slug, $sub_category_slug=null)
    {
        $common_data = new Array_();
        $common_data->title = 'Category';
        $common_data->sub_title = '';
        $common_data->main_menu = 'category_products';
        $common_data->sub_menu = 'category_products';
        $common_data->current_menu = 'category_products';


        $product_category_ids = array();
        if ($sub_category_slug !== null) {
            $category = ProductCategory::where('slug', $sub_category_slug)
                ->where('status', 1)
                ->where('deleted', 0)
                ->first();
            if (empty($category)) {
                abort(404);
            }

        } else {
            $category = ProductCategory::where('slug', $category_slug)
                ->where('status', 1)
                ->where('deleted', 0)
                ->first();
            if (empty($category)) {
                return redirect()->back()->with(['failed' => 'Invalid Category']);
            }

            $product_category_ids = ProductCategory::allChilds($category->id);
        }

        $product_category_ids[] = $category->id;
        $products = Product::whereIn('product_category_id', $product_category_ids)
            ->where('status', 1)
            ->where('deleted', 0)
            ->get();

        return view('frontend.pages.category_products_grid_view')
            ->with(compact(
                'common_data',
                'category',
                'products'
            ));
    }

    public function showSearchProducts(Request $request)
    {
        $common_data = new Array_();
        $common_data->title = 'Category';
        $common_data->sub_title = '';
        $common_data->main_menu = 'category_products';
        $common_data->sub_menu = 'category_products';
        $common_data->current_menu = 'category_products';


        $products = Product::where(function ($q) use ($request) {
                if ($request->q != '') {
                    $q->where('title', 'like', '%'.$request->q.'%');
                    $q->orWhere('quick_text', 'like', '%'.$request->q.'%');
                    $q->orWhere('product_details', 'like', '%'.$request->q.'%');
                }
            })
            ->where('status', 1)
            ->where('deleted', 0)
            ->get();

        return view('frontend.pages.search_products_grid_view')
            ->with(compact(
                'common_data',
                'products'
            ));
    }


    public function showProductDetailsPage($category, $slug)
    {
        $common_data = new Array_();
        $common_data->title = 'Product Details';
        $common_data->sub_title = '';
        $common_data->main_menu = 'product_details';
        $common_data->sub_menu = 'product_details';
        $common_data->current_menu = 'product_details';

        $product = Product::where('slug', $slug)
            ->where('status', 1)
            ->where('deleted', 0)
            ->first();
        if (empty($product)) {
            return redirect()->back()->with(['failed' => 'Invalid Product']);
        }

        $available_product_color_ids = ProductStock::where('product_id', $product->id)
            ->where('available_quantity', '>', 0)
            ->where('status', 1)
            ->pluck('product_color_id');
        $available_product_colors = ProductColor::whereIn('id', $available_product_color_ids)
            ->get();
        $total_available_quantity = ProductStock::where('product_id', $product->id)
            ->where('status', 1)
            ->sum('available_quantity');

        return view('frontend.pages.product_details')
            ->with(compact(
                'common_data',
                'product',
                'available_product_colors',
                'total_available_quantity'
            ));
    }


    public function showUpcomingProductDetailsPage($category, $slug)
    {
        $common_data = new Array_();
        $common_data->title = 'Product Details';
        $common_data->sub_title = '';
        $common_data->main_menu = 'product_details';
        $common_data->sub_menu = 'product_details';
        $common_data->current_menu = 'product_details';

        $product = Product::where('slug', $slug)
            ->where('status', 1)
            ->where('deleted', 0)
            ->first();
        if (empty($product)) {
            return redirect()->back()->with(['failed' => 'Invalid Product']);
        }

        $available_product_color_ids = ProductStock::where('product_id', $product->id)
            ->where('available_quantity', '>', 0)
            ->where('status', 1)
            ->pluck('product_color_id');
        $available_product_colors = ProductColor::whereIn('id', $available_product_color_ids)
            ->get();
        $total_available_quantity = ProductStock::where('product_id', $product->id)
            ->where('status', 1)
            ->sum('available_quantity');

        return view('frontend.pages.product_details')
            ->with(compact(
                'common_data',
                'product',
                'available_product_colors',
                'total_available_quantity'
            ));
    }
}
