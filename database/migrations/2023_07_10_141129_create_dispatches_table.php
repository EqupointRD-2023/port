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
        Schema::create('dispatches', function (Blueprint $table) {
            $table->id();
            $table->String('dispatchNo');
            $table->unsignedBigInteger('deviceId')->nullable();
            $table->foreign('deviceId')->references('id')->on('devices')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('requestId');
            $table->foreign('requestId')->references('id')->on('requisitions')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('dispatcherId');
            $table->foreign('dispatcherId')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->String('purpose');
            $table->bigInteger('dispatchStatus')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dispatches');
    }
};
