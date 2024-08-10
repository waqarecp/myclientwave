<?php

namespace App\Models;

use App\Mail\InventorySetup;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Mail;

class InventorySetupConfig extends Model
{
    use HasFactory, SoftDeletes;

    protected static function boot()
    {
        parent::boot();

//        static::created(function ($model) {
//            $providerEmail = Provider::where('id', $model->provider_id)->value('email');
//            Mail::to($providerEmail)->send(new InventorySetup($model));
//        });
//
//        static::updated(function ($model) {
//            $providerEmail = Provider::where('id', $model->provider_id)->value('email');
//            Mail::to($providerEmail)->send(new InventorySetup($model));
//        });
    }

}
