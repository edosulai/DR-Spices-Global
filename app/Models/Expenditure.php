<?php

namespace App\Models;

use App\Casts\Json;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Expenditure extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_data',
        'spice_data',
        'jumlah',
    ];

    protected $casts = [
        'supplier_data' => Json::class,
        'spice_data' => Json::class,
    ];

    protected $keyType = 'string';

    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->setAttribute($model->getKeyName(), Uuid::uuid4());
        });
    }
}
