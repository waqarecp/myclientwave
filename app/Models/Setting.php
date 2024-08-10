<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory, SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'api_credentials';
    public $timestamps = false;

    protected $fillable = [
        'dealer_id',
        'platform_name',
        'api_key',
        'api_url',
        'username',
        'password',
        'user_id',
        'status'
    ];

    public function dealer()
    {
        return $this->belongsTo(Dealer::class, 'dealer_id');
    }
}
