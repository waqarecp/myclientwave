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
        DB::statement('ALTER TABLE appointments CHANGE `appointment_country` `appointment_country_id` BIGINT UNSIGNED NOT NULL');
        DB::statement('ALTER TABLE appointments CHANGE `appointment_state` `appointment_state_id` BIGINT UNSIGNED NOT NULL');
        DB::statement('ALTER TABLE appointments CHANGE `appointment_city` `appointment_city_id` BIGINT UNSIGNED NULL DEFAULT NULL');

        // Add foreign key constraints
        Schema::table('appointments', function (Blueprint $table) {
            $table->foreign('appointment_country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->foreign('appointment_state_id')->references('id')->on('states')->onDelete('cascade');
            $table->foreign('appointment_city_id')->references('id')->on('cities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop foreign keys first
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropForeign(['appointment_country_id']);
            $table->dropForeign(['appointment_state_id']);
            $table->dropForeign(['appointment_city_id']);
        });

        // Use raw SQL to rename columns back to original names
        DB::statement('ALTER TABLE appointments CHANGE `appointment_country_id` `appointment_country` VARCHAR(191) NOT NULL');
        DB::statement('ALTER TABLE appointments CHANGE `appointment_state_id` `appointment_state` VARCHAR(191) NOT NULL');
        DB::statement('ALTER TABLE appointments CHANGE `appointment_city_id` `appointment_city` VARCHAR(191) NULL DEFAULT NULL');
    }
};
