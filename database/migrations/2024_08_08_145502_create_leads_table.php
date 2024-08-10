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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('owner_id')->nullable();
            $table->unsignedBigInteger('sale_representative')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('mobile')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->unsignedBigInteger('utility_company_id')->nullable();
            $table->string('street')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->string('country')->nullable();
            $table->unsignedBigInteger('call_center_representative')->nullable();
            $table->tinyInteger('lead_status')->default(1);
            $table->unsignedBigInteger('lead_source_id')->nullable();
            $table->tinyInteger('appointment_sat')->default(0)->comment('0: unchecked, 1:checked');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('set null');
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('sale_representative')->references('id')->on('users')->onDelete('set null');
            $table->foreign('utility_company_id')->references('id')->on('utility_companies')->onDelete('set null');
            $table->foreign('call_center_representative')->references('id')->on('users')->onDelete('set null');
            $table->foreign('lead_source_id')->references('id')->on('lead_source')->onDelete('set null');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
        });
        $abilities = ['create', 'read', 'write'];
        $permission = 'lead'; // Change this to your desired permission name
        
        foreach ($abilities as $ability) {
            Permission::create(['name' => $ability . ' ' . $permission]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
