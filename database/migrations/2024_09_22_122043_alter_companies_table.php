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
        Schema::table('companies', function (Blueprint $table) {
            // Change company_employee_size first
            $table->integer('company_employee_size')->nullable()->default(1)
                  ->comment('1:1-10,2:10-50,etc.')
                  ->change();
                  
            // Rename company_business_descriptor to company_address
            $table->renameColumn('company_business_descriptor', 'company_address');
        });

        // Now update the new company_address column to be nullable
        Schema::table('companies', function (Blueprint $table) {
            $table->text('company_address')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            // Revert company_address back to company_business_descriptor
            $table->renameColumn('company_address', 'company_business_descriptor');

            // Change company_employee_size back to string
            $table->string('company_employee_size')->nullable()->change();
        });
    }
};
