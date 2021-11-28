<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteInformation extends Model
{
    use HasFactory;

    protected $table = "website_information";

    public $timestamps = false;

    protected $fillable = [
        'website_title',
        'website_short_name',
        'email',
        'phone_number',
        'logo',
        'favicon',
        'facebook_url',
        'twitter_url',
        'pinterest_url',
        'instagram_url',
        'status',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted',
        'deleted_at',
        'deleted_by'
    ];

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
