<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        // Ambil cart user dengan relasi items + product
        $cart = Cart::with('items.product')
            ->where('user_id', $user->id)
            ->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty');
        }

        // Hitung total harga
        $total = $cart->items->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        return view('user.checkout.index', compact('cart', 'total'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->with('items.product')->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->back()->with('error', 'Cart is empty');
        }

        // 1. Buat order
        $order = Order::create([
            'user_id' => $user->id,
            'total_amount'   => $cart->items->sum(fn($i) => $i->product->price * $i->quantity),
            'status'  => 'pending',
        ]);

        // 2. Loop isi cart → masukkan ke order_items
        foreach ($cart->items as $item) {
            // kurangi stok
            if ($item->quantity > $item->product->stock) {
                return redirect()->back()->with('error', 'Stock not enough for ' . $item->product->name);
            }

            $item->product->decrement('stock', $item->quantity);

            $order->items()->create([
                'product_id' => $item->product_id,
                'quantity'   => $item->quantity,
                'price'      => $item->product->price,
            ]);
        }

        // 3. Kosongkan cart
        $cart->items()->delete();

        return redirect()->route('dashboard', $order->id)
            ->with('success', 'Order placed successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
