<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get authenticated user
        $user = Auth::user();

        // ambil cart user (jangan kembalikan array kosong)
        $cart = Cart::where('user_id', $user->id)->first();

        if (!$cart) {
            // kalau cart belum ada → buat paginator kosong
            $cartItems = new LengthAwarePaginator(
                collect(), // data kosong
                0,         // total
                3,         // perPage
                1,         // current page
                ['path' => request()->url()]
            );

            $total = 0;
        } else {
            // ambil item beserta product (akan menghasilkan Collection)
            $cartItems = $cart->items()->with('product')->paginate(3);

            // hitung total dari collection
            $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);
        }

        return view('user.cart.index', compact('cartItems', 'total'));
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
    public function store(Request $request, Product $product)
    {
        // Get authenticated user
        $user = Auth::user();

        // Ambil atau buat cart user
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);

        // Cari item di cart
        $cartItem = $cart->items()->where('product_id', $product->id)->first();

        if ($cartItem) {
            // Hitung total jika ditambah 1
            $newQuantity = $cartItem->quantity + 1;

            if ($newQuantity > $product->stock) {
                return redirect()->back()->withErrors('Cannot add more than available stock');
            }

            $cartItem->update(['quantity' => $newQuantity]);
        } else {
            if ($product->stock < 1) {
                return redirect()->back()->withErrors('Product out of stock');
            }

            $cart->items()->create([
                'product_id' => $product->id,
                'quantity'   => 1,
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $itemId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // Get authenticated user
        $user = Auth::user();
        $cart = Cart::with('items')->where('user_id', $user->id)->first();
        if (!$cart) {
            return redirect()->back()->with('error', 'Cart not found');
        }

        $cartItem = $cart->items()->where('id', $itemId)->first();
        if (!$cartItem) {
            return redirect()->back()->with('error', 'Item not found in cart');
        }

        $quantity = $request->quantity;

        if ($quantity > $cartItem->product->stock) {
            return redirect()->back()->with('error', 'Quantity cannot exceed available stock (' . $cartItem->product->stock . ')');
        }

        $cartItem->update(['quantity' => $quantity]);

        return redirect()->back()->with('success', 'Cart updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($itemId)
    {
        // Get authenticated user
        $user = Auth::user();
        $cart = Cart::with('items')->where('user_id', $user->id)->first();

        if (!$cart) {
            return redirect()->back()->with('error', 'Cart not found');
        }

        $cartItem = $cart->items()->where('id', $itemId)->first();
        if (!$cartItem) {
            return redirect()->back()->with('error', 'Item not found in cart');
        }

        $cartItem->delete();

        return redirect()->back()->with('success', 'Item removed from cart');
    }
}
