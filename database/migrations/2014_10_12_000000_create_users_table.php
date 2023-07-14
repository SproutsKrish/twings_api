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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('secondary_password');
            $table->bigInteger('client_id')->nullable();
            $table->bigInteger('dealer_id')->nullable();
            $table->bigInteger('subdealer_id')->nullable();
            $table->bigInteger('role_id')->nullable();
            $table->bigInteger('country_id')->nullable();
            $table->string('country_name')->nullable();
            $table->string('timezone_name')->nullable();
            $table->string('timezone_offset')->nullable();
            $table->integer('timezone_minutes')->nullable();
            $table->tinyInteger('status')->nullable()->default(1);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
