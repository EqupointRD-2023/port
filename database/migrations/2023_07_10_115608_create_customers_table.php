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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('compy_name');
            $table->string('phone')->nullable();
            $table->string('customer_type');
            $table->string('address_name')->nullable();
            $table->string('currency')->nullable();
            $table->double('master_price', 8, 2)->nullable();
            $table->double('slave_price', 8, 2)->nullable();
            $table->string('status')->default(0);
            $table->timestampsTz();
        });

        Schema::create('customer_agencies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
        Schema::dropIfExists('customer_agencies');
        Schema::dropIfExists('customer_vehicles');
        Schema::dropIfExists('customer_orders');
    }
};
