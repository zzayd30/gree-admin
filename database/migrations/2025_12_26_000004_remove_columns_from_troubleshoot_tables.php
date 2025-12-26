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
        Schema::table('troubleshoot_error_codes', function (Blueprint $table) {
            $table->dropColumn(['description', 'deleted']);
        });

        Schema::table('troubleshoot_steps', function (Blueprint $table) {
            $table->dropColumn('deleted');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('troubleshoot_error_codes', function (Blueprint $table) {
            $table->text('description')->nullable();
            $table->boolean('deleted')->default(false);
        });

        Schema::table('troubleshoot_steps', function (Blueprint $table) {
            $table->boolean('deleted')->default(false);
        });
    }
};
