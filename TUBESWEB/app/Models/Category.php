<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = "categories";
    protected $primaryKey = "id";

   
    protected $fillable = [
        'name',       // Kolom untuk nama kategori
        'slug_name',  // Kolom untuk slug
        'image',      // Kolom untuk gambar
    ];

    public function Pro()
    {
        return $this->hasMany(Property::class, 'category', 'id')->latest();
    }
}
