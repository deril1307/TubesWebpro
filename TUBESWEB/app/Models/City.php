<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $table = "cities";
    protected $primaryKey = "id";

    // Atribut yang dapat diisi secara massal
    protected $fillable = [
        'city',       // Kolom untuk nama kota
        'slug_city',  // Kolom untuk slug kota
        'status',     // Kolom status (1 = aktif, 0 = nonaktif)
    ];
}
