<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\WebsiteInformation\UpdateContactUsPageRequest;
use App\Models\PageContact;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Array_;

class ContactUsPageController extends Controller
{


    /*get show system settings*/
    public function showPageContent()
    {
        $common_data = new Array_();
        $common_data->title = 'Show Contact-Us Page Content';
        $common_data->sub_title = '';
        $common_data->main_menu = 'pages';
        $common_data->sub_menu = 'contact_us';
        $common_data->current_menu = 'contact_us';

        $contact_us = PageContact::where('status', 1)
            ->where('deleted', 0)
            ->first();
        if (!empty($contact_us)) {
            return view('backend.system.page.show_contact_us', compact('common_data', 'contact_us'));
        } else {
            $contact_us = new \stdClass();
            $contact_us->contact_text = "";
            $contact_us->address = "";
            $contact_us->office_phone = "";
            $contact_us->fax = "";
            $contact_us->support_mail = "";
            $contact_us->contact_mail = "";
            $contact_us->status = "";

            return view('backend.system.page.edit_contact_us', compact('common_data', 'contact_us'));
        }
    }

    /*get show edit system settings form*/
    public function editPageContent()
    {
        $common_data = new Array_();
        $common_data->title = 'Edit Contact-Us Page Content';
        $common_data->sub_title = '';
        $common_data->main_menu = 'pages';
        $common_data->sub_menu = 'about_us';
        $common_data->current_menu = 'about_us';

        $contact_us = PageContact::where('status', 1)
            ->where('deleted', 0)
            ->first();
        if (empty($contact_us)) {
            $contact_us = new \stdClass();
            $contact_us->contact_text = "";
            $contact_us->address = "";
            $contact_us->office_phone = "";
            $contact_us->fax = "";
            $contact_us->support_mail = "";
            $contact_us->contact_mail = "";
            $contact_us->status = "";
        }
        return view('backend.system.page.edit_contact_us', compact('common_data', 'about_us'));
    }


    /*post submit edit system settings form*/
    public function updatePageContent(UpdateContactUsPageRequest $request)
    {
        DB::beginTransaction();

        try {
            $auth_user = Auth::guard('admin')->user();
            $contact_us = PageContact::where('status', 1)
                ->where('deleted', 0)
                ->first();
            if (!empty($contact_us)) {
                $contact_us->updated_at = Carbon::now();
                $contact_us->updated_by = $auth_user->id;
            } else {
                $contact_us = new PageContact();

                $contact_us->created_at = Carbon::now();
                $contact_us->created_by = $auth_user->id;
            }

            $contact_us->contact_text = $request->contact_text;
            $contact_us->address = $request->address;
            $contact_us->office_phone = $request->office_phone;
            $contact_us->fax = $request->fax;
            $contact_us->support_mail = $request->support_mail;
            $contact_us->contact_mail = $request->contact_mail;
            $contact_us->status = 1;

            $contact_us->save();


        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->withInput()->with(['failed' => 'Something went wrong! Please Contact with admin'.$exception->getMessage()]);
        }

        DB::commit();
        return redirect()->route('backend.admin.page.contact-us.show')->with(['success' => 'Page Content Updated Successfully.']);
    }
}
