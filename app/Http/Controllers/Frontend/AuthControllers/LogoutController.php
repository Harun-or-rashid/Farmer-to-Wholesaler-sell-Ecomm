<?php

namespace App\Http\Controllers\Frontend\AuthControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function __construct()
    {
    }

    /*logout with post method*/
    public function postLogout(){
        Auth::guard('customer')->logout();

        return redirect()->route('frontend.home')
            ->with('success', 'You are successfully log out.');
    }

    /*logout with get method*/
    public function getLogout(){
        Auth::guard('customer')->logout();

        return redirect()->route('frontend.home')
            ->with('success', 'You are successfully log out.');
    }
}
