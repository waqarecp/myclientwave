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
        Schema::table('appointment_notes', function (Blueprint $table) {
            $table->json('reactions')->nullable(); // To store reactions as JSON
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointment_notes', function (Blueprint $table) {
            $table->dropColumn('reactions');
        });
    }
};
