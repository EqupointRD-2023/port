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
        Schema::create('swap_devices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lease_number');
            $table->foreign('lease_number')->references('id')->on('leases')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('master_id');
            $table->foreign('master_id')->references('id')->on('devices')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('master_new_id');
            $table->foreign('master_new_id')->references('id')->on('devices')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('slave_id');
            $table->foreign('slave_id')->references('id')->on('devices')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('slave_new_id');
            $table->foreign('slave_new_id')->references('id')->on('devices')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('swap_devices');
    }
};
