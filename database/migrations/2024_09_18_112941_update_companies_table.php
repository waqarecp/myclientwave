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
            // Add new columns
            $table->tinyInteger('company_account_type')->default(1)->comment('1:Basic, 2: Advanced');
            $table->string('company_employee_size')->nullable();
            $table->tinyInteger('company_account_plan')->default(1)->comment('1:Company Account, 2: Developer Account, 3: Testing Account');
            $table->string('company_business_name')->nullable();
            $table->text('company_business_descriptor')->nullable();
            $table->integer('company_business_type')->default(1)->comment('1: S Corporation, 2: C Corporation, 3: Sole Proprietorship, 4: Non-profit, 5: Limited Liability, 6: General Partnership');
            $table->text('company_business_description')->nullable();
            $table->tinyInteger('company_business_status')->default(1)->comment('1:Pending, 2: Approved, 3: Rejected');
            $table->unsignedBigInteger('deleted_by')->nullable();
            
            // Add foreign key constraint
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            // Drop added columns
            $table->dropColumn([
                'company_account_type',
                'company_employee_size',
                'company_account_plan',
                'company_business_name',
                'company_business_descriptor',
                'company_business_type',
                'company_business_description',
                'company_business_status',
                'deleted_by'
            ]);

            // Drop foreign key constraint
            $table->dropForeign(['deleted_by']);
        });
    }
};
