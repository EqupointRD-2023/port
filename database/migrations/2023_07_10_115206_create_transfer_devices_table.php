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
        Schema::create('transfer_devices', function (Blueprint $table) {
            $table->id();
            // $table->string('tansfer_number');
            // $table->unsignedBigInteger('device_id');
            // $table->foreign('device_id')->references('id')->on('devices')->onUpdate('cascade')->onDelete('cascade');
            // $table->unsignedBigInteger('from_team_id');
            // $table->foreign('from_team_id')->references('id')->on('teams')->onUpdate('cascade')->onDelete('cascade');
            // $table->unsignedBigInteger('to_team_id');
            // $table->foreign('to_team_id')->references('id')->on('teams')->onUpdate('cascade')->onDelete('cascade');
            // $table->unsignedBigInteger('approver')->nullable();
            // $table->foreign('approver')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            // $table->date('approve_date')->nullable();
            // $table->date('cancelled_date')->nullable();
            // $table->integer('status')->default(0);
            // $table->unsignedBigInteger('created_by')->nullable();
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
        Schema::dropIfExists('transfer_devices');
    }
};
