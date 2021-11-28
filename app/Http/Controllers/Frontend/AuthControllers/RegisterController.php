<?php

namespace App\Http\Controllers\Frontend\AuthControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\RegisterRequest;
use App\Models\UserAddress;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Array_;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{

    public function __construct()
    {

    }

    /*show register form*/
    public function getRegister(){
        /*check if user logged in then return to dashboard*/
        if(Auth::user()){
            return redirect()->route('dashboard')
                ->with('warning', 'You are already logged in');
        }

        /*create & set common data array*/
        $common_data = new Array_();
        $common_data->title = 'Register';
        $common_data->sub_title = '';
        $common_data->main_menu = '';
        $common_data->sub_menu = '';
        $common_data->current_menu = '';

        /*return register page with data*/
        return view('auth.user_register')
            ->with(compact('common_data'));
    }

    /*process register form*/
    public function postRegister(RegisterRequest $request) {

        DB::beginTransaction();
        try {


            /*create new user object and set data*/
            $user = new User();
            $user->type = 'customer';
            $user->role = 'customer';
            $user->password = bcrypt($request->password);
            $user->email = $request->email;
            $user->mobile = $request->phone_number;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;

            $user->email_verified_at = Carbon::now();
            $user->status = 1;
            $user->created_at = Carbon::now();
            $user->save();

            $address = new UserAddress();
            $address->user_id = $user->id;
            $address->full_name = $request->first_name . ' ' . $request->last_name;
            $address->phone_number = $request->phone_number;
            $address->division_id = $request->division;
            $address->district_id = $request->district;
            $address->upazila_id = $request->upazila;
            $address->address = $request->address;
            $address->post_code = $request->post_code;
            $address->address_type = 2;
            $address->status = 1;
            $address->created_at = Carbon::now();
            $address->created_by = $user->id;
            $address->save();



        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with(['failed' => 'Something went wrong! '. $exception->getMessage()]);
        }
        DB::commit();
        return redirect()->back()->with(['success' => 'Account Registered Successfully Completed']);

    }
}
