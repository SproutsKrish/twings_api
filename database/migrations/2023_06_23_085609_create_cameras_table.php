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
        Schema::create('cameras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supplier_id')->nullable();

            $table->unsignedBigInteger('camera_type_id');
            $table->unsignedBigInteger('camera_category_id');
            $table->unsignedBigInteger('camera_model_id');

            $table->string('serial_no', 60)->nullable();
            $table->string('id_no', 60)->nullable();

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

            // $table->foreign('camera_type_id')->references('id')->on('camera_type')->onDelete('set null');
            // $table->foreign('camera_category_id')->references('id')->on('camera_category')->onDelete('set null');
            // $table->foreign('camera_model_id')->references('id')->on('camera_model')->onDelete('set null');

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
        Schema::dropIfExists('cameras');
    }
};
