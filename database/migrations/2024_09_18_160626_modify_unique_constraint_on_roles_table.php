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
        Schema::table('roles', function (Blueprint $table) {
            // Drop the existing unique constraint for 'name' and 'guard_name'
            $table->dropUnique(['name', 'guard_name']);

            // Add a new unique constraint for 'name', 'guard_name', and 'company_id'
            $table->unique(['name', 'guard_name', 'company_id'], 'roles_name_guard_company_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('roles', function (Blueprint $table) {
            // Drop the unique constraint for 'name', 'guard_name', and 'company_id'
            $table->dropUnique('roles_name_guard_company_unique');

            // Restore the original unique constraint for 'name' and 'guard_name'
            $table->unique(['name', 'guard_name']);
        });
    }
};
