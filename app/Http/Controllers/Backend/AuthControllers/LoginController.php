<?php

namespace App\Http\Controllers\Backend\AuthControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\LoginRequest;
//use Laravel\Socialite\Facades\Socialite;
use PhpParser\Node\Expr\Array_;
use Illuminate\Support\Facades\Auth;
use Str;
use Hash;
use Socialite;
class LoginController extends Controller
{
    public function __construct()
    {

    }

    /*show login form*/
    public function getLogin(){
        /*check if user logged in then return to dashboard*/
        if(Auth::guard('admin')->user()){
            return redirect()->route('backend.admin.dashboard')
                ->with('warning', 'You are already logged in');
        }

        /*create & set common data array*/
        $common_data = new Array_();
        $common_data->title = 'Login';
        $common_data->sub_title = '';
        $common_data->main_menu = '';
        $common_data->sub_menu = '';
        $common_data->current_menu = '';

        /*return view page with data*/
        return view('backend.auth.user_login')
            ->with(compact('common_data'));
    }
    public function showLogin(){
        /*check if user logged in then return to dashboard*/
        if(Auth::guard('admin')->user()){
            return redirect()->route('backend.admin.dashboard')
                ->with('warning', 'You are already logged in');
        }

        /*create & set common data array*/
        $common_data = new Array_();
        $common_data->title = 'Login';
        $common_data->sub_title = '';
        $common_data->main_menu = '';
        $common_data->sub_menu = '';
        $common_data->current_menu = '';

        /*return view page with data*/
        return view('backend.auth.user_login')
            ->with(compact('common_data'));
    }

    /*process login form*/
    public function postLogin(LoginRequest $request){
        /*set user credentials as array*/
        $login_credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'type' => 'admin',
            'role' => 'admin',
            'status' => 1,
            'deleted' => 0
        ];//role 1 = admin

        /*check if user data is valid*/
        if (Auth::guard('admin')->attempt($login_credentials, $request->remember)) {
            // Authentication passed...
            return redirect()->route('backend.admin.dashboard')
                ->with('success', 'You are successfully logged in.');
        }

        /*if user data is invalid then return redirect back with error message and input*/
        return redirect()->route('backend.admin.login')
            ->with('failed', 'Wrong Password Or User not activated/Deleted yet!')->withInput($request->all());
    }



}
