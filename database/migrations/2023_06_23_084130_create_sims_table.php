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
            $table->string('networkprovider')->nullable();
            $table->date('purchase_date')->nullable();
            $table->bigInteger('imeinumber')->nullable();
            $table->bigInteger('simnumber')->nullable();
            $table->date('validfrom')->nullable();
            $table->date('validto')->nullable();
            $table->unsignedBigInteger('dealer_id')->nullable();
            $table->unsignedBigInteger('subdealer_id')->nullable();
            $table->unsignedBigInteger('userid')->nullable();
            $table->smallInteger('status')->default(1);
            $table->timestamps();
            $table->dateTime('deleted_at')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->string('ip_address')->nullable();
            // $table->foreign('dealer_id')->references('id')->on('dealers')->onDelete('set null');
            // $table->foreign('subdealer_id')->references('id')->on('subdealers')->onDelete('set null');
            // $table->foreign('userid')->references('id')->on('users')->onDelete('set null');
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
