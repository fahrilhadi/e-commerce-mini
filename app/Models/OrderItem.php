<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relasi: Item milik 1 order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Relasi: Item milik 1 produk
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
