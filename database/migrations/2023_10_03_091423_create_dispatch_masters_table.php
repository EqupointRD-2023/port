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
        Schema::create('dispatch_masters', function (Blueprint $table) {
            $table->id();
            $table->string('dispatchNo');
            $table->unsignedBigInteger('master_id');
            $table->unsignedBigInteger('requestId');
            $table->string('dispatcherId');
            $table->string('purpose');
            $table->timestamps();
            $table->foreign('master_id')->references('id')->on('devices')->onDelete('cascade');
            $table->foreign('requestId')->references('id')->on('requisitions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dispatch_masters');
    }
};
