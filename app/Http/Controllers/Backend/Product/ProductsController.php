<?php

namespace App\Http\Controllers\Backend\Product;

use App\Helpers\CommonHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Product\StoreProductPostRequest;
use App\Http\Requests\Backend\Product\UpdateProductPostRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Array_;

class ProductsController extends Controller
{
    /*show all product list*/
    public function index()
    {
        try {
            $common_data = new Array_();
            $common_data->title = 'Product';
            $common_data->sub_title = 'List';
            $common_data->main_menu = 'product';
            $common_data->sub_menu = 'product';
            $common_data->current_menu = 'product_list';

            $products = Product::where('deleted', 0)->get();

            return view('backend.product.index')
                ->with(compact('common_data','products'));

        } catch (\Exception $exception) {
            return redirect()->back()->with(['failed' => 'Something went wrong! Please Contact with admin']);
        }
    }

    /*get show product create form*/
    public function create()
    {
        $common_data = new Array_();
        $common_data->title = 'Product';
        $common_data->sub_title = 'Product Create';
        $common_data->main_menu = 'product';
        $common_data->sub_menu = 'product';
        $common_data->current_menu = 'product_create';

        $categories = ProductCategory::where('deleted', 0)
            ->where('status', 1)
            ->where('parent_id', 0)
            ->get();

        return view('backend.product.create')
            ->with(compact('common_data',  'categories'));
    }

    /*post product form submit*/
    public function store(StoreProductPostRequest $request)
    {
        DB::beginTransaction();
        try {
            $auth_user = Auth::guard('admin')->user();
            $product = new Product();
            $product->product_category_id = $request->sub_category ?? $request->category;
            $product->title = $request->title;
            $product->quick_text = $request->short_text;
            $product->product_details = $request->description;
            $product->product_price = $request->price;
            $product->sell_price = $request->sell_price;
            $product->featured = $request->featured ?? 0;
            $product->emi_available = $request->emi ?? 0;
            $product->published = $request->published ?? 1;
            $product->upcoming_text = $request->upcoming_text;
            $product->slider = $request->slider ?? 0;
            $product->status = 1;
            $product->created_at = Carbon::now();
            $product->created_by = Auth::guard('admin')->id();

            $product->save();


            if (isset($request->images) && !empty($request->images)) {
                for ($i=0;$i<count($request->images);$i++) {
                    if ($request->hasFile('images.' . $i)) {
                        $name = "product_image_" . $auth_user->id . rand(1000, 9999) . "." . $request->file('images.' . $i)->extension();
                        $image_url = CommonHelper::uploadFile($request->file('images.'.$i), $name, 'product');


                        $product_gallery_image = new ProductImage();
                        $product_gallery_image->product_id = $product->id;
                        $product_gallery_image->image = $image_url;
                        $product_gallery_image->image_type = ($i == 0) ? 1 : 2;
                        $product_gallery_image->status = 1;
                        $product_gallery_image->created_at = Carbon::now();
                        $product_gallery_image->created_by = Auth::guard('admin')->id();

                        $product_gallery_image->save();
                    }
                }

            }

        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->withInput()->with(['failed' => 'Something went wrong to store Product! Please Contact with admin'.$exception->getMessage()]);
        }

        DB::commit();
        return redirect()->route('backend.admin.products.index')->with(['success' => 'Product Added Successfully.']);
    }


    /*get show customer details*/
    public function show($id)
    {
        try {
            /*set common data*/
            $common_data = new Array_();
            $common_data->title = 'Product';
            $common_data->sub_title = 'List';
            $common_data->main_menu = 'product';
            $common_data->sub_menu = 'product';
            $common_data->current_menu = 'product';

            /*find Product*/
            $product = Product::where('id', $id)
                ->where('deleted', 0)
                ->first();
            if (!empty($product)) {
                $product_image = ProductImage::where('product_id', $id)
                    ->where('image_type', 1)
                    ->where('deleted', 0)
                    ->first();
//                dd($product_image);
                $product_gallery_images = ProductImage::where('product_id', $id)
                    ->where('image_type', 2)
                    ->where('deleted', 0)
                    ->get();
                return view('backend.product.show')
                    ->with(compact('common_data', 'product', 'product_image', 'product_gallery_images'));
            } else {
                return redirect()->back()->with(['failed' => 'Invalid Product']);
            }

        } catch (\Exception $exception) {
            return redirect()->back()->with(['failed' => 'Something went wrong!'.$exception->getMessage()]);
        }
    }


