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
        Schema::create('sims', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('network_id')->nullable();

            $table->bigInteger('sim_imei_no')->nullable();
            $table->bigInteger('sim_mob_no')->nullable();

            $table->date('valid_from')->nullable();
            $table->date('valid_to')->nullable();

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

            // $table->foreign('network_id')->references('id')->on('networks')->onDelete('set null');
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
        Schema::dropIfExists('sims');
    }
};
