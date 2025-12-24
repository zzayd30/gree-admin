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
            // Drop company and type_of_business_id columns
            if (Schema::hasColumn('users', 'company')) {
                $table->dropColumn('company');
            }
            
            if (Schema::hasColumn('users', 'type_of_business_id')) {
                $table->dropColumn('type_of_business_id');
            }
            
            // Add status column
            if (!Schema::hasColumn('users', 'status')) {
                $table->enum('status', ['active', 'inactive'])->default('active')->after('profile_picture');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Remove status column
            if (Schema::hasColumn('users', 'status')) {
                $table->dropColumn('status');
            }
            
            // Add back company and type_of_business_id
            if (!Schema::hasColumn('users', 'company')) {
                $table->string('company')->nullable()->after('email');
            }
            
            if (!Schema::hasColumn('users', 'type_of_business_id')) {
                $table->unsignedBigInteger('type_of_business_id')->nullable()->after('company');
                $table->foreign('type_of_business_id')->references('id')->on('type_of_businesses')->nullOnDelete();
            }
        });
    }
};
