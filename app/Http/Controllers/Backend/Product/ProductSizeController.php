<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ProductSize\StoreProductSizePostRequest;
use App\Http\Requests\Backend\ProductSize\UpdateProductSizePostRequest;
use App\Models\ProductSize;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Array_;

class ProductSizeController extends Controller
{
    /*show all category list and create form*/
    public function index()
    {
        try {
            $common_data = new Array_();
            $common_data->title = 'Product Size';
            $common_data->sub_title = 'List';
            $common_data->main_menu = 'product_size';
            $common_data->sub_menu = 'product_size';
            $common_data->current_menu = 'product_size';

            $sizes = ProductSize::where('deleted', 0)
                ->get();

            return view('backend.product_size.create')
                ->with(compact('common_data','sizes'));

        } catch (\Exception $exception) {
            return redirect()->back()->with(['failed' => 'Something went wrong! Please Contact with admin']);
        }
    }

    /*post category form submit*/
    public function store(StoreProductSizePostRequest $request)
    {
        DB::beginTransaction();
        try {
            $size = new ProductSize();
            $size->title = $request->title;
            $size->status = 1;
            $size->created_at = Carbon::now();
            $size->created_by = Auth::guard('admin')->id();

            $size->save();

        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->withInput()->with(['failed' => 'Something went wrong to store category! Please Contact with admin']);
        }

        DB::commit();
        return redirect()->back()->with(['success' => 'Size Added Successfully.']);
    }


    /*get show edit form of Category*/
    public function edit($id)
    {
        try {
            $common_data = new Array_();
            $common_data->title = 'Product Size';
            $common_data->sub_title = 'Edit';
            $common_data->main_menu = 'product_size';
            $common_data->sub_menu = 'product_size';
            $common_data->current_menu = 'product_size';

            $sizes = ProductSize::where('deleted', 0)->get();
            $edit_size = ProductSize::where('id', $id)->first();

            return view('backend.product_size.edit')
                ->with(compact('common_data','sizes', 'edit_size'));

        } catch (\Exception $exception) {
            return redirect()->back()->with(['failed' => 'Something went wrong! Please Contact with admin']);
        }
    }



    /*post update customer*/
    public function update(UpdateProductSizePostRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $size = ProductSize::where('id', $id)
                ->where('deleted', 0)
                ->first();
            if (!empty($size)) {
                $size->title = $request->title;
                $size->status = 1;
                $size->updated_at = Carbon::now();
                $size->updated_by = Auth::guard('admin')->id();

                $size->save();
            } else {
                return redirect()->back()->withInput()->with(['failed' => 'Invalid Size']);
            }

        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->withInput()->with(['failed' => 'Something went wrong to Update Size! Please Contact with admin']);
        }

        DB::commit();
        return redirect()->route('backend.product.size.index')->with(['success' => 'Size Updated Successfully.']);
    }
}
