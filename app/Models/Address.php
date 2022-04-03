<?php

namespace App\Models;

use App\Observers\AddressObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($query) {
            $query->user_id = Auth::id();
        });
    }
}
