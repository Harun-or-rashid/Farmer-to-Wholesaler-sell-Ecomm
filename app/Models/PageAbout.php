<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageAbout extends Model
{
    use HasFactory;

    protected $table = "page_abouts";

    public $timestamps = false;

    protected $fillable = [
        'about_text',
        'image',
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
