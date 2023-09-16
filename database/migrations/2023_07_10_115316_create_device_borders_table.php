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
        Schema::create('device_borders', function (Blueprint $table) {
            $table->id();
            // $table->string('BatchNumber')->nullable();
            // $table->string('bindNumber')->nullable();
            // $table->unsignedBigInteger('masterId')->nullable();
            // $table->foreign('masterId')->references('id')->on('devices')->onUpdate('cascade')->onDelete('cascade');
            // $table->unsignedBigInteger('slaveId')->nullable();
            // $table->foreign('slaveId')->references('id')->on('devices')->onUpdate('cascade')->onDelete('cascade');
            // $table->unsignedBigInteger('border_id')->nullable();
            // $table->foreign('border_id')->references('id')->on('borders')->onUpdate('cascade')->onDelete('cascade');
            // $table->unsignedBigInteger('user_id')->nullable();
            // $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            // $table->string('status')->default(0);
            // $table->string('flag')->default(0);
            // $table->text('flag_comment')->nullable();
            // $table->string('receive_by')->nullable();
            // $table->string('receive_shortcut_status')->nullable();
            // $table->string('received_shortcut_by')->nullable();
            // $table->timestampTz('received_shortcut_date')->nullable();
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
        Schema::dropIfExists('device_borders');
    }
};
