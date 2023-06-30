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
            $table->string('vehicle_name', 30)->nullable();
            $table->string('vehicle_group', 30)->nullable();
            $table->smallInteger('vehicle_type_id')->default(5);
            $table->string('vehicle_make', 30)->nullable();
            $table->string('vehicle_model', 30)->nullable();
            $table->integer('vehicle_year')->nullable();
            $table->bigInteger('device_imei')->nullable();
            $table->string('sim_mob_no', 20)->nullable();
            $table->string('insurance_company', 25)->nullable();
            $table->string('insurance_number', 30)->nullable();
            $table->date('insurance_start_date')->nullable();
            $table->date('insurance_expiry_date')->nullable();
            $table->date('tax_date')->nullable();
            $table->string('registration_number', 30)->nullable();
            $table->string('chassis_number', 25)->nullable();
            $table->string('engine_number', 25)->nullable();
            $table->string('model_number', 20)->nullable();
            $table->string('ownership_type', 20)->nullable();
            $table->date('fc_date')->nullable();
            $table->date('installation_date')->nullable();
            $table->date('expire_date')->nullable();
            $table->date('extend_date')->nullable();
            $table->integer('dealer_id')->nullable();
            $table->integer('subdealer_id')->nullable();
            $table->integer('client_id')->nullable();
            $table->integer('user_id')->nullable();
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
        Schema::dropIfExists('vehicles');
    }
};
