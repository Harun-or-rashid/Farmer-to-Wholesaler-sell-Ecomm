<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $table = "product_categories";

    protected $fillable = [
        'title',
        'slug',
        'parent_id',
        'image',
        'featured',
        'status',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted',
        'deleted_at',
        'deleted_by'
    ];

    public $timestamps = false;

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = $this->slugify($value);
    }

    private function slugify($value){
        $string = str_replace(' ', '-', strtolower($value)); // Replaces all spaces with hyphens.
        $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

        $previous_count = ProductCategory::where('slug','LIKE', $slug.'%')
            ->count();
        if ($previous_count > 0) {
            $add = $previous_count + 1;
            $slug = $slug.'-'.$add;
        }
        return $slug;

    }

    public function childs() {
        return $this->hasMany('App\Models\ProductCategory','parent_id','id') ;
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\ProductCategory', 'parent_id', 'id');
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

    public static function allChilds($id, $columns = NULL)
    {
        $category = ProductCategory::find($id);
        $all_child_array = array();
        if (count($category->childs) > 0) {
            foreach ($category->childs as $child) {
                $all_child_array[] = $child->id;
                array_push($all_child_array, ...self::getChildChilds($child->id));
            }
        }
        return $all_child_array;
    }

    public static function getChildChilds($child) {
        $category = ProductCategory::find($child);
        $all_child_array = array();
        if (count($category->childs) > 0) {
            foreach ($category->childs as $child) {
                $all_child_array[] = $child->id;
                if (count($child->childs) > 0) {
                    array_push($all_child_array, ...self::getChildChilds($child->id));
                }
            }
        }
        return $all_child_array;
    }
}
