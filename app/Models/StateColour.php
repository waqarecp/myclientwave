<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class StateColour extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'state_colours';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id',
        'state_id',
        'color_code',
        'created_by',
        'updated_by',
    ];
    
    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
