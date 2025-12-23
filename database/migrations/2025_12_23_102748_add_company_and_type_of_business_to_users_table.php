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
            if (!Schema::hasColumn('users', 'company')) {
                $table->string('company')->nullable()->after('email');
            }
            if (!Schema::hasColumn('users', 'type_of_business_id')) {
                $table->unsignedBigInteger('type_of_business_id')->nullable()->after('company');
                $table->foreign('type_of_business_id')->references('id')->on('type_of_business')->nullOnDelete();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['type_of_business_id']);
            $table->dropColumn(['company', 'type_of_business_id']);
        });
    }
};
