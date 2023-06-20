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
            $table->string('country_name')->nullable()->after('country_id');
            $table->string('timezone_name')->nullable()->after('country_name');
            $table->integer('timezone_minutes')->nullable()->after('timezone_name');
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
                'country_name',
                'timezone_name',
                'timezone_minutes'
            ]);
        });
    }
};
