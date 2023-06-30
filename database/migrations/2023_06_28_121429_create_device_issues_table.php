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
        Schema::create('device_issues', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vehicle_type_id');
            $table->string('vehicle_make')->nullable();
            $table->string('vehicle_model')->nullable();
            $table->string('vehicle_year')->nullable();
            $table->string('vehicle_name')->nullable();
            $table->string('chassis_number')->nullable();
            $table->string('engine_number')->nullable();
            $table->string('registration_number')->nullable();
            $table->date('registration_date')->nullable();
            $table->string('device_imei');
            $table->string('device_category');
            $table->string('device_model');
            $table->string('device_type');
            $table->string('ccid');
            $table->string('uid');
            $table->bigInteger('primary_mob_no');
            $table->bigInteger('secondary_mob_no');
            $table->string('state');
            $table->string('rto_number');
            $table->unsignedBigInteger('certificate_id');
            $table->string('certificate_no');
            $table->string('installed_date');
            $table->string('recalibration_date');
            $table->string('invoice_date');
            $table->string('invoice_number');
            $table->string('panic_button');
            $table->bigInteger('aadhaar_no');
            $table->string('image1');
            $table->string('image2');
            $table->string('image3');
            $table->string('qrimg');
            $table->unsignedBigInteger('dealer_id')->nullable();
            $table->unsignedBigInteger('subdealer_id')->nullable();
            $table->unsignedBigInteger('client_id')->nullable();
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
        Schema::dropIfExists('device_issues');
    }
};
