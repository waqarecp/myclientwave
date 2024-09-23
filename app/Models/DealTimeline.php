<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DealTimeline extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'deal_timelines';
    protected $fillable = [
        'deal_id',
        'stage_id',
        'created_by',
        'updated_by',
    ];

    // Relationships

    public function deal()
    {
        return $this->belongsTo(Deal::class, 'deal_id');
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
}
