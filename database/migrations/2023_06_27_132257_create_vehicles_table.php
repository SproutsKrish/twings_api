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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('vehicle_type_id')->nullable();
            $table->string('vehicle_name', 50)->nullable();
            $table->string('vehicle_make', 50)->nullable();
            $table->string('vehicle_model', 50)->nullable();
            $table->bigInteger('vehicle_year')->nullable();
            $table->bigInteger('device_id')->nullable();
            $table->bigInteger('device_imei')->nullable();
            $table->bigInteger('sim_id')->nullable();
            $table->bigInteger('sim_mob_no')->nullable();
            $table->string('insurance_company', 50)->nullable();
            $table->string('insurance_number', 50)->nullable();
            $table->date('insurance_start_date')->nullable();
            $table->date('insurance_expiry_date')->nullable();
            $table->string('registration_number', 50)->nullable();
            $table->string('chassis_number', 50)->nullable();
            $table->string('engine_number', 50)->nullable();
            $table->string('ownership_type', 50)->nullable();
            $table->date('fc_date')->nullable();
            $table->date('installation_date')->nullable();
            $table->date('expire_date')->nullable();
            $table->date('extend_date')->nullable();
            $table->integer('dealer_id')->nullable();
            $table->integer('subdealer_id')->nullable();
            $table->integer('client_id')->nullable();
            $table->tinyInteger('status')->nullable()->default(1);
            $table->timestamps();
            $table->dateTime('deleted_at')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->string('ip_address', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
};
