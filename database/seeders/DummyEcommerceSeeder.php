<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\OrderItem;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DummyEcommerceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create User
        $user = User::create([
            'name'     => 'John Doe',
            'email'    => 'johndoe@example.com',
            'password' => Hash::make('password'),
            'role'     => 'user',
        ]);

        // 2. Create Category
        $category = Category::create([
            'name'        => 'Electronics',
            'slug'        => Str::slug('Electronics'),
            'description' => 'Gadgets and devices',
        ]);

        // 3. Create Product
        $product = Product::create([
            'category_id' => $category->id,
            'name'        => 'Wireless Headphones',
            'slug'        => Str::slug('Wireless Headphones'),
            'description' => 'High quality wireless headphones with noise cancelling feature.',
            'price'       => 120.00,
            'stock'       => 10,
            'image'       => 'headphones.jpg',
            'status'      => 'active',
        ]);

        // 4. Create Cart for User
        $cart = Cart::create([
            'user_id' => $user->id,
        ]);

        // 5. Add Cart Item
        CartItem::create([
            'cart_id'    => $cart->id,
            'product_id' => $product->id,
            'quantity'   => 1,
        ]);

        // 6. Create Order for User
        $order = Order::create([
            'user_id'      => $user->id,
            'total_amount' => $product->price,
            'status'       => 'pending',
        ]);

        // 7. Add Order Item
        OrderItem::create([
            'order_id'   => $order->id,
            'product_id' => $product->id,
            'quantity'   => 1,
            'price'      => $product->price,
        ]);
    }
}
