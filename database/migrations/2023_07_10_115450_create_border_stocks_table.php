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
        Schema::create('border_stocks', function (Blueprint $table) {
            $table->id();
            // $table->string('UntagNumber');
            // $table->string('bill_number')->nullable();
            // $table->unsignedBigInteger('unit_id');
            // $table->foreign('unit_id')->references('id')->on('devices')->onUpdate('cascade')->onDelete('cascade');
            // $table->integer('SlaveID');
            // $table->unsignedBigInteger('user_id');
            // $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            // $table->unsignedBigInteger('border_id');
            // $table->foreign('border_id')->references('id')->on('borders')->onUpdate('cascade')->onDelete('cascade');
            // $table->integer('status')->default(0);
            // $table->integer('flag')->nullable();
            // $table->text('flag_comment')->nullable();
            // $table->integer('receive_shortcut_status')->nullable();
            // $table->integer('received_shortcut_by ')->nullable();
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
        Schema::dropIfExists('border_stocks');
    }
};
