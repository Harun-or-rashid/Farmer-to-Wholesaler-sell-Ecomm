<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_contacts', function (Blueprint $table) {
            $table->id();

            $table->text('contact_text')->nullable();
            $table->string('address', 225)->nullable();
            $table->string('office_phone', 225)->nullable();
            $table->string('fax', 225)->nullable();
            $table->string('support_mail', 225)->nullable();
            $table->string('contact_mail', 225)->nullable();

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
        Schema::dropIfExists('page_contacts');
    }
}
