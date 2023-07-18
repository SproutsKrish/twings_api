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
        Schema::create('points', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('point_type_id');
            $table->float('total_point');
            $table->float('balance_point');
            $table->integer('dealer_id')->nullable();
            $table->integer('subdealer_id')->nullable();
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
        Schema::dropIfExists('points');
    }
};
