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
        Schema::create('leases', function (Blueprint $table) {
            $table->id();
            $table->string('lease_number');
            $table->unsignedBigInteger('master_id');
            $table->foreign('master_id')->references('id')->on('devices')->onUpdate('cascade')->onDelete('cascade');
            $table->json('slave_id')->nullable();
            $table->json('prev_master_id')->nullable();
            $table->json('prev_slave_id')->nullable();
            $table->unsignedBigInteger('tager_id');
            $table->foreign('tager_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('tag_id');
            $table->foreign('tag_id')->references('id')->on('tag_points')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id')->references('id')->on('customers')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('border_id');
            $table->foreign('border_id')->references('id')->on('borders')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id')->references('id')->on('teams')->onUpdate('cascade')->onDelete('cascade');
            $table->String('pricetype')->nullable();
            $table->bigInteger('master_price')->default(0);
            $table->bigInteger('slave_price')->default(0);
            $table->string('lease_type')->nullable();
            $table->string('brand')->nullable();
            $table->string('It_number')->nullable();
            $table->string('chasis_number')->nullable();
            $table->string('truck_number')->nullable();
            $table->string('trailer_number')->nullable();
            $table->string('cargo_type')->nullable();
            $table->string('customer_name')->nullable();
            $table->bigInteger('ack_status')->default(0);
            $table->string('ack_comment')->nullable();
            $table->string('driver_name')->nullable();
            $table->string('driver_phone')->nullable();
            $table->string('driver_licence')->nullable();
            $table->bigInteger('subT1')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leases');
    }
};
