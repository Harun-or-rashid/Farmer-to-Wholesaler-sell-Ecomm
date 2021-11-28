<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\CommonHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\WebsiteInformation\UpdateAboutUsPageRequest;
use App\Models\PageAbout;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Array_;

class AboutUsPageController extends Controller
{
    /*get show system settings*/
    public function showPageContent()
    {
        $common_data = new Array_();
        $common_data->title = 'Show About-Us Page Content';
        $common_data->sub_title = '';
        $common_data->main_menu = 'pages';
        $common_data->sub_menu = 'about_us';
        $common_data->current_menu = 'about_us';

        $about_us = PageAbout::where('status', 1)
            ->where('deleted', 0)
            ->first();
        if (!empty($about_us)) {
            return view('backend.system.page.show_about_us', compact('common_data', 'about_us'));
        } else {
            $about_us = new \stdClass();
            $about_us->about_text = "";
            $about_us->image = "";
            $about_us->status = "";

            return view('backend.system.page.edit_about_us', compact('common_data', 'about_us'));
        }
    }

    /*get show edit system settings form*/
    public function editPageContent()
    {
        $common_data = new Array_();
        $common_data->title = 'Edit About-Us Page Content';
        $common_data->sub_title = '';
        $common_data->main_menu = 'pages';
        $common_data->sub_menu = 'about_us';
        $common_data->current_menu = 'about_us';

        $about_us = PageAbout::where('status', 1)
            ->where('deleted', 0)
            ->first();
        return view('backend.system.page.edit_about_us', compact('common_data', 'about_us'));
    }


    /*post submit edit system settings form*/
    public function updatePageContent(UpdateAboutUsPageRequest $request)
    {
        DB::beginTransaction();

        try {
            $auth_user = Auth::guard('admin')->user();
            $about_us = PageAbout::where('status', 1)
                ->where('deleted', 0)
                ->first();
            if (!empty($about_us)) {
                $about_us->updated_at = Carbon::now();
                $about_us->updated_by = Auth::guard('admin')->id();
            } else {
                $about_us = new PageAbout();

                $about_us->created_at = Carbon::now();
                $about_us->created_by = Auth::guard('admin')->id();
            }

            $about_us->about_text = $request->about_text;
            $about_us->status = 1;

            if ($request->hasFile('image')) {
                $name = "about_image_".$auth_user->id.rand(1000,9999).".".$request->file('image')->extension();
                $image_url = CommonHelper::uploadFile($request->file('image'), $name, 'page');
                $about_us->image = $image_url;
            }
            $about_us->save();


        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->withInput()->with(['failed' => 'Something went wrong! Please Contact with admin'.$exception->getMessage()]);
        }

        DB::commit();
        return redirect()->route('backend.admin.page.about-us.show')->with(['success' => 'Page Content Updated Successfully.']);
    }
}
