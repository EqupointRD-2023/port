<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('prices', function (Blueprint $table) {
            $table->id();
            $table->string('cargo_type');
            $table->decimal('master_price_usd', 10, 2);
            $table->decimal('master_price_tzs', 10, 2);
            $table->decimal('slave_price_usd', 10, 2)->nullable();
            $table->decimal('slave_price_tzs', 10, 2)->nullable();
            $table->decimal('add_slave_price_usd', 10, 2)->nullable();
            $table->decimal('add_slave_price_tzs', 10, 2)->nullable();
            $table->integer('approval_id')->nullable();
            $table->integer('approval_status')->nullable();
            $table->timestamp('approval_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prices');
    }
};
