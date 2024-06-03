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
        Schema::create('investors', function (Blueprint $table) {
            $table->id();
            $table->enum('status',['accept','decline'])->default('decline');
            $table->string('serial_number')->nullable();
            $table->string('name')->nullable();
            $table->string('fathers_name')->nullable();
            $table->string('mothers_name')->nullable();
            $table->string('spouse_name')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('marriage')->nullable();
            $table->string('present_address')->nullable();
            $table->string('spouse_date_birth')->nullable();
            $table->string('permanent_address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('facebook')->nullable();
            $table->string('main_amount')->nullable();
            $table->string('profession')->nullable();
            $table->string('office_address')->nullable();
            $table->string('nid_passport')->nullable();
            $table->string('nationality')->nullable();
            $table->string('project_name')->nullable();
            $table->string('project_address')->nullable();
            $table->string('ownership_size')->nullable();
            $table->string('category_ownership')->nullable();
            $table->string('no_ownership')->nullable();
            $table->string('price_ownership')->nullable();
            $table->string('special_discount')->nullable();
            $table->string('special_discount_word')->nullable();
            $table->string('agreed_price')->nullable();
            $table->string('agreed_price_word')->nullable();
            $table->string('installment')->nullable();
            $table->string('quarterly')->nullable();
            $table->string('half_yearly')->nullable();
            $table->string('yearly')->nullable();
            $table->string('at_a_time')->nullable();
            $table->string('down_payment')->nullable();
            $table->date('down_payment_date')->nullable();
            $table->string('down_payment_inWord')->nullable();
            $table->string('payment_type2')->nullable();
            $table->date('payment_type_date2')->nullable();
            $table->string('no_of_installment')->nullable();
            $table->string('inst_per_month')->nullable();
            $table->date('start_from')->nullable();
            $table->date('start_to')->nullable();
            $table->longText('others_instruction')->nullable();
            $table->string('nominee_name')->nullable();
            $table->string('nominee_cell_no')->nullable();
            $table->string('relation_to_nominee')->nullable();
            $table->string('nominee_image')->nullable();
            $table->string('reference_name_a')->nullable();
            $table->string('reference_cell_a')->nullable();
            $table->string('reference_name_b')->nullable();
            $table->string('reference_cell_b')->nullable();
            $table->string('user_image')->nullable();
            $table->string('religion')->nullable();
            $table->string('chq')->nullable();
            $table->string('online_payment')->nullable();
            $table->string('comments')->nullable();
            $table->string('employee_id')->nullable();
            $table->string('team_leader')->nullable();
            $table->string('teamId')->nullable();
            $table->foreign('teamId')->references('id')->on('team_leaders')->onDelete('cascade');
            $table->string('salesId')->nullable();
            $table->foreign('salesId')->references('id')->on('employees')->onDelete('cascade');
            $table->enum('investor_status',['approve','pending'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investors');
    }
};
