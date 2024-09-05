<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("DROP VIEW IF EXISTS view_global_data");
        DB::statement("
            CREATE VIEW view_global_data AS
            SELECT 
                appointments.*, 
                leads.first_name, 
                leads.last_name, 
                CONCAT(leads.first_name, ' ', leads.last_name) as full_name, 
                leads.phone, 
                leads.email, 
                leads.mobile, 
                status.status_name, 
                status.color_code, 
                leads.company_id, 
                leads.deleted_at as lead_deleted_at
            FROM appointments 
            LEFT JOIN leads ON appointments.lead_id = leads.id 
            LEFT JOIN status ON appointments.status_id = status.id;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS view_global_data");
    }
};
