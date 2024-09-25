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
        Schema::table('companies', function (Blueprint $table) {
            // Change company_employee_size first
            $table->integer('company_employee_size')->nullable()->default(1)
                  ->comment('1:1-10,2:10-50,etc.')
                  ->change();
        });

        DB::statement('ALTER TABLE companies CHANGE company_business_descriptor company_address TEXT DEFAULT NULL;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert company_address to company_business_descriptor
        DB::statement('ALTER TABLE companies CHANGE company_address company_business_descriptor TEXT DEFAULT NULL;');

        // Revert company_employee_size change
        Schema::table('companies', function (Blueprint $table) {
            $table->integer('company_employee_size')->nullable()->change();
        });
    }
};
