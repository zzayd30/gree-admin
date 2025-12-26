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
        // Add created_by to users table
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('created_by')->nullable()->after('password')->constrained('users')->nullOnDelete();
        });

        // Add created_by to customers table
        Schema::table('customers', function (Blueprint $table) {
            $table->foreignId('created_by')->nullable()->after('password')->constrained('users')->nullOnDelete();
        });

        // Add created_by to categories table
        Schema::table('categories', function (Blueprint $table) {
            $table->foreignId('created_by')->nullable()->after('is_active')->constrained('users')->nullOnDelete();
        });

        // Add created_by to category_video table
        Schema::table('category_video', function (Blueprint $table) {
            $table->foreignId('created_by')->nullable()->after('video_id')->constrained('users')->nullOnDelete();
        });

        // Add created_by to roles table
        Schema::table('roles', function (Blueprint $table) {
            $table->foreignId('created_by')->nullable()->after('guard_name')->constrained('users')->nullOnDelete();
        });

        // Add created_by to permissions table
        Schema::table('permissions', function (Blueprint $table) {
            $table->foreignId('created_by')->nullable()->after('guard_name')->constrained('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropColumn('created_by');
        });

        Schema::table('customers', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropColumn('created_by');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropColumn('created_by');
        });

        Schema::table('category_video', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropColumn('created_by');
        });

        Schema::table('roles', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropColumn('created_by');
        });

        Schema::table('permissions', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropColumn('created_by');
        });
    }
};
