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
        Schema::create('fuel_configurations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('vehicle_id');
            $table->bigInteger('device_imei')->nullable();
            $table->double('fuel_a')->nullable();
            $table->double('fuel_b')->nullable();
            $table->double('fuel_c')->nullable();
            $table->double('fuel_d')->nullable();
            $table->double('fuel_limit')->nullable();
            $table->float('fuel_average')->default(1);
            $table->float('fuel_dip_ltr')->default(0);
            $table->float('fuel_fill_ltr')->default(0);
            $table->integer('fuel_flag')->default(0);
            $table->integer('fuel_is_set')->default(0);
            $table->tinyInteger('fuel_model')->nullable();
            $table->tinyInteger('fuel_type')->nullable();
            $table->tinyInteger('fuel_tank_type')->nullable();
            $table->integer('fuel_tank_capacity')->nullable();
            $table->integer('fuel_odo')->nullable();
            $table->string('fuel_tank', 30)->nullable();
            $table->tinyInteger('status')->nullable()->default(1);
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
            $table->BigInteger('created_by')->nullable();
            $table->BigInteger('updated_by')->nullable();
            $table->BigInteger('deleted_by')->nullable();
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
        Schema::dropIfExists('fuel_configurations');
    }
};
