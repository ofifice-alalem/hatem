<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('persons', function (Blueprint $table) {
            $table->id();
            $table->string('file_type');
            $table->string('file_number');
            $table->unsignedBigInteger('rank_id');
            $table->string('name');
            $table->date('birth_date')->nullable();
            $table->string('birth_place')->nullable();
            $table->string('gender')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mother_nationality')->nullable();
            $table->string('blood_type')->nullable();
            $table->string('national_id')->unique();
            $table->string('personal_card_number')->nullable();
            $table->string('passport_number')->nullable();
            $table->foreign('rank_id')->references('id')->on('ranks')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('persons');
    }
};