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
        'maggot_data',
        'jumlah',
    ];

    protected $casts = [
        'supplier_data' => Json::class,
        'maggot_data' => Json::class,
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
