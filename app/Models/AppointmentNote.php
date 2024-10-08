<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class AppointmentNote extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'appointment_notes';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'appointment_id',
        'status_id',
        'user_id',
        'user_ids',
        'unread_ids',
        'notes',
        'is_read',
        'created_by',
        'reactions'
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'appointment_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
}
