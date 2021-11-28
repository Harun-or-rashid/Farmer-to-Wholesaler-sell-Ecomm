<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ProductStock\StoreProductStockPostRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductColor;
use App\Models\ProductImage;
use App\Models\ProductStock;
use App\Models\ProductStockInputHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Array_;

class ProductStockController extends Controller
{
    /*show all product list*/
    public function index()
    {
        try {
            $common_data = new Array_();
            $common_data->title = 'Product Quantity';
            $common_data->sub_title = 'List';
            $common_data->main_menu = 'product_quantity';
            $common_data->sub_menu = 'product_quantity';
            $common_data->current_menu = 'product_quantity';

            $products = Product::where('deleted', 0)->where('published', 1)->get();

            return view('backend.product_stock.index')
                ->with(compact('common_data','products'));

        } catch (\Exception $exception) {
            return redirect()->back()->with(['failed' => 'Something went wrong! Please Contact with admin']);
        }
    }

    /*get show product create form*/
    public function create()
    {
        $common_data = new Array_();
        $common_data->title = 'Product Quantity';
        $common_data->sub_title = 'Create';
        $common_data->main_menu = 'product_quantity';
        $common_data->sub_menu = 'product_quantity';
        $common_data->current_menu = 'product_quantity';

        $product_categories = ProductCategory::where('deleted', 0)
            ->where('status', 1)
            ->where('parent_id', 0)
            ->get();
        $product_colors = ProductColor::where('deleted', 0)
            ->where('status', 1)
            ->get();

        return view('backend.product_stock.create')
            ->with(compact('common_data',
                'product_categories',
                'product_colors'
            ));
    }

    /*post product form submit*/
    public function store(StoreProductStockPostRequest $request)
    {
        DB::beginTransaction();
        try {
            $auth_user = Auth::guard('admin')->user();

            $product = Product::where('id', $request->product)->where('status', 1)->first();
            if (empty($product)) {
                return redirect()->back()->with(['failed' => 'Invalid Product']);
            }
            $total_product_available_qty = $product->available_qty;
            if (!empty($request->quantity) && is_array($request->quantity)) {
                for ($i=0; $i<count($request->quantity); $i++) {

                    $product_stock = ProductStock::where('product_id', $request->product)
                        ->where('product_color_id', $request->product_color[$i])
                        ->where('status', 1)
                        ->first();
                    if (empty($product_stock)) {
                        $product_stock = new ProductStock();
                        $product_stock->status = 1;
                        $product_stock->created_at = Carbon::now();
                        $product_stock->created_by = $auth_user->id;

                        $available_qty = $request->quantity[$i];
                        $total_qty = $request->quantity[$i];
                    } else {
                        $product_stock->updated_at = Carbon::now();
                        $product_stock->updated_by = $auth_user->id;

                        $available_qty = $product_stock->available_quantity + $request->quantity[$i];
                        $total_qty = $product_stock->total_quantity + $request->quantity[$i];
                    }

                    $product_stock->product_id = $request->product;
                    $product_stock->product_color_id = $request->product_color[$i] ?? 0;
                    $product_stock->total_quantity = $total_qty;
                    $product_stock->available_quantity = $available_qty;

                    $product_stock->save();

                    $total_product_available_qty += $request->quantity[$i];

                    $product_stock_history = new ProductStockInputHistory();
                    $product_stock_history->product_stock_id = $product_stock->id;
                    $product_stock_history->product_id = $request->product;
                    $product_stock_history->product_color_id = $request->product_color[$i] ?? 0;
                    $product_stock_history->total_quantity = $total_qty;
                    $product_stock_history->status = 1;
                    $product_stock_history->created_at = Carbon::now();
                    $product_stock_history->created_by = $auth_user->id;
                    $product_stock_history->save();

                }
            }


        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->withInput()->with(['failed' => 'Something went wrong to store Product Quantity! Please Contact with admin. '. $exception->getMessage()]);
        }

        DB::commit();
        return redirect()->route('backend.admin.products.index')->with(['success' => 'Product Quantity Added Successfully.']);
    }


    /*get show customer details*/
    public function show($id)
    {
        try {
            /*set common data*/
            $common_data = new Array_();
            $common_data->title = 'Product Quantity';
            $common_data->sub_title = 'Details';
            $common_data->main_menu = 'product_quantity';
            $common_data->sub_menu = 'product_quantity';
            $common_data->current_menu = 'product_quantity';

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
            $common_data->title = 'Product Quantity';
            $common_data->sub_title = 'Edit';
            $common_data->main_menu = 'product_quantity';
            $common_data->sub_menu = 'product_quantity';
            $common_data->current_menu = 'product_quantity';

            $product = Product::where('id', $id)
                ->where('deleted', 0)
                ->where('rejected', 0)
                ->first();
            if (!empty($product)) {
                $product_image = ProductImage::where('product_id', $id)
                    ->where('image_type', 1)
                    ->where('deleted', 0)
                    ->first();
                $product_gallery_images = ProductImage::where('product_id', $id)
                    ->where('image_type', 2)
                    ->where('deleted', 0)
                    ->get();
                $vendors = VendorDetail::where('status', 1)
                    ->get();
                $gallery_images = GalleryImage::where('status', 1)->get();

                $categories = ProductCategory::where('deleted', 0)
                    ->where('status', 1)
                    ->where('parent_id', 0)
                    ->get();
                $sub_categories = ProductCategory::where('deleted', 0)
                    ->where('status', 1)
                    ->where('parent_id', $product->category->parent->parent_id)
                    ->get();
                $sub_sub_categories = ProductCategory::where('deleted', 0)
                    ->where('status', 1)
                    ->where('parent_id', $product->category->parent_id)
                    ->get();

                return view('backend.admin.product.products.edit')
                    ->with(compact('common_data',
                        'product',
                        'vendors',
                        'gallery_images',
                        'product_image',
                        'product_gallery_images',
                        'categories',
                        'sub_categories',
                        'sub_sub_categories'
                    ));
            } else {
                return redirect()->back()->with(['failed' => 'Invalid Product']);
            }

        } catch (\Exception $exception) {
            return redirect()->back()->with(['failed' => 'Something went wrong! '.$exception->getMessage()]);
        }
    }



