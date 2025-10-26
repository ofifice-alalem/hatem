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
        Schema::create('military_info', function (Blueprint $table) {
            $table->id();
            $table->string('national_no', 20);
            $table->string('military_no', 20);
            $table->foreign('national_no')->references('national_no')->on('persons')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('military_info');
    }
};
