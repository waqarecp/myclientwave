<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommunicationMethod extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'communication_methods';
    protected $fillable = [
        'company_id',
        'method_name',
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
