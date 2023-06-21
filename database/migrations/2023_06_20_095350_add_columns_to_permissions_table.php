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
        Schema::table('permissions', function (Blueprint $table) {
            $table->integer('module_id')->nullable()->after('id');
            $table->integer('page_id')->nullable()->after('module_id');
            $table->string('url_name')->nullable()->after('name');
            $table->tinyInteger('status')->nullable()->default(1)->after('guard_name');
            $table->dateTime('deleted_at')->nullable()->after('updated_at');
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
        Schema::table('permissions', function (Blueprint $table) {
            $table->dropColumn([
                'module_id',
                'page_id',
                'url_name',
                'status',
                'deleted_at',
                'created_by',
                'updated_by',
                'deleted_by',
                'ip_address'
            ]);
        });
    }
};
