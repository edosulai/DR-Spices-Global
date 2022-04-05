<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Trace extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_buy_id',
        'status_id',
    ];

    // protected $keyType = 'string';

    // public $incrementing = false;

    // protected static function boot()
    // {
    //     parent::boot();
    //     static::creating(function ($model) {
    //         $model->setAttribute($model->getKeyName(), Uuid::uuid4());
    //     });
    // }
}
