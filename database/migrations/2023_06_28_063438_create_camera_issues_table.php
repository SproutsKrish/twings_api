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
        Schema::create('camera_issues', function (Blueprint $table) {
            $table->id();
            $table->integer('vehicle_type_id');
            $table->string('vehicle_make')->nullable();
            $table->string('vehicle_model')->nullable();
            $table->string('vehicle_year')->nullable();
            $table->string('vehicle_name')->nullable();
            $table->string('chassis_number')->nullable();
            $table->string('engine_number')->nullable();
            $table->string('registration_number')->nullable();
            $table->date('registration_date')->nullable();
            $table->string('rto_no');
            $table->date('issue_date')->nullable();
            $table->integer('camera_id')->nullable();
            $table->string('camera_serial_no');
            $table->string('image1');
            $table->string('image2');
            $table->string('image3');
            $table->string('qrimg');
            $table->string('camera_category');
            $table->tinyInteger('certificate_id')->default(0);
            $table->string('certificate_no')->nullable();
            $table->integer('subdealer_id')->nullable();
            $table->integer('dealer_id')->nullable();
            $table->integer('client_id')->nullable();
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
        Schema::dropIfExists('camera_issues');
    }
};
