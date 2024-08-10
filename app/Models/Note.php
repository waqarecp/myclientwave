<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'notes';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lead_id',
        'company_id',
        'user_id',
        'notes',
        'is_read',
        'created_by',
    ];

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }
}
