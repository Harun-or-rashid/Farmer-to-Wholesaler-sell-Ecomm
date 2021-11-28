<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_id', 64)->comment('unique order id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('user_address_id');

            $table->decimal('sub_total', 10, 2);
            $table->decimal('product_discount', 10,2)->default(0);
            $table->decimal('overall_discount', 10,2)->default(0);
            $table->unsignedInteger('discount_reference')->default(0)->comment('reference id or 0=nothing');
            $table->tinyInteger('discount_type')->default(0)->comment('0=nothing,1=coupon');
            $table->decimal('total_discount', 10,2)->default(0);
            $table->decimal('delivery_charge', 10,2);
            $table->decimal('payable_amount', 10,2);
            $table->decimal('paid_amount', 10, 2)->default(0);
            $table->unsignedInteger('payment_method')->default(1)->comment('1=cash-on-delivery,2=card,3=mobile-bank');
            $table->tinyInteger('payment_status')->default(0)->comment('0=pending, 1=paid, 2=partial paid');

            $table->tinyInteger('order_status')->comment('1=Pending, 2=Accept, 3=Rejected,Cancel');
            $table->tinyInteger('delivery_method')->default(1)->comment('delivery method');
            $table->tinyInteger('delivery_status')->comment('1=Waiting For Received, 2=Delivered');

            $table->unsignedTinyInteger('status')->default(1)->comment('0=Inactive,1=Active');

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
        Schema::dropIfExists('orders');
    }
}
