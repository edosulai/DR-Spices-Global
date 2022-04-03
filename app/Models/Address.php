<?php

namespace App\Models;

use App\Observers\AddressObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'recipent',
        'street',
        'other_street',
        'district',
        'city',
        'state',
        'zip',
        'country',
        'phone'
    ];

    protected $keyType = 'string';

    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->setAttribute($model->getKeyName(), Uuid::uuid4());
            if (Auth::check()) {
                $model->user_id = Auth::id();
            }
        });
    }
}
