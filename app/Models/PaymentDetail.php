<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentDetail extends Model
{
    use HasFactory;

    protected $table = 'payment_details';
    public $timestamps = false;

    protected $fillable = [
        'tran_id',
        'order_id',

        'val_id',
        'amount',
        'store_amount',
        'card_type',
        'card_no',
        'bank_tran_id',
        'transaction_status',
        'tran_date',
        'error',
        'currency',
        'card_issuer',
        'card_brand',
        'card_sub_brand',
        'card_issuer_country',
        'card_issuer_country_code',
        'store_id',
        'currency_type',
        'currency_amount',
        'currency_rate',
        'base_fair',
        'risk_level',
        'risk_title',

        'status',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted',
        'deleted_at',
        'deleted_by',
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

    public static function getNewTranId()
    {
        $tran_id = date("siHdmy");
        $last_tran = PaymentDetail::orderBy('id', 'desc')->first();
        if (empty($last_tran)) {
            $tran_id = $tran_id."1";
        } else {
            $last_tran_id = $last_tran->tran_id;
            $last_tran_serial = (int)substr($last_tran_id, 12);
            $new_order_serial = $last_tran_serial + 1;
            $tran_id = $tran_id.$new_order_serial;
        }
        return $tran_id;

    }
}
