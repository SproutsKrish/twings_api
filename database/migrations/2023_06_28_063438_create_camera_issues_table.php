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
            $table->bigInteger('vehicle_id');
            $table->string('camera_category');
            $table->bigInteger('certificate_id')->default(0);
            $table->string('certificate_no')->nullable();
            $table->bigInteger('camera_id');
            $table->string('serial_no');
            $table->date('installed_date')->nullable();
            $table->string('rto_no')->nullable();
            $table->string('state')->nullable();
            $table->string('aadhaar_no')->nullable();
            $table->string('image1');
            $table->string('image2');
            $table->string('image3');
            $table->string('qrimg');
            $table->integer('dealer_id')->nullable();
            $table->integer('subdealer_id')->nullable();
            $table->integer('client_id')->nullable();
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
        Schema::dropIfExists('camera_issues');
    }
};
