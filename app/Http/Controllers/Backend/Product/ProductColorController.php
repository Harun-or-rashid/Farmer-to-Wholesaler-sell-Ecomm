<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ProductColor\StoreProductColorPostRequest;
use App\Http\Requests\Backend\ProductColor\UpdateProductColorPostRequest;
use App\Models\ProductColor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Array_;

class ProductColorController extends Controller
{
    /*show all category list and create form*/
    public function index()
    {
        try {
            $common_data = new Array_();
            $common_data->title = 'Product Color';
            $common_data->sub_title = 'List';
            $common_data->main_menu = 'product_color';
            $common_data->sub_menu = 'product_color';
            $common_data->current_menu = 'product_color';

            $colors = ProductColor::where('deleted', 0)
                ->get();

            return view('backend.product_color.create')
                ->with(compact('common_data','colors'));

        } catch (\Exception $exception) {
            return redirect()->back()->with(['failed' => 'Something went wrong! Please Contact with admin']);
        }
    }

    /*post category form submit*/
    public function store(StoreProductColorPostRequest $request)
    {
        DB::beginTransaction();
        try {
            $color = new ProductColor();
            $color->title = $request->title;
            $color->color_code = $request->color_code;
            $color->status = 1;
            $color->created_at = Carbon::now();
            $color->created_by = Auth::guard('admin')->id();

            $color->save();

        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->withInput()->with(['failed' => 'Something went wrong to store Color! Please Contact with admin'. $exception->getMessage()]);
        }

        DB::commit();
        return redirect()->back()->with(['success' => 'Color Added Successfully.']);
    }


    /*get show edit form of Category*/
    public function edit($id)
    {
        try {
            $common_data = new Array_();
            $common_data->title = 'Product Color';
            $common_data->sub_title = 'Edit';
            $common_data->main_menu = 'product_color';
            $common_data->sub_menu = 'product_color';
            $common_data->current_menu = 'product_color';

            $colors = ProductColor::where('deleted', 0)->get();
            $edit_color = ProductColor::where('id', $id)->first();

            return view('backend.product_color.edit')
                ->with(compact('common_data','colors', 'edit_color'));

        } catch (\Exception $exception) {
            return redirect()->back()->with(['failed' => 'Something went wrong! Please Contact with admin']);
        }
    }



    /*post update customer*/
    public function update(UpdateProductColorPostRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $color = ProductColor::where('id', $id)
                ->where('deleted', 0)
                ->first();
            if (!empty($color)) {
                $color->title = $request->title;
                $color->color_code = $request->color_code;
                $color->status = 1;
                $color->updated_at = Carbon::now();
                $color->updated_by = Auth::guard('admin')->id();

                $color->save();
            } else {
                return redirect()->back()->withInput()->with(['failed' => 'Invalid Color']);
            }

        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->withInput()->with(['failed' => 'Something went wrong to Update Color! Please Contact with admin']);
        }

        DB::commit();
        return redirect()->route('backend.admin.product.color.index')->with(['success' => 'Color Updated Successfully.']);
    }
}
