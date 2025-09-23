<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CartItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relasi: Cart Item milik 1 cart
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    // Relasi: Cart Item milik 1 produk
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // otomatis eager load relasi cart
    protected $with = ['cart'];
}
