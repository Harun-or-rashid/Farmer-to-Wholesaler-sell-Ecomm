<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebsiteInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('website_information', function (Blueprint $table) {
            $table->id();

            $table->string('website_title', 225)->nullable();
            $table->string('website_short_name', 128)->nullable();
            $table->string('email', 225)->nullable();
            $table->string('phone_number', 225)->nullable();
            $table->string('logo', 225)->nullable();
            $table->string('favicon', 225)->nullable();
            $table->string('facebook_url', 225)->nullable();
            $table->string('twitter_url', 225)->nullable();
            $table->string('pinterest_url', 225)->nullable();
            $table->string('instagram_url', 225)->nullable();


            $table->unsignedTinyInteger('status')->default(0)->comment('0=Inactive,1=Active');
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
        Schema::dropIfExists('website_information');
    }
}
