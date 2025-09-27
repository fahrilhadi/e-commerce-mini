@extends('master')

@section('title')
    Checkout | E-Commerce Mini App
@endsection

@section('main-content')
    <div class="w-full max-w-2xl mx-auto px-4 py-8">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Kiri: daftar produk -->
            <div class="lg:col-span-2 bg-white border rounded-lg shadow p-6">

                <div class="space-y-4">
                    @foreach ($cart->items as $item)
                        <div class="flex items-center justify-between border-b pb-4">
                            <div class="flex items-center gap-4">
                                <!-- Thumbnail produk -->
                                <img src="{{ $item->product->image 
                                        ? asset('storage/' . $item->product->image) 
                                        : 'https://via.placeholder.com/80' }}" 
                                alt="{{ $item->product->name }}" 
                                class="w-20 h-20 object-cover rounded-lg border">

                                <!-- Detail -->
                                <div>
                                    <p class="font-medium text-gray-700">{{ $item->product->name }}</p>
                                    <p class="text-sm text-gray-500">Qty: {{ $item->quantity }}</p>
                                    <p class="text-sm text-gray-600">
                                        ${{ number_format($item->product->price, 0, ',', '.') }} / item
                                    </p>
                                </div>
                            </div>

                            <!-- Subtotal -->
                            <p class="font-semibold text-gray-700">
                                ${{ number_format($item->quantity * $item->product->price, 0, ',', '.') }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Kanan: ringkasan -->
            <div class="bg-white border rounded-lg shadow p-6 h-fit">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Order Summary</h2>

                <div class="flex justify-between mb-2 text-sm text-gray-600">
                    <span>Subtotal</span>
                    <span>${{ number_format($total, 0, ',', '.') }}</span>
                </div>

                <div class="flex justify-between mb-2 text-sm text-gray-600">
                    <span>Shipping</span>
                    <span>$0</span>
                </div>

                <hr class="my-3">

                <div class="flex justify-between text-lg font-bold text-gray-700">
                    <span>Total</span>
                    <span>${{ number_format($total, 0, ',', '.') }}</span>
                </div>

                <form action="{{ route('checkout.store') }}" method="POST" class="mt-6">
                    @csrf
                    <button type="submit" 
                        class="w-full px-4 py-2 bg-black text-white rounded-lg text-sm font-medium hover:bg-gray-800 transition shadow">
                        Place Order
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection