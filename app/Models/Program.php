<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Program extends Model
{
    use HasFactory, SoftDeletes;
    
    // Define the table associated with the model.
    protected $table = 'programs';

    // Define the primary key for the model.
    protected $primaryKey = 'id';

    protected $fillable = [
        'tier_id', 
        'program_id', 
        'program_name',
        'region', 
        'money_factor_type', 
        'money_factor', 
        'min_age', 
        'max_age', 
        'lease_term', 
        'financing_type',
        'rate_participation', 
        'lease_facilitator_fee', 
        'acquisition_fee_markup',
        'effective_date', 
        'expiration_date', 
        'override_id',
        'created_by'
    ];

    public function tier()
    {
        return $this->belongsTo(Tier::class);
    }
}
