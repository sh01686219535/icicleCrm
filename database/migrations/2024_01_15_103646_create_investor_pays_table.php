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
        Schema::create('investor_pays', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('investor_id');
            $table->foreign('investor_id')->references('id')->on('investors')->onDelete('cascade');
            $table->string('start_month');
            $table->string('end_month');
            $table->string('per_int_amount_word');
            $table->string('payment_type')->nullable();
            $table->string('bank_name');
            $table->string('number_installment_upcomming');
            $table->string('branch_name');
            $table->string('total');
            $table->string('extra_pay')->nullable();
            $table->string('booking_money')->nullable();
            $table->string('project_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investor_pays');
    }
};
