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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('c_email')->nullable();
            $table->string('location_id')->nullable();
            $table->string('customer_id')->nullable();
            $table->unsignedBigInteger('team_id')->nullable();
            // $table->foreign('team_id')->references('id')->on('teams')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('department_id')->nullable();
            $table->foreign('department_id')->references('id')->on('departments')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('border_id')->nullable();
            $table->foreign('border_id')->references('id')->on('borders')->onUpdate('cascade')->onDelete('cascade');
            $table->timestampTz('email_verified_at')->nullable();
            $table->string('password');
            $table->string('address')->nullable();
            $table->string('gender')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('position')->nullable();
            $table->integer('created_by')->nullable();
            $table->dateTimeTz('created_date')->nullable();
            $table->integer('approved_by')->nullable();
            $table->integer('activated_by')->nullable();
            $table->integer('deactivated_by')->nullable();
            $table->integer('depertment_id')->nullable();
            $table->string('phone')->nullable();
            $table->string('sex')->nullable();
            $table->integer('approved_status')->nullable();
            $table->dateTimeTz('approved_date')->nullable();
            $table->dateTimeTz('approve_status')->nullable();
            $table->integer('is_active')->default(0);
            $table->integer('enabled_by')->nullable();
            $table->dateTimeTz('enable_date')->nullable();
            $table->integer('disable_by')->nullable();
            $table->dateTimeTz('disable_date')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
