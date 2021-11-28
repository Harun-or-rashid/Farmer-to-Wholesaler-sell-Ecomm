<?php

namespace App\Providers;

use App\Models\ProductCategory;
use App\Models\WebsiteInformation;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use PhpParser\Node\Expr\Array_;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::share('system_product_categories', $this->getProductCategories());
        View::share('system_website_information', $this->getWebsiteInformation());
    }

    public function getProductCategories()
    {
        return ProductCategory::where('parent_id', 0)
            ->where('status', 1)
            ->get();
    }

    public function getWebsiteInformation()
    {
        if (Schema::hasTable('website_information')) {
            $settings = WebsiteInformation::where('status',1)
                ->where('deleted', 0)
                ->first();
            if (!empty($settings)) {
                return $settings;
            }
        }

        $settings = new Array_();
        $settings->website_title = 'Allaia Shop';
        $settings->website_short_name = 'Allaia';
        $settings->email = 'admin@allaia.com';
        $settings->phone_number = '';
        $settings->logo = '';
        $settings->favicon = '';
        $settings->facebook_url = '';
        $settings->twitter_url = '';
        $settings->pinterest_url = '';
        $settings->instagram_url = '';
        $settings->status = '';
        $settings->created_at = '';
        return $settings;
    }

}
