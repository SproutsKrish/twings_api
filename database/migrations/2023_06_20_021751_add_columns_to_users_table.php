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
        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger('mobile_number')->nullable()->after('email');
            $table->bigInteger('alternate_mobile_number')->nullable()->after('mobile_number');
            $table->string('address', 255)->nullable()->after('alternate_mobile_number');
            $table->string('licences', 50)->nullable()->after('address');
            $table->integer('country_id')->nullable()->after('licences');
            $table->tinyInteger('status')->default(1)->after('country_id');
            $table->dateTime('deleted_at')->nullable()->after('updated_at');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->string('ip_address', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'mobile_number',
                'country_id',
                'address',
                'alternat_mobile_number',
                'status',
                'deleted_at',
                'created_by',
                'updated_by',
                'deleted_by',
                'ip_address',
                'licences',
            ]);
        });
    }
};
