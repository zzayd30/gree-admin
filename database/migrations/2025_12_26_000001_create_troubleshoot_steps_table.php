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
        Schema::create('troubleshoot_steps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('troubleshoot_error_code_id')->constrained('troubleshoot_error_codes')->onDelete('cascade');
            $table->integer('step_number');
            $table->string('action');
            $table->json('tips')->nullable(); // Array of tips
            $table->string('sensor_type')->nullable(); // For single sensor type
            $table->json('sensor_types')->nullable(); // For multiple sensor types
            $table->timestamps();

            // Index for better performance
            $table->index(['troubleshoot_error_code_id', 'step_number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('troubleshoot_steps');
    }
};
