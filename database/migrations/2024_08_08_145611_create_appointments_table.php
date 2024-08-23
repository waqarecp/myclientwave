<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lead_id')->nullable();
            $table->unsignedBigInteger('representative_user')->nullable();
            $table->date('appointment_date')->nullable();
            $table->time('appointment_time')->nullable();
            $table->string('appointment_street')->nullable();
            $table->string('appointment_city')->nullable();
            $table->string('appointment_state')->nullable();
            $table->string('appointment_zip')->nullable();
            $table->string('appointment_country')->nullable();
            $table->longText('appointment_address_1')->nullable();
            $table->longText('appointment_address_2')->nullable();
            $table->tinyInteger('note_added')->default(0)->comment('0:Not Added, 1: Added');
            $table->tinyInteger('has_new_comments')->default(0)->comment('0:No comment, 1: has comment');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->date('timeline_date')->default(DB::raw('CURRENT_DATE'));
            $table->text('file_uploaded')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            // Define foreign key constraints
            $table->foreign('lead_id')->references('id')->on('leads')->onDelete('cascade');
            $table->foreign('status_id')->references('id')->on('status')->onDelete('set null');
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
