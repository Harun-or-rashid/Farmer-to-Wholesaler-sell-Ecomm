<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'order_id',
        'user_address_id',
        'order_type',
        'sub_total',
        'product_discount',
        'overall_discount',
        'discount_reference',
        'discount_type',
        'total_discount',
        'delivery_charge',
        'payable_amount',
        'paid_amount',
        'payment_method',
        'payment_status',
        'order_status',
        'delivery_method',
        'delivery_status',
        'status',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted',
        'deleted_at',
        'deleted_by',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $appends = [
        'due_amount'
    ];

    public function getDueAmountAttribute() {
        return ($this->payable_amount - $this->paid_amount);
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

    public static function getNewOrderId()
    {
        $order_id = date("siHdmy");
        $last_order = Order::orderBy('id', 'desc')->first();
        if (empty($last_order)) {
            $order_id = $order_id."1";
        } else {
            $last_order_id = $last_order->order_id;
            $last_order_serial = (int)substr($last_order_id, 12);
            $new_order_serial = $last_order_serial + 1;
            $order_id = $order_id.$new_order_serial;
        }
        return $order_id;

    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function orderAddress()
    {
        return $this->belongsTo('App\Models\UserAddress', 'user_address_id', 'id');
    }

    public function orderDetails()
    {
        return $this->hasMany('App\Models\OrderDetail', 'order_id', 'id');
    }

    public function orderDetailsProduct()
    {
        return $this->hasMany('App\Models\OrderDetail', 'order_id', 'id')->where('product_type', 1);
    }


}
