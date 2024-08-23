<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Timeline extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'timeline';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'appointment_id',
        'status_id',
        'timeline_date',
        'note_added',
        'created_by',
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'appointment_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
    
    public function timelineDocs()
    {
        return $this->hasMany(TimelineDocs::class, 'timeline_id');
    }
}
