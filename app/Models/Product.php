<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    use HasFactory;

    protected $table = 'products';
    public $timestamps = false;

    protected $fillable = [
        'product_category_id',
        'title',
        'slug',
        'quick_text',
        'product_details',
        'manufacturer',
        'weight',
        'featured',
        'emi_available',
        'published',
        'upcoming_text',
        'slider',
        'product_price',
        'sell_price',
        'total_sell',
        'status',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted',
        'deleted_at',
        'deleted_by',
    ];

    protected $appends = [
        'discount_percent'
    ];

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = $this->slugify($value);
    }

    private function slugify($value){
        $string = str_replace(' ', '-', strtolower($value)); // Replaces all spaces with hyphens.
        $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

        $previous_count = Product::where('slug','LIKE', $slug.'%')
            ->count();
        if ($previous_count > 0) {
            $add = $previous_count + 1;
            $slug = $slug.'-'.$add;
        }
        return $slug;

    }

    public function getDiscountPercentAttribute() {
        $product_price = $this->product_price;
        $sell_price = $this->sell_price;
        return round(100 / ($product_price / ($product_price - $sell_price)));
    }


    public function stockAvailability()
    {
        return $this->hasOne('App\Models\ProductStock', 'product_id', 'id')->where('total_quantity', '>', 0);
    }

    public function availableColors()
    {
        return $this->hasMany('App\Models\ProductStock', 'product_id', 'id')->where('product_color_id','!=', 0)->where('total_quantity', '>', 0);
    }

    public function availableSizes()
    {
        return $this->hasMany('App\Models\ProductStock', 'product_id', 'id')->where('product_size_id','!=', 0)->where('total_quantity', '>', 0);
    }

    public function images()
    {
        return $this->hasMany('App\Models\ProductImage', 'product_id', 'id')->orderBy('image_type');
    }

    public function mainImage()
    {
        return $this->hasOne('App\Models\ProductImage', 'product_id', 'id')->where('image_type', 1);
    }

    public function category()
    {
        return $this->belongsTo('App\Models\ProductCategory', 'product_category_id', 'id');
    }

    public function vendor()
    {
        return $this->belongsTo('App\Models\VendorDetail', 'vendor_id', 'id');
    }

    public function rejectReasons()
    {
        return $this->hasMany('App\Models\ProductRejectReason', 'product_id', 'id');
    }

    public function maxPrice()
    {
        return $this->hasOne('App\Models\ProductStock', 'product_id', 'id')->orderBy('product_price', 'DESC');
    }

    public function minPrice()
    {
        return $this->hasOne('App\Models\ProductStock', 'product_id', 'id')->orderBy('product_price', 'ASC');
    }


    public function createdBy()
    {
        return $this->belongsTo('App\Models\User', 'created_by', 'id');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\Models\User', 'updated_by', 'id');
    }

    public function deletedBy()
    {
        return $this->belongsTo('App\Models\User', 'deleted_by', 'id');
    }
}
