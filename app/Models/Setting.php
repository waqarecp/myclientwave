<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $table = 'assigned_country';
    protected $fillable = [
        'company_id',
        'country_id',
    ];
    
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
    
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
}
