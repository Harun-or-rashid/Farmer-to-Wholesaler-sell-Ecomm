<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageContact extends Model
{
    use HasFactory;

    protected $table = "page_contacts";

    public $timestamps = false;

    protected $fillable = [
        'contact_text',
        'address',
        'office_phone',
        'fax',
        'support_mail',
        'contact_mail',
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
