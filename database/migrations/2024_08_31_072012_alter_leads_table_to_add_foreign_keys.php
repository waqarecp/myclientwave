<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Use raw SQL to rename columns
        DB::statement('ALTER TABLE leads CHANGE `country` `country_id` BIGINT UNSIGNED NOT NULL');
        DB::statement('ALTER TABLE leads CHANGE `state` `state_id` BIGINT UNSIGNED NOT NULL');
        DB::statement('ALTER TABLE leads CHANGE `city` `city_id` BIGINT UNSIGNED NULL DEFAULT NULL');

        // Add foreign key constraints
        Schema::table('leads', function (Blueprint $table) {
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop foreign keys first
        Schema::table('leads', function (Blueprint $table) {
            $table->dropForeign(['country_id']);
            $table->dropForeign(['state_id']);
            $table->dropForeign(['city_id']);
        });

        // Use raw SQL to rename columns back to original names
        DB::statement('ALTER TABLE leads CHANGE `country_id` `country` VARCHAR(191) NOT NULL');
        DB::statement('ALTER TABLE leads CHANGE `state_id` `state` VARCHAR(191) NOT NULL');
        DB::statement('ALTER TABLE leads CHANGE `city_id` `city` VARCHAR(191) NULL DEFAULT NULL');
    }
};
