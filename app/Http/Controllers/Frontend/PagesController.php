<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Array_;

class PagesController extends Controller
{

    public function showAboutUsPage()
    {
        $common_data = new Array_();
        $common_data->title = 'Home';
        $common_data->sub_title = '';
        $common_data->main_menu = 'home';
        $common_data->sub_menu = 'home';
        $common_data->current_menu = 'home';

        return view('frontend.pages.about')
            ->with(compact(
                'common_data'
            ));
    }

    public function showContactPage()
    {
        $common_data = new Array_();
        $common_data->title = 'Home';
        $common_data->sub_title = '';
        $common_data->main_menu = 'home';
        $common_data->sub_menu = 'home';
        $common_data->current_menu = 'home';

        return view('frontend.pages.contact_us')
            ->with(compact(
                'common_data'
            ));
    }
    public function showFaqPage()
    {
        $common_data = new Array_();
        $common_data->title = 'Faq';
        $common_data->sub_title = '';
        $common_data->main_menu = 'faq';
        $common_data->sub_menu = 'faq';
        $common_data->current_menu = 'faq';

        return view('frontend.pages.faq')
            ->with(compact(
                'common_data'
            ));
    }
    public function showPrivacyPage()
    {
        $common_data = new Array_();
        $common_data->title = 'Privacy and Policy';
        $common_data->sub_title = '';
        $common_data->main_menu = 'privacy and policy';
        $common_data->sub_menu = 'privacy and policy';
        $common_data->current_menu = 'privacy and policy';

        return view('frontend.pages.privacy')
            ->with(compact(
                'common_data'
            ));
    }

}
