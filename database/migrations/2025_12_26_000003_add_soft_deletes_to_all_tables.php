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
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('deleted')->default(false);
        });

        Schema::table('customers', function (Blueprint $table) {
            $table->boolean('deleted')->default(false);
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->boolean('deleted')->default(false);
        });

        Schema::table('videos', function (Blueprint $table) {
            $table->boolean('deleted')->default(false);
        });

        Schema::table('troubleshoot_error_codes', function (Blueprint $table) {
            $table->boolean('deleted')->default(false);
        });

        Schema::table('troubleshoot_steps', function (Blueprint $table) {
            $table->boolean('deleted')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('deleted');
        });

        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn('deleted');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('deleted');
        });

        Schema::table('videos', function (Blueprint $table) {
            $table->dropColumn('deleted');
        });

        Schema::table('troubleshoot_error_codes', function (Blueprint $table) {
            $table->dropColumn('deleted');
        });

        Schema::table('troubleshoot_steps', function (Blueprint $table) {
            $table->dropColumn('deleted');
        });
    }
};
