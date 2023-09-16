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
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->string('Devicenumber')->nullable();
            $table->integer('devicetype')->nullable(); //master or slave
            $table->unsignedBigInteger('devicebrand')->nullable(); //refer device_type
            // $table->foreign('devicebrand_id')->references('id')->on('device_types')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('status')->default(0);
            $table->bigInteger('priceTzs')->nullable();
            $table->bigInteger('priceUds')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
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
        Schema::dropIfExists('devices');
    }
};
