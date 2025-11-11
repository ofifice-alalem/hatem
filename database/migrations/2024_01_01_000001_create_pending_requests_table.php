<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pending_requests', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // person, military_info, work_info
            $table->unsignedBigInteger('record_id');
            $table->json('original_data');
            $table->json('new_data');
            $table->string('status')->default('pending'); // pending, approved, rejected
            $table->string('requested_by')->nullable();
            $table->string('reviewed_by')->nullable();
            $table->text('rejection_reason')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pending_requests');
    }
};