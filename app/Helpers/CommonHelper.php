<?php
namespace App\Helpers;


use App\Models\ProductCategory;
use App\Models\SiteBanner;
use App\Models\UserImage;
use Carbon\Carbon;

class CommonHelper
{

    public static function getAdminUserName()
    {
        return auth()->guard('admin')->user()->first_name . ' ' . auth()->guard('admin')->user()->last_name;
    }
    public static function getUserUserName()
    {
        return auth()->guard('user')->user()->first_name . ' ' . auth()->guard('user')->user()->last_name;
    }
    public static function getCustomerUserName()
    {
        return auth()->guard('customer')->user()->first_name . ' ' . auth()->guard('customer')->user()->last_name;
    }

    public static function uploadFile($file, $name, $folder_name)
    {
        $url = $file->storeAs($folder_name, $name);
        return "uploads/" . $url;
    }

    public static function getCategoryImage($category_id)
    {
        $category = ProductCategory::where('id', $category_id)->first();
        if (!empty($category)) {
            if(is_array(getimagesize(asset($category->image)))) {
                $image = $category->image;
            }
        }
    }

    function getMimeType($filename)
    {
        $mimetype = false;
        if(function_exists('finfo_open')) {
            // open with FileInfo
        } elseif(function_exists('getimagesize')) {
            // open with GD
        } elseif(function_exists('exif_imagetype')) {
            // open with EXIF
        } elseif(function_exists('mime_content_type')) {
            $mimetype = mime_content_type($filename);
        }
        return $mimetype;
    }

    public static function getUserAvatar($user_id)
    {
        $image = UserImage::where('user_id', $user_id)->where('status', 1)->first();
        if (empty($image)) {
            return 'assets/backend/dist/img/avatar2.png';
        } else {
            return $image->image;
        }
    }

}