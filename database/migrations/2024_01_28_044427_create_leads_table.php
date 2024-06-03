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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email');
            $table->string('phone_number');
            $table->string('image')->nullable();
            $table->string('job_title');
            $table->string('city');
            $table->string('comments');
            $table->unsignedBigInteger('sales_officer');
            $table->foreign('sales_officer')->references('id')->on('employees')->onDelete('cascade');
            $table->unsignedBigInteger('team_leader');
            $table->foreign('team_leader')->references('id')->on('team_leaders')->onDelete('cascade');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
