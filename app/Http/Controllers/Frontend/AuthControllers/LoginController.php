<?php

namespace App\Http\Controllers\Frontend\AuthControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\LoginRequest;
use App\Models\Division;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;
use Str;
use PhpParser\Node\Expr\Array_;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {

    }

    /*show login form*/
    public function getLogin(){
        /*check if user logged in then return to dashboard*/
        if(Auth::guard('customer')->user()){
            return redirect()->back()
                ->with('warning', 'You are already logged in');
        }

        /*create & set common data array*/
        $common_data = new Array_();
        $common_data->title = 'Login';
        $common_data->sub_title = '';
        $common_data->main_menu = '';
        $common_data->sub_menu = '';
        $common_data->current_menu = '';

        $divisions = Division::all();

        /*return view page with data*/
        return view('frontend.pages.login_register')
            ->with(compact('common_data', 'divisions'));
    }

    /*process login form*/
    public function postLogin(LoginRequest $request){
        /*set user credentials as array*/
        $login_credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'type' => 'customer',
            'role' => 'customer',
            'status' => 1,
            'deleted' => 0
        ];//role 1 = admin

        /*check if user data is valid*/
        if (Auth::guard('customer')->attempt($login_credentials, $request->remember)) {
            if (request()->redirectTo != '') {
                return redirect($request->redirectTo)
                    ->with('success', 'You are successfully logged in.');
            }
            // Authentication passed...
            return redirect()->route('frontend.home')
                ->with('success', 'You are successfully logged in.');
        }

        /*if user data is invalid then return redirect back with error message and input*/
        return redirect()->route('frontend.home')
            ->with(['open_modal' => 'login', 'failed' => 'Wrong Password Or User not activated/Deleted yet!'])->withInput($request->all());
    }
/*    public function github()
    {
        return Socialite::driver('github')->redirect();
    }
    public function githubRedirect()
    {
        $user=Socialite::driver('github')->user();
        dd($user);
    }
    public function facebook()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function facebookRedirect(Request $request)
    {
        $request->dd();
        $user=Socialite::driver('facebook')->user();
        dd($user);
    }*/
}
