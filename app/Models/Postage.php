<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Postage extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_id',
        'cost',
    ];

    protected $keyType = 'string';
    protected $dateFormat = 'Y-m-d H:i:s.u';

    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->setAttribute($model->getKeyName(), Uuid::uuid4());
        });
    }
}
