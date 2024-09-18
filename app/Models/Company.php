<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'companies';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'phone',
        'email',
        'logo',
        'address',
        'website',
        'company_account_type',
        'company_employee_size',
        'company_account_plan',
        'company_business_name',
        'company_business_descriptor',
        'company_business_type',
        'company_business_description',
        'company_business_status',
        'created_by',
        'deleted_by',
    ];
}
