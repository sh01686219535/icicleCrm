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
        Schema::create('task_coments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lead_user')->nullable();
            $table->foreign('lead_user')->references('id')->on('leads')->onDelete('cascade');
            $table->unsignedBigInteger('task_id')->nullable();
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
            $table->unsignedBigInteger('emplyoee_id')->nullable();
            $table->foreign('emplyoee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->string('next_action')->nullable();
            $table->string('next_action_date')->nullable();
            $table->string('todays_update')->nullable();
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_coments');
    }
};
