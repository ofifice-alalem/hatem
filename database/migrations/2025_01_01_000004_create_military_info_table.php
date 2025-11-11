<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('military_info', function (Blueprint $table) {
            $table->id();
            $table->string('national_id');
            $table->unsignedBigInteger('military_rank_id');
            $table->string('military_number')->nullable();
            $table->date('appointment_date')->nullable();
            $table->string('appointment_authority')->nullable();
            $table->string('appointment_decision_number')->nullable();
            $table->date('last_promotion_date')->nullable();
            $table->string('last_promotion_decision')->nullable();
            $table->integer('last_promotion_year')->nullable();
            $table->string('seniority')->nullable();
            $table->foreign('national_id')->references('national_id')->on('persons')->onDelete('cascade');
            $table->foreign('military_rank_id')->references('id')->on('ranks')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('military_info');
    }
};