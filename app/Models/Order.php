<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relasi: Order milik 1 user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Order punya banyak item
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
