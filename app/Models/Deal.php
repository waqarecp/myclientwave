<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Deal extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'deals';
    protected $fillable = [
        'lead_id',
        'project_administrator_id',
        'owner_id',
        'deal_name',
        'deal_address',
        'deal_phone_1',
        'deal_email',
        'financier_id',
        'home_type_id',
        'source_id',
        'deal_account_name',
        'deal_contact_name',
        'deal_phone_burner_last_call_outcome',
        'deal_social_lead_id',
        'deal_amount',
        'deal_closing_date',
        'deal_pipeline',
        'communication_method_id',
        'stage_id',
        'deal_probability',
        'deal_expected_revenue',
        'deal_permit_number',
        'deal_phone_burner_followup_date',
        'deal_phone_burner_last_call_time',
        'deal_availability_start',
        'deal_availability_end',
        'organization_id',
        'created_by',
        'updated_by',
    ];

    // Relationships
    public function lead()
    {
        return $this->belongsTo(Lead::class, 'lead_id');
    }

    public function projectAdministrator()
    {
        return $this->belongsTo(User::class, 'project_administrator_id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function homeType()
    {
        return $this->belongsTo(HomeType::class, 'home_type_id');
    }

    public function source()
    {
        return $this->belongsTo(LeadSource::class, 'source_id');
    }

    public function communicationMethod()
    {
        return $this->belongsTo(CommunicationMethod::class, 'communication_method_id');
    }
    
    public function stage()
    {
        return $this->belongsTo(Stage::class, 'stage_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
    
    public function dealTimeline()
    {
        return $this->hasMany(DealTimeline::class, 'deal_id');
    }
}
