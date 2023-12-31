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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('client_company')->nullable();
            $table->string('client_name')->nullable();
            $table->string('client_email')->nullable();
            $table->bigInteger('client_mobile')->nullable();
            $table->longText('client_address')->nullable();
            $table->string('client_logo')->nullable();
            $table->integer('client_limit')->nullable();
            $table->string('client_city')->nullable();
            $table->string('client_state')->nullable();
            $table->integer('client_pincode')->nullable();
            $table->bigInteger('country_id')->nullable();
            $table->string('country_name')->nullable();
            $table->string('timezone_name')->nullable();
            $table->string('timezone_offset')->nullable();
            $table->integer('timezone_minutes')->nullable();
            $table->longText('api_key')->nullable();
            $table->bigInteger('dealer_id')->nullable();
            $table->bigInteger('subdealer_id')->nullable();
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
        Schema::dropIfExists('clients');
    }
};
