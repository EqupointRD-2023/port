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
        Schema::create('return_slave_ports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('master_id');
            $table->unsignedBigInteger('slave_id');
            $table->foreign('master_id')->references('id')->on('return_master_ports')->onDelete('cascade');
            $table->foreign('slave_id')->references('id')->on('devices')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('return_slave_ports');
    }
};
