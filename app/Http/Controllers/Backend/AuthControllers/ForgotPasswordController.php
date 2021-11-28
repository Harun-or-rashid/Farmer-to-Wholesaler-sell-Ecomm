<?php

namespace App\Http\Controllers\Backend\AuthControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequests\PostForgotPasswordRequest;
use App\Http\Requests\AuthRequests\PostResetPasswordRequest;
use App\Mail\ForgotPasswordEmail;
use App\Models\PasswordReset;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Expr\Array_;

class ForgotPasswordController extends Controller
{
    public function __construct()
    {

    }

    /*show forgot password page*/
    public function getForgotPassword(){
        /*check if user logged in then return to dashboard*/
        if(Auth::user()){
            return redirect()->route('dashboard')
                ->with('warning', 'You are already logged in');
        }

        /*create & set common data array*/
        $common_data = new Array_();
        $common_data->title = 'Forgot password';
        $common_data->sub_title = '';
        $common_data->main_menu = '';
        $common_data->sub_menu = '';
        $common_data->current_menu = '';

        /*return view page with data*/
        return view('auth.forgot_password')
            ->with(compact('common_data'));
    }

    /*process forgot password form*/
    public function postForgotPassword(PostForgotPasswordRequest $request){
        /*start database transaction*/
        DB::beginTransaction();
        try {
            /*check user email is valid or not*/
            $checkUser = User::where('email', $request->email)->first();

            /*if email is valid*/
            if (!empty($checkUser)) {

                /*create new password reset object, set data and save it*/
                $password_reset = new PasswordReset();
                $token = Auth::id().time().random_int(1000,9999).Auth::id().random_int(100,999);
                $password_reset->email = $request->email;
                $password_reset->token = $token;
                $password_reset->created_at = Carbon::now();

                $password_reset->save();

                /*send password reset email to requested user email*/
                Mail::to($request->email)->send(new  ForgotPasswordEmail($password_reset));
            } else {
                /*if user is invalid then return */
                return redirect()->back()->with('danger', 'Can\'t find your account');
            }


        } catch (\Exception $exception) {
            /*if found any exception then rollback database transaction and return back with error message*/
            DB::rollBack();
            return redirect()->back()->with('danger', 'Something went wrong.' . $exception->getMessage());
        }

        /*if everything is ok then commit database transaction and return back with success message*/
        DB::commit();
        return redirect()->back()->with('success', 'Email sent successful to your email....');
    }



    /*verify token for forgot password*/
    public function getResetPasswordVerify(Request $request)
    {
        dd($request->all());
        dd($token);
        $checkToken = PasswordReset::where('token', $token)
            ->where('created_at', '>', Carbon::now()->subHour(1))
            ->where('status', '1')
            ->first();
        if(!empty($checkToken)) {

            $commons = [
                'page_title' => 'Reset Password',
                'menu_section' => 'Welcome',
                'menu_main' => 'Welcome',
                'menu_active' => 'Welcome'
            ];

            return view('auth.reset_password')->with(compact('commons', 'checkToken'));
        } else {
            return "Invalid Token";
        }
    }


    public function postResetPasswordVerify(PostResetPasswordRequest $request)
    {
        DB::beginTransaction();

        try {
            $checkToken = PasswordReset::where('token', $token)
                ->where('created_at', '>', Carbon::now()->subHour(1))
                ->where('status', '1')
                ->first();

            if (!empty($checkToken)) {

                $user = User::where('email', $checkToken->email)->first();
                if (!empty($user)) {

                    $user->password = bcrypt($request->password);
                    $user->save();

                    $checkToken->delete();

                } else {
                    return "Invalid User";
                }

            } else {
                return "Invalid Token";
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('danger', 'Something went wrong.' . $exception->getMessage());
        }

        DB::commit();
        return redirect()->route('login')->with('success', 'Your password has been changed successfully....');
    }
}
