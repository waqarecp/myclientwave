<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            // Drop unnecessary columns only if they exist
            if (Schema::hasColumn('companies', 'company_account_type')) {
                $table->dropColumn('company_account_type');
            }
            if (Schema::hasColumn('companies', 'company_business_name')) {
                $table->dropColumn('company_business_name');
            }
            if (Schema::hasColumn('companies', 'company_business_descriptor')) {
                $table->dropColumn('company_business_descriptor');
            }
            if (Schema::hasColumn('companies', 'company_address')) {
                $table->dropColumn('company_address');
            }
            if (Schema::hasColumn('companies', 'company_business_status')) {
                $table->dropColumn('company_business_status');
            }

            // Add new columns if they don't exist
            if (!Schema::hasColumn('companies', 'contact_person_name')) {
                $table->string('contact_person_name')->nullable()->after('name');
            }
            if (!Schema::hasColumn('companies', 'account_type')) {
                $table->tinyInteger('account_type')->default(1)->comment('1: Basic, 2: Advanced')->after('address');
            }
            // Rename columns using raw SQL
            if (Schema::hasColumn('companies', 'company_employee_size')) {
                DB::statement('ALTER TABLE companies CHANGE company_employee_size employee_size INTEGER DEFAULT 1 AFTER account_type');
            }
            if (Schema::hasColumn('companies', 'company_account_plan')) {
                DB::statement('ALTER TABLE companies CHANGE company_account_plan account_plan TINYINT DEFAULT 1 AFTER employee_size');
            }
            if (Schema::hasColumn('companies', 'company_business_type')) {
                DB::statement('ALTER TABLE companies CHANGE company_business_type business_type INTEGER DEFAULT 1 AFTER account_plan');
            }
            if (Schema::hasColumn('companies', 'company_business_description')) {
                DB::statement('ALTER TABLE companies CHANGE company_business_description description TEXT DEFAULT NULL AFTER business_type');
            }

            if (!Schema::hasColumn('companies', 'deleted_by')) {
                $table->unsignedBigInteger('deleted_by')->nullable()->after('deleted_at');
                $table->foreign('deleted_by')->references('id')->on('users')->onDelete('set null');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            // Revert renaming using raw SQL
            if (Schema::hasColumn('companies', 'employee_size')) {
                DB::statement('ALTER TABLE companies CHANGE employee_size company_employee_size INTEGER DEFAULT NULL');
            }
            if (Schema::hasColumn('companies', 'account_plan')) {
                DB::statement('ALTER TABLE companies CHANGE account_plan company_account_plan TINYINT DEFAULT 1');
            }
            if (Schema::hasColumn('companies', 'business_type')) {
                DB::statement('ALTER TABLE companies CHANGE business_type company_business_type INTEGER DEFAULT 1');
            }
            if (Schema::hasColumn('companies', 'description')) {
                DB::statement('ALTER TABLE companies CHANGE description company_business_description TEXT DEFAULT NULL');
            }

            // Re-add dropped columns if they don't exist
            if (!Schema::hasColumn('companies', 'company_account_type')) {
                $table->tinyInteger('company_account_type')->default(1)->comment('1: Basic, 2: Advanced');
            }
            if (!Schema::hasColumn('companies', 'company_business_name')) {
                $table->string('company_business_name')->nullable();
            }
            if (!Schema::hasColumn('companies', 'company_business_descriptor')) {
                $table->text('company_business_descriptor')->nullable();
            }
            if (!Schema::hasColumn('companies', 'company_business_status')) {
                $table->tinyInteger('company_business_status')->default(1)->comment('1: Pending, 2: Approved, 3: Rejected');
            }
            if (!Schema::hasColumn('companies', 'company_address')) {
                $table->string('company_address')->nullable();
            }

            // Drop added columns if they exist
            if (Schema::hasColumn('companies', 'contact_person_name')) {
                $table->dropColumn('contact_person_name');
            }
            if (Schema::hasColumn('companies', 'account_type')) {
                $table->dropColumn('account_type');
            }

            // Drop the foreign key and column for deleted_by
            if (Schema::hasColumn('companies', 'deleted_by')) {
                $table->dropForeign(['deleted_by']);
                $table->dropColumn('deleted_by');
            }
        });
    }
};
