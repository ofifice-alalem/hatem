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
        Schema::create('pending_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('person_id');
            $table->unsignedBigInteger('old_type_id');
            $table->unsignedBigInteger('new_type_id');
            $table->unsignedBigInteger('old_rank_id');
            $table->unsignedBigInteger('new_rank_id');
            $table->string('old_military_no')->nullable();
            $table->string('new_military_no')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->foreign('person_id')->references('system_no')->on('persons')->onDelete('cascade');
            $table->foreign('old_type_id')->references('id')->on('types');
            $table->foreign('new_type_id')->references('id')->on('types');
            $table->foreign('old_rank_id')->references('id')->on('ranks');
            $table->foreign('new_rank_id')->references('id')->on('ranks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pending_requests');
    }
};
