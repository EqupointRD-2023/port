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
        Schema::create('return_borders', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('unit_id')->nullable();
            // $table->foreign('unit_id')->references('id')->on('devices')->onUpdate('cascade')->onDelete('cascade');
            // $table->unsignedBigInteger('border_id')->nullable();
            // $table->foreign('border_id')->references('id')->on('borders')->onUpdate('cascade')->onDelete('cascade');
            // $table->unsignedBigInteger('user_id')->nullable();
            // $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            // $table->string('status')->default(0);
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
        Schema::dropIfExists('return_borders');
    }
};
