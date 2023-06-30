<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dealers', function (Blueprint $table) {
            $table->id();
            $table->string('dealer_company')->nullable();
            $table->string('dealer_name')->nullable();
            $table->string('dealer_email')->nullable();
            $table->string('dealer_mobile')->nullable();
            $table->longText('dealer_address')->nullable();
            $table->text('dealer_logo')->nullable();
            $table->integer('dealer_limit')->nullable();
            $table->string('dealer_color')->nullable();
            $table->string('dealer_subdomain')->nullable();
            $table->string('dealer_city')->nullable();
            $table->string('dealer_state')->nullable();
            $table->integer('dealer_pincode')->nullable();
            $table->integer('country_id')->nullable();
            $table->string('country_name')->nullable();
            $table->string('timezone_name')->nullable();
            $table->integer('timezone_minutes')->nullable();
            $table->longText('server_key')->nullable();
            $table->tinyInteger('status')->nullable()->default(1);
            $table->timestamps();
            $table->dateTime('deleted_at')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->string('ip_address')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dealers');
    }
};
