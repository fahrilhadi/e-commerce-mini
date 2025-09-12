<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relasi: Cart milik 1 user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Cart punya banyak item
    public function items()
    {
        return $this->hasMany(CartItem::class);
    }
}
