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
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supplier_id')->nullable();

            $table->unsignedBigInteger('device_type_id');
            $table->unsignedBigInteger('device_category_id');
            $table->unsignedBigInteger('device_model_id');

            $table->string('device_imei_no', 30);
            $table->string('ccid', 60)->nullable();
            $table->string('uid', 60)->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('sensor_name', 20);

            $table->date('purchase_date')->nullable();
            $table->unsignedBigInteger('dealer_id')->nullable();
            $table->unsignedBigInteger('subdealer_id')->nullable();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->smallInteger('status')->default(1);
            $table->timestamps();
            $table->dateTime('deleted_at')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->string('ip_address')->nullable();

            // $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('set null');

            // $table->foreign('device_type_id')->references('id')->on('device_type')->onDelete('set null');
            // $table->foreign('device_category_id')->references('id')->on('device_category')->onDelete('set null');
            // $table->foreign('device_model_id')->references('id')->on('device_model')->onDelete('set null');

            // $table->foreign('dealer_id')->references('id')->on('dealers')->onDelete('set null');
            // $table->foreign('subdealer_id')->references('id')->on('subdealers')->onDelete('set null');
            // $table->foreign('client_id')->references('id')->on('clients')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('devices');
    }
};
