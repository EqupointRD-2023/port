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
        Schema::create('port_stock_slaves', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('port_master_id');
            $table->unsignedBigInteger('slave_id');
            $table->timestamps();
            $table->foreign('port_master_id')->references('id')->on('port_stock_masters')->onDelete('cascade');
            $table->foreign('slave_id')->references('id')->on('devices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('port_stock_slaves');
    }
};
