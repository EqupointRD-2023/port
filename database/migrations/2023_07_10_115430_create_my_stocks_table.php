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
        Schema::create('my_stocks', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('unit_id'); //devive id
            // $table->foreign('unit_id')->references('id')->on('devices')->onUpdate('cascade')->onDelete('cascade');
            // $table->unsignedBigInteger('team_id');
            // $table->foreign('team_id')->references('id')->on('teams')->onUpdate('cascade')->onDelete('cascade');
            // $table->integer('status')->default(0);
            // $table->integer('r_status')->default(0);
            // $table->unsignedBigInteger('user_id');
            // $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            // $table->integer('receive_shortcut_status')->nullable();
            // $table->integer('received_shortcut_by ')->nullable();
            // $table->timestampTz('received_shortcut_date')->nullable();
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
        Schema::dropIfExists('my_stocks');
    }
};
