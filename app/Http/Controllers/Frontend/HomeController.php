<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Array_;

class HomeController extends Controller
{
    public function showHomePage()
    {
        $common_data = new Array_();
        $common_data->title = 'Home';
        $common_data->sub_title = '';
        $common_data->main_menu = 'home';
        $common_data->sub_menu = 'home';
        $common_data->current_menu = 'home';

        $featured_categories = ProductCategory::where('parent_id', 0)
            ->where('featured', 1)
            ->where('status', 1)
            ->where('deleted', 0)
            ->take(3)
            ->get();
        $featured_products = Product::where('status', 1)
            ->where('deleted', 0)
            ->where('featured', 1)
            ->where('published', 1)
            ->take(10)
            ->get();
        $slider_products = Product::where('status', 1)
            ->where('deleted', 0)
            ->where('slider', 1)
            ->take(10)
            ->get();

        $top_selling_products = Product::where('status', 1)
            ->where('deleted', 0)
            ->where('featured', 1)
            ->where('published', 1)
            ->orderBy('total_sell', 'DESC')
            ->take(8)
            ->get();

        $upcoming_products = Product::where('status', 1)
            ->where('deleted', 0)
            ->where('featured', 1)
            ->where('published', 2)
            ->orderBy('total_sell', 'DESC')
            ->take(8)
            ->get();

        return view('frontend.home')
            ->with(compact(
                'common_data',
                'featured_categories',
                'featured_products',
                'top_selling_products',
                'upcoming_products',
                'slider_products'
            ));
    }
}
