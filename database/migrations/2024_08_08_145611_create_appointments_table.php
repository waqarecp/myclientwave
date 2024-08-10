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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('lead_id')->nullable();
            $table->unsignedBigInteger('representative_user')->nullable();
            $table->date('appointment_date')->nullable();
            $table->time('appointment_time')->nullable();
            $table->longText('appointment_notes')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            // Define foreign key constraints
            $table->foreign('lead_id')->references('id')->on('leads')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('set null');
            $table->foreign('representative_user')->references('id')->on('users')->onDelete('set null');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
        });
        $abilities = ['create', 'read', 'write'];
        $permission = 'appointment'; // Change this to your desired permission name
        
        foreach ($abilities as $ability) {
            Permission::create(['name' => $ability . ' ' . $permission]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
