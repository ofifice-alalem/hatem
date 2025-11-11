<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('persons', function (Blueprint $table) {
            $table->dropForeign(['rank_id']);
            $table->dropColumn('rank_id');
        });
    }

    public function down(): void
    {
        Schema::table('persons', function (Blueprint $table) {
            $table->unsignedBigInteger('rank_id')->after('file_number');
            $table->foreign('rank_id')->references('id')->on('ranks')->onDelete('cascade');
        });
    }
};