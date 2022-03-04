<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spice extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'hrg_jual',
        'stok',
        'ket'
    ];
}
