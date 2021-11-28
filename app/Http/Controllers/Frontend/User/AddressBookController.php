<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\User\AddAddressPostRequest;
use App\Models\Division;
use App\Models\UserAddress;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Array_;

class AddressBookController extends Controller
{
    public function showUserAddresses()
    {
        if (!Auth::guard('customer')->check()) {
            return redirect()
                ->route('frontend.login-register', [
                    'redirect_to' => route('frontend.user.profile')
                ]);
        }
        $common_data = new Array_();
        $common_data->title = 'Address Book';
        $common_data->sub_title = '';
        $common_data->main_menu = 'user_profile';
        $common_data->sub_menu = 'user_profile';
        $common_data->current_menu = 'user_profile';

        $user = Auth::guard('customer')->user();
        $divisions = Division::all();
        $all_addresses = $user->allAddress;

        return view('frontend.pages.user.address_book')
            ->with(compact(
                'common_data',
                'user',
                'divisions',
                'all_addresses'
            ));
    }

    public function storeUserAddress(AddAddressPostRequest $request)
    {

        try {
            if (!Auth::guard('customer')->check()) {
                return redirect()
                    ->route('frontend.login-register', [
                        'redirect_to' => route('frontend.user.add-address-book')
                    ]);
            }

            $address = new UserAddress();
            $address->user_id = Auth::guard('customer')->id();
            $address->full_name = $request->full_name;
            $address->phone_number = $request->phone_number;
            $address->division_id = $request->division;
            $address->district_id = $request->district;
            $address->upazila_id = $request->upazila;
            $address->address = $request->address;
            $address->post_code = $request->post_code;
            $address->address_type = 1;
            $address->status = 1;
            $address->created_at = Carbon::now();
            $address->created_by = Auth::guard('customer')->id();
            $address->save();

        } catch (\Exception $exception) {
            return redirect()->back()->withInput()->with(['failed' => 'Something went wrong. '. $exception->getMessage()]);
        }
        return redirect()->back()->with(['success' => 'Address Added Success']);
    }
}
