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
        Schema::create('vehicle_owners', function (Blueprint $table) {
            $table->id();
            $table->string('vehicle_owner_company')->nullable();
            $table->string('vehicle_owner_name')->nullable();
            $table->string('vehicle_owner_email')->nullable();
            $table->bigInteger('vehicle_owner_mobile')->nullable();
            $table->longText('vehicle_owner_address')->nullable();
            $table->string('vehicle_owner_logo')->nullable();
            $table->integer('vehicle_owner_limit')->nullable();
            $table->string('vehicle_owner_city')->nullable();
            $table->string('vehicle_owner_state')->nullable();
            $table->integer('vehicle_owner_pincode')->nullable();
            $table->bigInteger('country_id')->nullable();
            $table->string('country_name')->nullable();
            $table->string('timezone_name')->nullable();
            $table->string('timezone_offset')->nullable();
            $table->integer('timezone_minutes')->nullable();
            $table->bigInteger('client_id')->nullable();
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
        Schema::dropIfExists('vehicle_owners');
    }
};
