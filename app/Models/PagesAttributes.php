<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PagesAttributes extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id',
        'api_key_id',
        'marketing_channel_id',
        'event_id',
        'device_id',
        'page_id',
        'value',
        'date',
    ];
}
