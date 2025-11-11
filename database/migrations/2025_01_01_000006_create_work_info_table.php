<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('work_info', function (Blueprint $table) {
            $table->id();
            $table->string('national_id');
            $table->string('work_authority')->nullable();
            $table->string('work_location')->nullable();
            $table->string('office')->nullable();
            $table->string('assigned_task')->nullable();
            $table->unsignedBigInteger('employment_status_id')->nullable();
            $table->text('employment_status_detail')->nullable();
            $table->text('employment_notes')->nullable();
            $table->boolean('reviewed')->default(false);
            $table->boolean('leadership')->default(false);
            $table->string('financial_number')->nullable();
            $table->date('direct_date')->nullable();
            $table->string('wife_nationality')->nullable();
            $table->string('transfer_decision_number')->nullable();
            $table->date('transfer_date')->nullable();
            $table->string('transfer_authority')->nullable();
            $table->string('academic_degree')->nullable();
            $table->date('academic_degree_date')->nullable();
            $table->foreign('national_id')->references('national_id')->on('persons')->onDelete('cascade');
            $table->foreign('employment_status_id')->references('id')->on('employment_statuses')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('work_info');
    }
};