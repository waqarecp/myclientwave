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
        'company_id',
        'representative_user',
        'appointment_date',
        'appointment_time',
        'appointment_notes',
        'created_by',
    ];

    public function lead()
    {
        return $this->belongsTo(Lead::class, 'lead_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
