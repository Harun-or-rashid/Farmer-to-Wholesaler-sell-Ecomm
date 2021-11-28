<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Array_;

class ProfileController extends Controller
{
    public function showUserProfile()
    {
        if (!Auth::guard('customer')->check()) {
            return redirect()
                ->route('frontend.login-register', [
                    'redirect_to' => route('frontend.user.profile')
                ]);
        }
        $common_data = new Array_();
        $common_data->title = 'User Profile';
        $common_data->sub_title = '';
        $common_data->main_menu = 'user_profile';
        $common_data->sub_menu = 'user_profile';
        $common_data->current_menu = 'user_profile';

        $user = Auth::guard('customer')->user();

        return view('frontend.pages.user.profile')
            ->with(compact(
                'common_data',
                'user'
            ));
    }
}
