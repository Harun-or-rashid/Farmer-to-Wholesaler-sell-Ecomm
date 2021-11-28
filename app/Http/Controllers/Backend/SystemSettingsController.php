<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\CommonHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\WebsiteInformation\UpdateSystemSettingsPostRequest;
use App\Models\WebsiteInformation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Array_;

class SystemSettingsController extends Controller
{
    /*get show system settings*/
    public function showSystemSettings()
    {
        $common_data = new Array_();
        $common_data->title = 'Show System Settings';
        $common_data->sub_title = '';
        $common_data->main_menu = 'system_settings';
        $common_data->sub_menu = 'system_settings';
        $common_data->current_menu = 'system_settings';

        $settings = WebsiteInformation::where('status', 1)
            ->where('deleted', 0)
            ->first();
        if (!empty($settings)) {
            return view('backend.system.show_system_settings', compact('common_data', 'settings'));
        } else {
            $settings = new \stdClass();
            $settings->website_title = "";
            $settings->website_short_name = "";
            $settings->email = "";
            $settings->phone_number = "";
            $settings->logo = "";
            $settings->favicon = "";
            $settings->facebook_url = "";
            $settings->twitter_url = "";
            $settings->pinterest_url = "";
            $settings->instagram_url = "";
            $settings->status = "";

            return view('backend.system.edit_system_settings', compact('common_data', 'settings'));
        }
    }

    /*get show edit system settings form*/
    public function editSystemSettings()
    {
        $common_data = new Array_();
        $common_data->title = 'Edit Profile';
        $common_data->sub_title = '';
        $common_data->main_menu = 'Profile';
        $common_data->sub_menu = '';
        $common_data->current_menu = '';

        $settings = WebsiteInformation::where('status', 1)
            ->where('deleted', 0)
            ->first();
        return view('backend.system.edit_system_settings', compact('common_data', 'settings'));
    }


    /*post submit edit system settings form*/
    public function editSystemSettingsFormSubmit(UpdateSystemSettingsPostRequest $request)
    {
        DB::beginTransaction();

        try {
            $auth_user = Auth::guard('admin')->user();
            $settings = WebsiteInformation::where('status', 1)
                ->where('deleted', 0)
                ->first();
            if (!empty($settings)) {
                $settings->updated_at = Carbon::now();
                $settings->updated_by = Auth::guard('admin')->id();
            } else {
                $settings = new WebsiteInformation();

                $settings->created_at = Carbon::now();
                $settings->created_by = Auth::guard('admin')->id();
            }

            $settings->website_title = $request->website_title;
            $settings->website_short_name = $request->website_short_name;
            $settings->email = $request->email;
            $settings->phone_number = $request->phone_number;

            $settings->facebook_url = $request->facebook_url;
            $settings->twitter_url = $request->twitter_url;
            $settings->pinterest_url = $request->pinterest_url;
            $settings->instagram_url = $request->instagram_url;
            $settings->status = 1;

            if ($request->hasFile('logo')) {
                $name = "logo_".$auth_user->id.rand(1000,9999).".".$request->file('logo')->extension();
                $logo_url = CommonHelper::uploadFile($request->file('logo'), $name, 'logo');
                $settings->logo = $logo_url;
            }
            if ($request->hasFile('favicon')) {
                $name = "favicon_".$auth_user->id.rand(1000,9999).".".$request->file('favicon')->extension();
                $favicon_url = CommonHelper::uploadFile($request->file('favicon'), $name, 'logo');
                $settings->favicon = $favicon_url;
            }
            $settings->save();


        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->withInput()->with(['failed' => 'Something went wrong! Please Contact with admin'.$exception->getMessage()]);
        }

        DB::commit();
        return redirect()->route('backend.admin.system-settings.show')->with(['success' => 'System Settings Updated Successfully.']);
    }
}