    /*post update customer*/
    public function update(UpdateProductPostRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $product = Product::where('id', $id)
                ->where('rejected', 0)
                ->where('deleted', 0)
                ->first();
            if (!empty($product)) {

                $product->vendor_id = $request->vendor;
                $product->product_category_id = $request->sub_sub_category;
                $product->title = $request->title;
                $product->quick_text = $request->short_text;
                $product->product_details = $request->description;
                $product->status = $request->status;
                $product->updated_at = Carbon::now();
                $product->updated_by = Auth::guard('admin')->id();

                $product->save();

                /*delete previous images*/
                ProductImage::where('product_id', $id)->delete();

                /*add new images*/
                if ($request->product_image != '') {
                    $product_image = new ProductImage();
                    $product_image->product_id = $product->id;
                    $product_image->gallery_image_id = $request->product_image;
                    $product_image->image_type = 1;
                    $product_image->status = 1;
                    $product_image->created_at = Carbon::now();
                    $product_image->created_by = Auth::guard('admin')->id();

                    $product_image->save();
                }
                if (isset($request->product_gallery_image) && !empty($request->product_gallery_image)) {
                    foreach ($request->product_gallery_image as $gallery_image_id) {
                        $product_gallery_image = new ProductImage();
                        $product_gallery_image->product_id = $product->id;
                        $product_gallery_image->gallery_image_id = $gallery_image_id;
                        $product_gallery_image->image_type = 2;
                        $product_gallery_image->status = 1;
                        $product_gallery_image->created_at = Carbon::now();
                        $product_gallery_image->created_by = Auth::guard('admin')->id();

                        $product_gallery_image->save();
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
    public function getProductsByCategory(Request $request)
    {
        try {

            $products = Product::where('deleted', 0)
                ->where('status', 1)
                ->where('published', 1)
                ->where('product_category_id', $request->category_id)
                ->get();
            return view('backend.product_stock._get_products')
                ->with(compact('products'));

        } catch (\Exception $exception) {
            return $exception->getMessage();
            $sub_categories = array();
            return $sub_categories;
        }
    }

    public function getCreatePartialForm()
    {
        $product_colors = ProductColor::where('deleted', 0)
            ->where('status', 1)
            ->get();
        return view('backend.product_stock._get_product_stock_create_partial_form')
            ->with(compact('product_colors'));
    }
    public function getStockList (Request $request){
//        return response($request);

        ## Read value
        $draw               = $request->get('draw');
        $start              = $request->get("start");
        $rowperpage         = $request->get("length"); // Rows display per page

        $columnIndex_arr    = $request->get('order');
        $columnName_arr     = $request->get('columns');
        $order_arr          = $request->get('order');
        $search_arr         = $request->get('search');

        $columnIndex        = $columnIndex_arr[0]['column']; // Column index
        $columnName         = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder    = $order_arr[0]['dir']; // asc or desc
        $searchValue        = $search_arr['value']; // Search value

        // Total records
        $totalRecords = ProductStock::select('count(*) as allcount')->count();
        $totalRecordswithFilter = ProductStock::select('count(*) as allcount')->where('total_quantity', 'like', '%' .$searchValue . '%')->count();

        // Fetch records
        $records = ProductStock::orderBy($columnName,$columnSortOrder)
            ->where('total_quantity', 'like', '%' .$searchValue . '%')
            ->select('product_stocks.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();


        $data = array();
        //$sl = $start;
        foreach($records as $record){

            $edit       =  url('admin/product/stock/{stock}/edit');
//            $delete     =  route('backend.admin.product.stock.stock-list',$record->id);

            //$sl++;
            $nestedData = array();
            $nestedData['id']                       = $record->id;
            $nestedData['total_quantity']                     = $record->total_quantity;
            $nestedData['ordered_quantity']              = $record->ordered_quantity;
            $nestedData['sold_quantity']                   = $record->sold_quantity;
            $nestedData['available_quantity']                  = $record->available_quantity;

//            $actions = '<a href="'.$delete.'" pagename="Delete Stock" data-remote="false" data-toggle="modal" data-target="#myModal" class=" waves-effect md-trigger" style="float: right; ">Delete</a> ';
            $actions = '<a href="'.$edit.'" pagename="Update Stock" data-remote="false" data-toggle="modal" data-target="#myModal" class="waves-effect md-trigger" style="float: right; margin-right: 5px;">Edit</a>';
            $nestedData['options']                  = $actions;

            $data[] = $nestedData;
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data
        );

        echo json_encode($response);
        exit;
    }
}
