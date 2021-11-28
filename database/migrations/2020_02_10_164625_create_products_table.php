<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('product_category_id');
            $table->string('title', 255);
            $table->string('slug', 255);
            $table->text('quick_text');
            $table->text('product_details');
            $table->string('manufacturer',64)->nullable();
            $table->float('weight',8,2)->default(0);
            $table->tinyInteger('featured')->default(0);

            $table->float('product_price')->default(0);
            $table->float('sell_price')->default(0);

            $table->unsignedTinyInteger('status')->default(0)->comment('0=Inactive,1=Active,2=Pending');

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
        Schema::dropIfExists('products');
    }
}
