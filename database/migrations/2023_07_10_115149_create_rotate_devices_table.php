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
        Schema::create('rotate_devices', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('DeviceId');
            // $table->foreign('DeviceId')->references('id')->on('devices')->onUpdate('cascade')->onDelete('cascade');
            // $table->integer('status')->default(0); //hapa namanisha kuwa hii itakuwa na default value 0/1
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rotate_devices');
    }
};
