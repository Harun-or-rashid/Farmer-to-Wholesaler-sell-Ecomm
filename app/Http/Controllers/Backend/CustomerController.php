<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Array_;

class CustomerController extends Controller
{

    public function showCustomerList()
    {
        $common_data = new Array_();
        $common_data->title = 'Show Customers';
        $common_data->sub_title = '';
        $common_data->main_menu = 'customers';
        $common_data->sub_menu = 'customers';
        $common_data->current_menu = 'customers';

        $users = User::where('type', 'customer')->where('deleted', 0)->get();
        return view('backend.users.customers', compact('common_data', 'users'));
    }
}
