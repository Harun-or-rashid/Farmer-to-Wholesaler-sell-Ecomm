<?php

namespace App\Http\Controllers\Backend\Product;

use App\Helpers\CommonHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ProductCategory\StoreProductCategoryPostRequest;
use App\Http\Requests\Backend\ProductCategory\UpdateProductCategoryPostRequest;
use App\Models\ProductCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Array_;

class ProductCategoryController extends Controller
{
    /*show all category list and create form*/
    public function index()
    {
        try {
            $common_data = new Array_();
            $common_data->title = 'Product Category';
            $common_data->sub_title = 'List';
            $common_data->main_menu = 'product_category';
            $common_data->sub_menu = 'product_category';
            $common_data->current_menu = 'product_category';

            $categories = ProductCategory::where('parent_id', '=', 0)
                ->where('deleted', 0)
                ->get();

            $allCategories = ProductCategory::all();

            return view('backend.product_category.create')
                ->with(compact('common_data','categories', 'allCategories'));

        } catch (\Exception $exception) {
            return redirect()->back()->with(['failed' => 'Something went wrong! Please Contact with admin']);
        }
    }

    /*post category form submit*/
    public function store(StoreProductCategoryPostRequest $request)
    {
        DB::beginTransaction();
        try {
            $auth_user = Auth::guard('admin')->user();
            $category = new ProductCategory();
            $category->title = $request->title;
            $category->parent_id = $request->parent_id ?? 0;
            $category->featured = $request->featured ?? 0;

            if ($request->hasFile('image')) {
                $name = "category_image_" . $auth_user->id . rand(1000, 9999) . "." . $request->file('image')->extension();
                $image_url = CommonHelper::uploadFile($request->file('image'), $name, 'category');
                $category->image = $image_url;
            }

            $category->status = 1;
            $category->created_at = Carbon::now();
            $category->created_by = Auth::guard('admin')->id();

            $category->save();

        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->withInput()->with(['failed' => 'Something went wrong to store category! Please Contact with admin']);
        }

        DB::commit();
        return redirect()->back()->with(['success' => 'Category Added Successfully.']);
    }


    /*get show edit form of Category*/
    public function edit($id)
    {
        try {
            $common_data = new Array_();
            $common_data->title = 'Product Category';
            $common_data->sub_title = 'List';
            $common_data->main_menu = 'product_category';
            $common_data->sub_menu = 'product_category';
            $common_data->current_menu = 'product_category';

            $categories = ProductCategory::where('parent_id', '=', 0)->get();
            $edit_category = ProductCategory::where('id', $id)->first();

            $edit_category_childs = ProductCategory::allChilds($id);
//            dd($edit_category_childs);
            $allCategories = ProductCategory::all();

            return view('backend.product_category.edit')
                ->with(compact('common_data','categories', 'allCategories', 'edit_category', 'edit_category_childs'));

        } catch (\Exception $exception) {
            return redirect()->back()->with(['failed' => 'Something went wrong! Please Contact with admin']);
        }
    }



    /*post update customer*/
    public function update(UpdateProductCategoryPostRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $category = ProductCategory::where('id', $id)
                ->where('deleted', 0)
                ->first();
            if (!empty($category)) {
                $auth_user = Auth::guard('admin')->user();

                $category->title = $request->title;
                $category->parent_id = $request->parent_id ?? 0;
                $category->featured = $request->featured ?? 0;

                if ($request->hasFile('image')) {
                    $name = "category_image_" . $auth_user->id . rand(1000, 9999) . "." . $request->file('image')->extension();
                    $image_url = CommonHelper::uploadFile($request->file('image'), $name, 'category');
                    $category->image = $image_url;
                }

                $category->status = 1;
                $category->created_at = Carbon::now();
                $category->created_by = Auth::guard('admin')->id();

                $category->save();
            } else {
                return redirect()->back()->withInput()->with(['failed' => 'Invalid Category']);
            }

        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->withInput()->with(['failed' => 'Something went wrong to Update category! Please Contact with admin']);
        }

        DB::commit();
        return redirect()->route('backend.admin.product.category.index')->with(['success' => 'Category Updated Successfully.']);
    }


    /*delete destroy customer*/
    public function destroy($id)
    {
        DB::beginTransaction();
        try {


        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->with(['failed' => 'Something went wrong!']);
        }

        DB::commit();
        return redirect()->route('backend.admin.product.category.index')->with(['success' => 'Category Deleted Successfully.']);
    }
}
