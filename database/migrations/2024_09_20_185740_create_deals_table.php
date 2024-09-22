<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('deals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lead_id')->nullable();
            $table->unsignedBigInteger('project_administrator_id')->nullable();
            $table->unsignedBigInteger('owner_id')->nullable();
            $table->string('deal_name')->nullable();
            $table->text('deal_address')->nullable();
            $table->string('deal_phone_1')->nullable();
            $table->string('deal_email')->nullable();
            $table->unsignedBigInteger('financier_id')->nullable();
            $table->unsignedBigInteger('home_type_id')->nullable();
            $table->unsignedBigInteger('source_id')->nullable();
            $table->string('deal_account_name')->nullable();
            $table->string('deal_contact_name')->nullable();
            $table->string('deal_phone_burner_last_call_outcome')->nullable();
            $table->string('deal_social_lead_id')->nullable();
            $table->float('deal_amount')->nullable();
            $table->date('deal_closing_date')->nullable();
            $table->unsignedBigInteger('deal_pipeline')->nullable();
            $table->unsignedBigInteger('communication_method_id')->nullable();
            $table->unsignedBigInteger('stage_id')->nullable();
            $table->float('deal_probability')->nullable();
            $table->float('deal_expected_revenue')->nullable();
            $table->string('deal_permit_number')->nullable();
            $table->date('deal_phone_burner_followup_date')->nullable();
            $table->dateTime('deal_phone_burner_last_call_time')->nullable();
            $table->time('deal_availability_start')->nullable();
            $table->time('deal_availability_end')->nullable();
            $table->unsignedBigInteger('organization_id')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('lead_id')->references('id')->on('leads')->onDelete('set null');
            $table->foreign('project_administrator_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('home_type_id')->references('id')->on('home_types')->onDelete('set null');
            $table->foreign('source_id')->references('id')->on('lead_source')->onDelete('set null');
            $table->foreign('communication_method_id')->references('id')->on('communication_methods')->onDelete('set null');
            $table->foreign('stage_id')->references('id')->on('stages')->onDelete('set null');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
        });
        $abilities = ['create', 'read', 'write'];
        $permission = 'deal'; // Change this to your desired permission name
        
        foreach ($abilities as $ability) {
            Permission::create(['name' => $ability . ' ' . $permission]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deals');
    }
};
