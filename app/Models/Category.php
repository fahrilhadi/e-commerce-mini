<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relasi: Category punya banyak produk
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
