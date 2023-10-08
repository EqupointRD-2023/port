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
        Schema::create('dispatch_slaves', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dispatch_master_id');
            $table->unsignedBigInteger('slave_id');
            $table->timestamps();
            $table->foreign('dispatch_master_id')->references('id')->on('dispatch_masters')->onDelete('cascade');
            $table->foreign('slave_id')->references('id')->on('devices')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dispatch_slaves');
    }
};
