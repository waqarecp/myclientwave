<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class UtilityCompany extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'utility_companies';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id',
        'utility_company_name',
        'created_by',
    ];
}
