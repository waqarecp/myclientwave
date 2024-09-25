<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ModifyCompaniesTableColumns extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            // Using raw SQL to rename columns
            DB::statement('ALTER TABLE companies CHANGE company_account_type account_type TINYINT DEFAULT 1');
            DB::statement('ALTER TABLE companies CHANGE company_employee_size employee_size INTEGER DEFAULT 1');
            DB::statement('ALTER TABLE companies CHANGE company_account_plan account_plan TINYINT DEFAULT 1');
            DB::statement('ALTER TABLE companies CHANGE company_business_type business_type INTEGER DEFAULT 1');
            DB::statement('ALTER TABLE companies CHANGE company_business_description description TEXT DEFAULT NULL');

            // Drop unnecessary columns
            $table->dropColumn([
                'company_business_name',
                'company_address',
                'company_business_status'
            ]);

            // Add new columns if they don't exist
            if (!Schema::hasColumn('companies', 'contact_person_name')) {
                $table->string('contact_person_name')->nullable()->after('name');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            // Revert the renaming using raw SQL
            DB::statement('ALTER TABLE companies CHANGE account_type company_account_type INTEGER DEFAULT NULL');
            DB::statement('ALTER TABLE companies CHANGE employee_size company_employee_size INTEGER DEFAULT NULL');
            DB::statement('ALTER TABLE companies CHANGE account_plan company_account_plan TINYINT DEFAULT 1');
            DB::statement('ALTER TABLE companies CHANGE business_type company_business_type INTEGER DEFAULT 1');
            DB::statement('ALTER TABLE companies CHANGE description company_business_description TEXT DEFAULT NULL');

            $table->string('company_business_name')->nullable();
            $table->text('company_address')->nullable();
            $table->tinyInteger('company_business_status')->default(1)->comment('1: Pending, 2: Approved, 3: Rejected');

            // Drop added columns
            $table->dropColumn('contact_person_name');
            
        });
    }
}
