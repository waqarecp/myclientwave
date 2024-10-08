<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Laravel\Cashier\Billable;
class Company extends Model
{
    use HasFactory, SoftDeletes, Billable;
    protected $table = 'companies';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'contact_person_name',
        'phone',
        'email',
        'logo',
        'address',
        'website',
        'account_type',
        'employee_size',
        'account_plan',
        'business_name',
        'business_type',
        'description',
        'business_status',
        'created_by',
        'deleted_by',
        'stripe_id',
        'pm_type',
        'pm_last_four',
        'trial_ends_at',
    ];
}
