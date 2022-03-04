<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestBuy extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'spice_id',
        'status_id',
        'jumlah'
    ];
}
