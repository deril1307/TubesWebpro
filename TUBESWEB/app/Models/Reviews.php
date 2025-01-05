<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    use HasFactory;

    protected $table = 'reviews';
    protected $primaryKey = 'id';

    // Atribut yang dapat diisi secara massal
    protected $fillable = [
        'u_id',    // Kolom untuk ID pengguna
        'pro_id',  // Kolom untuk ID properti
        'review',  // Kolom untuk teks ulasan
    ];

    public function Users()
    {
        return $this->hasMany(User::class, 'id', 'u_id')->with('Data');
    }

    public function Property()
    {
        return $this->hasOne(Property::class, 'id', 'pro_id')->select('id', 'title', 'title_slug');
    }
}