    /*get show edit form of Customer*/
    public function edit($id)
    {
        try {
            /*set common data*/
            $common_data = new Array_();
            $common_data->title = 'Product';
            $common_data->sub_title = 'Edit';
            $common_data->main_menu = 'product';
            $common_data->sub_menu = 'product';
            $common_data->current_menu = 'product_create';

            $product = Product::where('id', $id)
                ->where('deleted', 0)
                ->first();
            if (empty($product)) {
                return redirect()->back()->with(['failed' => 'Invalid Product']);
            }
            $product_images = ProductImage::where('product_id', $id)
                ->where('deleted', 0)
                ->get();

            $categories = ProductCategory::where('deleted', 0)
                ->where('status', 1)
                ->where('parent_id', 0)
                ->get();
            $sub_categories = ProductCategory::where('deleted', 0)
                ->where('status', 1)
                ->where('parent_id', $product->category->parent_id)
                ->get();

            return view('backend.product.edit')
                ->with(compact('common_data',
                    'product',
                    'product_images',
                    'categories',
                    'sub_categories'
                ));


        } catch (\Exception $exception) {
            return redirect()->back()->with(['failed' => 'Something went wrong! '.$exception->getMessage()]);
        }
    }



    /*post update customer*/
    public function update(UpdateProductPostRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $auth_user = Auth::guard('admin')->user();
            $product = Product::where('id', $id)
                ->where('deleted', 0)
                ->first();
            if (!empty($product)) {

                $product->product_category_id = $request->sub_category ?? $request->category;
                $product->title = $request->title;
                $product->quick_text = $request->short_text;
                $product->product_details = $request->description;
                $product->product_price = $request->price;
                $product->sell_price = $request->sell_price;
                $product->featured = $request->featured ?? 0;
                $product->slider = $request->slider ?? 0;
                $product->status = $request->status;
                $product->updated_at = Carbon::now();
                $product->updated_by = Auth::guard('admin')->id();

                $product->save();

                $pre_image_id = [];
                if (!empty($request->pre_image_id) && is_array($request->pre_image_id)) {
                    $pre_image_id[] = $request->pre_image_id;
                }
                /*delete previous images*/
                ProductImage::where('product_id', $id)->whereNotIn('id', $pre_image_id)->delete();

                /*add new images*/
                if (isset($request->images) && !empty($request->images)) {
                    for ($i=0;$i<count($request->images);$i++) {
                        if ($request->hasFile('images.' . $i)) {
                            $name = "product_image_" . $auth_user->id . rand(1000, 9999) . "." . $request->file('images.' . $i)->extension();
                            $image_url = CommonHelper::uploadFile($request->file('images.'.$i), $name, 'product');

                            $product_gallery_image = new ProductImage();
                            $product_gallery_image->product_id = $product->id;
                            $product_gallery_image->image = $image_url;
                            $product_gallery_image->image_type = 2;
                            $product_gallery_image->status = 1;
                            $product_gallery_image->created_at = Carbon::now();
                            $product_gallery_image->created_by = Auth::guard('admin')->id();

                            $product_gallery_image->save();
                        }
                    }
                }

                $primary_img_check = ProductImage::where('product_id', $id)->where('image_type', 1)->first();
                if (empty($primary_img_check)) {
                    $first_img = ProductImage::where('product_id', $id)->first();
                    if (empty($first_img)) {
                        DB::rollback();
                        return redirect()->back()->with(['failed' => 'Image Field Required']);
                    } else {
                        $first_img->image_type = 1;
                        $first_img->save();
                    }
                }



            } else {
                return redirect()->back()->withInput()->with(['failed' => 'Invalid Product']);
            }

        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->with(['failed' => 'Something went wrong!'.$exception->getMessage()]);
        }

        DB::commit();
        return redirect()->route('backend.admin.products.index')->with(['success' => 'Product Updated Successfully.']);
    }


    /*delete destroy customer*/
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            /*find customer*/
            $product = Product::where('id', $id)
                ->where('deleted', 0)
                ->first();
            if (!empty($product)) {
                $product->status = 0;
                $product->deleted = 1;
                $product->deleted_at = Carbon::now();
                $product->deleted_by = Auth::id();

                $product->save();

            } else {
                return redirect()->back()->with(['failed' => 'Invalid Product']);
            }

        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->with(['failed' => 'Something went wrong!']);
        }

        DB::commit();
        return redirect()->route('backend.admin.products.index')->with(['success' => 'Product Deleted Successfully.']);
    }


    /*get sub categories by selecting category by ajax*/
    public function getSubCategoriesByCategory(Request $request)
    {
        try {

            $sub_categories = ProductCategory::where('deleted', 0)
                ->where('status', 1)
                ->where('parent_id', $request->category_id)
                ->get();
            return view('backend.product._get_sub_categories')
                ->with(compact('sub_categories'));

        } catch (\Exception $exception) {
            return $exception->getMessage();
            $sub_categories = array();
            return $sub_categories;
        }
    }
}
