<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FirebaseToken extends Model
{
    use HasFactory;
    
    protected $table = 'firebase_tokens';

    protected $fillable = [
        'user_id',
        'device_id',
        'fcm_token',
    ];
}
