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
        Schema::create('customer_orders', function (Blueprint $table) {
            $table->id();
            $table->string('orderNumb');
            $table->integer('user_id');
            $table->string('loading_point')->nullable();
            $table->date('load_date')->nullable();
            $table->unsignedBigInteger('border_id');
            $table->foreign('border_id')->references('id')->on('borders')->onUpdate('cascade')->onDelete('cascade');
            $table->string('exit_border');
            $table->integer('team_id')->nullable();
            $table->unsignedBigInteger('vehicle_id')->nullable();
            $table->foreign('vehicle_id')->references('id')->on('customer_vehicles')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('master_qty');
            $table->integer('slave_qty');
            $table->integer('tag_status')->nullable()->default(0);
            $table->integer('Ack_status')->default(0);
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
        Schema::dropIfExists('customer_orders');
    }
};
