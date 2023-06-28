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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('client_company')->nullable();
            $table->string('client_name')->nullable();
            $table->string('client_email')->nullable();
            $table->bigInteger('client_mobile')->nullable();
            $table->bigInteger('client_alter_mobile')->nullable();
            $table->string('client_logo')->nullable();
            $table->integer('client_limit')->nullable();
            $table->integer('role_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('dealer_id')->nullable();
            $table->integer('subdealer_id')->nullable();
            $table->string('sms_title')->default('TWINGS');
            $table->string('sms_url')->nullable();
            $table->string('sms_username')->nullable();
            $table->string('sms_password')->nullable();
            $table->integer('sms_access')->nullable();
            $table->integer('vehicle_access')->nullable();
            $table->string('api_key')->nullable();
            $table->string('fuel_email')->nullable();
            $table->integer('route_deviation')->nullable();
            $table->integer('personal_track')->nullable();
            $table->string('client_address')->nullable();
            $table->string('client_city')->nullable();
            $table->string('client_state')->nullable();
            $table->string('client_country')->nullable();
            $table->integer('client_pincode')->nullable();
            $table->string('short_name')->nullable();
            $table->string('timezone_name')->nullable();
            $table->string('timezone_offset')->nullable();
            $table->string('timezone_minutes')->nullable();
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
        Schema::dropIfExists('clients');
    }
};
