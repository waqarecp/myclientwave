<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'leads';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'owner_id',
        'company_id',
        'sale_representative',
        'first_name',
        'last_name',
        'mobile',
        'phone',
        'email',
        'utility_company_id',
        'call_center_representative',
        'lead_source_id',
        'appointment_sat',
        'street',
        'city',
        'state',
        'zip',
        'country',
        'address_1',
        'address_2',
        'created_by',
        'note_added'
    ];

    public function leadSource()
    {
        return $this->belongsTo(LeadSource::class, 'lead_source_id');
    }
    
    public function utilityCompany()
    {
        return $this->belongsTo(UtilityCompany::class, 'utility_company_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function note()
    {
        return $this->hasMany(Note::class, 'lead_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
