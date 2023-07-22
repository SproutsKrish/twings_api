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
        Schema::create('device_configurations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('vehicle_id');
            $table->bigInteger('device_imei')->nullable();
            $table->integer('device_assign_by')->nullable();
            $table->dateTime('device_assign_datetime')->nullable();
            $table->dateTime('device_time_updated')->nullable();
            $table->dateTime('device_time')->nullable();
            $table->tinyInteger('device_charge_status')->nullable();
            $table->tinyInteger('device_config_type')->nullable();
            $table->tinyInteger('device_type')->nullable();
            $table->double('device_battery')->nullable();
            $table->integer('device_lock_id')->nullable();
            $table->tinyInteger('status')->nullable()->default(1);
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
            $table->bigInteger('deleted_by')->nullable();
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
        Schema::dropIfExists('device_configurations');
    }
};
