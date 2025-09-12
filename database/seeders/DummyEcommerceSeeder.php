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
            'name'     => 'John',
            'email'    => 'john@example.com',
            'password' => Hash::make('password'),
            'role'     => 'user',
        ]);

        // 2. Tambah Category lain
        $categories = [
            ['name' => 'Fashion', 'description' => 'Clothing and accessories'],
            ['name' => 'Books', 'description' => 'Fiction, non-fiction, and study materials'],
            ['name' => 'Home Appliances', 'description' => 'Household electronics'],
            ['name' => 'Sports', 'description' => 'Sporting goods and equipment'],
            ['name' => 'Toys', 'description' => 'Kids toys and games'],
            ['name' => 'Beauty', 'description' => 'Cosmetics and skincare'],
        ];

        foreach ($categories as $cat) {
            Category::create([
                'name'        => $cat['name'],
                'slug'        => Str::slug($cat['name']),
                'description' => $cat['description'],
            ]);
        }

        // 3. Tambah Produk Dummy
        $products = [
            ['category' => 'Fashion', 'name' => 'Casual T-Shirt', 'desc' => 'Comfortable cotton t-shirt', 'price' => 25.00, 'stock' => 50, 'image' => 'tshirt.jpg'],
            ['category' => 'Books', 'name' => 'Laravel', 'desc' => 'Step by step Laravel guide', 'price' => 40.00, 'stock' => 20, 'image' => 'laravel-book.jpg'],
            ['category' => 'Home Appliances', 'name' => 'Blender', 'desc' => 'Powerful kitchen blender', 'price' => 65.00, 'stock' => 15, 'image' => 'blender.jpg'],
            ['category' => 'Sports', 'name' => 'Football', 'desc' => 'Professional size 5 football', 'price' => 30.00, 'stock' => 25, 'image' => 'football.jpg'],
            ['category' => 'Toys', 'name' => 'Lego Classic Set', 'desc' => 'Creative Lego building blocks', 'price' => 55.00, 'stock' => 12, 'image' => 'lego.jpg'],
            ['category' => 'Beauty', 'name' => 'Moisturizer Cream', 'desc' => 'Hydrating skincare cream', 'price' => 35.00, 'stock' => 30, 'image' => 'cream.jpg'],
        ];

        foreach ($products as $p) {
            $category = Category::where('name', $p['category'])->first();

            $product = Product::create([
                'category_id' => $category->id,
                'name'        => $p['name'],
                'slug'        => Str::slug($p['name']),
                'description' => $p['desc'],
                'price'       => $p['price'],
                'stock'       => $p['stock'],
                'image'       => $p['image'],
                'status'      => 'active',
            ]);

            // Tambah ke cart John Doe
            $cart = Cart::firstOrCreate(['user_id' => $user->id]);

            CartItem::create([
                'cart_id'    => $cart->id,
                'product_id' => $product->id,
                'quantity'   => 1,
            ]);

            // Tambah ke order dummy John Doe
            $order = Order::firstOrCreate(
                ['user_id' => $user->id, 'status' => 'pending'],
                ['total_amount' => 0]
            );

            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $product->id,
                'quantity'   => 1,
                'price'      => $product->price,
            ]);

            // Update total order
            $order->increment('total_amount', $product->price);
        }
    }
}
