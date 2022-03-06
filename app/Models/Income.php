<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    protected $fillable = [
        'faktur',
        'user_id',
        'spice_id',
        'jumlah',
        'ket'
    ];
}
