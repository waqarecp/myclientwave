<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'appointments';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lead_id',
        'representative_user',
        'appointment_date',
        'appointment_time',
        'appointment_street',
        'appointment_country_id',
        'appointment_state_id',
        'appointment_city_id',
        'appointment_zip',
        'appointment_address_1',
        'appointment_address_2',
        'note_added',
        'has_new_comments',
        'created_by',
        'status_id',
        'timeline_date',
        'file_uploaded'
    ];

    public function lead()
    {
        return $this->belongsTo(Lead::class, 'lead_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
    
    public function timeline()
    {
        return $this->hasMany(Timeline::class, 'appointment_id');
    }

    public function appointmentNotes()
    {
        return $this->hasMany(AppointmentNote::class, 'appointment_id');
    }
    public function country()
    {
        return $this->belongsTo(Country::class, 'appointment_country_id');
    }
    
    public function state()
    {
        return $this->belongsTo(State::class, 'appointment_state_id');
    }
    
    public function city()
    {
        return $this->belongsTo(City::class, 'appointment_city_id');
    }
}
