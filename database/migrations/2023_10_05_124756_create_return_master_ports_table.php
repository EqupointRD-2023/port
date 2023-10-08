<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('return_master_ports', function (Blueprint $table) {
            $table->id();
            $table->string('return_number');
            $table->unsignedBigInteger('master_id');
            $table->unsignedBigInteger('return_user_id');
            $table->foreign('master_id')->references('id')->on('devices')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('return_user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('return_master_ports');
    }
};
