<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFeaturedAndImageColumnInProductCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_categories', function (Blueprint $table) {
            $table->string('image', 128)->nullable()->default(null)->after('parent_id')->comment('category image');
            $table->tinyInteger('featured')->default(0)->after('image')->comment('1=featured');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products_category', function (Blueprint $table) {
            $table->dropColumn('image');
            $table->dropColumn('featured');
        });
    }
}
