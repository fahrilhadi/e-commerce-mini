<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relasi: Produk milik 1 kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi ke User (pemilik / admin yang input produk)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Produk bisa ada di banyak order item
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Relasi: Produk bisa ada di banyak cart item
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
