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
        Schema::create('persons', function (Blueprint $table) {
            $table->id('system_no');
            $table->string('file_no', 20);
            $table->string('national_no', 20)->unique();
            $table->string('name', 100);
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('rank_id');
            $table->foreign('type_id')->references('id')->on('types')->onDelete('cascade');
            $table->foreign('rank_id')->references('id')->on('ranks')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persons');
    }
};
