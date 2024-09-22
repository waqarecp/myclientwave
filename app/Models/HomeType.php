<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HomeType extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'home_types';
    protected $fillable = [
        'company_id',
        'home_type_name',
        'created_by',
        'updated_by',
    ];

    // Relationships

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
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
