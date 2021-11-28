<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Upazila;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function getDistrictsByDivision(Request $request)
    {
        $districts = District::where('division_id', $request->division)
            ->get();
        return view('common-ajax._get_districts_select_option')->with(compact('districts'));
    }

    public function getUpazilasByDistrict(Request $request)
    {
        $upazilas = Upazila::where('district_id', $request->district)
            ->get();
        return view('common-ajax._get_upazilas_select_option')->with(compact('upazilas'));
    }
}
