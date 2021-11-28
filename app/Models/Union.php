<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Union extends Model
{
    use HasFactory;

    protected $table = "unions";

    protected $fillable = [
        'upazilla_id',
        'name',
        'bn_name',
        'url'
    ];

    public $timestamps = false;
}
