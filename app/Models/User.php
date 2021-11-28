<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;



    protected $table = 'users';
    public $timestamps = false;

    protected $fillable = [
        'type',
        'role',
        'username',
        'mobile',
        'email',
        'password',
        'first_name',
        'last_name',
        'profile_picture',
        'dob',
        'gender',
        'email_verified_at',
        'status',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted',
        'deleted_at',
        'deleted_by',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'dob' => 'date'
    ];

    protected $appends = [
        'full_name'
    ];

    public function getFullNameAttribute() {
        return "{$this->first_name} {$this->last_name}";
    }


    public function defaultAddress()
    {
        return $this->hasOne('App\Models\UserAddress', 'user_id', 'id')->where('status', 1)->where('address_type', 2);
    }

    public function allAddress()
    {
        return $this->hasMany('App\Models\UserAddress', 'user_id', 'id')->where('deleted', 0);
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
    public function myorders()
    {
        return $this->hasMany(Order::class,);
    }
}
