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
            // Check if the column doesn't already exist
            if (!Schema::hasColumn('roles', 'company_id')) {
                // Make company_id nullable and set default value
                $table->unsignedBigInteger('company_id')->nullable()->default(1);

                // Add the foreign key constraint with ON DELETE SET NULL
                $table->foreign('company_id')->references('id')->on('companies')->onDelete('set null');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('roles', function (Blueprint $table) {
            // Drop foreign key constraint before dropping the column
            if (Schema::hasColumn('roles', 'company_id')) {
                $table->dropForeign(['company_id']);
                $table->dropColumn('company_id');
            }
        });
    }
};
