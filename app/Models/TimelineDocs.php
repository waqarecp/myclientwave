<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class TimelineDocs extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'timeline_docs';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'timeline_id',
        'file_uploaded',
        'created_by',
    ];

    public function timeline()
    {
        return $this->belongsTo(Timeline::class, 'timeline_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
