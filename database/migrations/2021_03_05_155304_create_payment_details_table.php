<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_details', function (Blueprint $table) {
            $table->id();
            $table->string('tran_id', 128);
            $table->unsignedInteger('order_id');

            $table->string('val_id', 128)->nullable();
            $table->decimal('amount', 10,2)->default(0);
            $table->decimal('store_amount', 10,2)->default(0);
            $table->string('card_type', 128)->nullable();
            $table->string('card_no', 128)->nullable();
            $table->string('bank_tran_id', 128)->nullable();
            $table->string('transaction_status', 128)->nullable();
            $table->timestamp('tran_date')->nullable();
            $table->string('error', 225)->nullable();
            $table->string('currency', 64)->nullable();
            $table->string('card_issuer', 128)->nullable();
            $table->string('card_brand', 128)->nullable();
            $table->string('card_sub_brand', 128)->nullable();
            $table->string('card_issuer_country', 128)->nullable();
            $table->string('card_issuer_country_code', 128)->nullable();
            $table->string('store_id', 128)->nullable();
            $table->string('currency_type', 128)->nullable();
            $table->decimal('currency_amount', 10,2)->nullable();
            $table->decimal('currency_rate', 10,2)->nullable();
            $table->decimal('base_fair', 10,2)->nullable();
            $table->string('risk_level', 32)->nullable();
            $table->string('risk_title', 32)->nullable();


            $table->unsignedTinyInteger('status')->default(1)->comment('0=Inactive,1=Active,2=Invalid Payment');

            $table->timestamp('created_at')->nullable();
            $table->unsignedInteger('created_by')->nullable();

            $table->timestamp('updated_at')->nullable();
            $table->unsignedInteger('updated_by')->nullable();

            $table->unsignedTinyInteger('deleted')->default(0)->comment('1=deleted');
            $table->timestamp('deleted_at')->nullable();
            $table->unsignedInteger('deleted_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_details');
    }
}
