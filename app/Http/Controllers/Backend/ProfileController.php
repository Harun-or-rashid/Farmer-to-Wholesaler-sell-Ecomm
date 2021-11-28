<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Profile\EditProfilePostRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Array_;

class ProfileController extends Controller
{
    /*get show profile*/
    public function showProfile()
    {
        $common_data = new Array_();
        $common_data->title = 'Show Profile';
        $common_data->sub_title = '';
        $common_data->main_menu = 'Profile';
        $common_data->sub_menu = '';
        $common_data->current_menu = '';

        $user = Auth::guard('admin')->user();
        return view('backend.profile.show_profile', compact('common_data', 'user'));
    }

    /*get show edit profile form*/
    public function editProfile()
    {
        $common_data = new Array_();
        $common_data->title = 'Edit Profile';
        $common_data->sub_title = '';
        $common_data->main_menu = 'Profile';
        $common_data->sub_menu = '';
        $common_data->current_menu = '';

        $user = Auth::guard('admin')->user();
        return view('backend.profile.edit_profile', compact('common_data', 'user'));
    }


    /*post submit edit profile form*/
    public function editProfileFormSubmit(EditProfilePostRequest $request)
    {
        DB::beginTransaction();

        try {

            $user = User::find(Auth::guard('admin')->id());
            $user->email = $request->email;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            if (!empty($request->password)) {
                $user->password = bcrypt($request->password);
            }
            $user->updated_at = Carbon::now();
            $user->updated_by = Auth::guard('admin')->id();

            $user->save();


        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->withInput()->with(['error' => 'Something went wrong! Please Contact with admin']);
        }

        DB::commit();
        return redirect()->route('backend.admin.profile.show')->with(['success' => 'Profile Updated Successfully.']);
    }
}
