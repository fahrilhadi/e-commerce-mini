@extends('master')

@section('title')
    My Cart | E-Commerce Mini App
@endsection

@section('main-content')
    <div class="max-w-2xl w-full mx-auto px-4 py-10 space-y-5">
        {{-- My Products Table --}}
        <div class="p-6 bg-white border border-gray-200 rounded-xl shadow">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">My Cart</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse table-fixed">
                    <thead>
                        <tr class="bg-gray-50 text-sm text-gray-600">
                            <th class="py-3 px-4 border-b">Product</th>
                            <th class="py-3 px-4 border-b">Price</th>
                            <th class="py-3 px-4 border-b">Qty</th>
                            <th class="py-3 px-4 border-b w-32">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($cartItems as $item)
                            <tr class="text-sm text-gray-700 hover:bg-gray-50">
                                <td class="py-3 px-4 border-b">{{ $item->product->name }}</td>
                                <td class="py-3 px-4 border-b">${{ number_format($item->product->price, 2) }}</td>
                                <td class="py-3 px-4 border-b">
                                    {{-- Form update quantity --}}
                                    <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center">
                                        @csrf
                                        @method('PATCH')
                                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1"
                                            class="w-14 px-2 py-1 border rounded text-center outline-none focus:border-black focus:ring-0">
                                        <button type="submit" class="ml-2 px-2 py-1 rounded-lg border border-gray-300 hover:border-black text-sm transition shadow">
                                            Update
                                        </button>
                                    </form>
                                </td>
                                <td class="py-3 px-4 border-b">
                                    {{-- Form delete item --}}
                                    <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-2 py-1 rounded-lg border border-gray-300 hover:border-red-500 hover:text-red-500 text-sm transition shadow">
                                            Remove
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-6 text-center text-gray-500">
                                    Your cart is empty.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{-- Tampilkan total & checkout hanya jika cart tidak kosong --}}
                @if (!$cartItems->isEmpty())
                    <div class="flex justify-between items-center mt-4">
                        <span class="text-lg font-semibold text-gray-700">
                            Total: ${{ number_format($total, 2) }}
                        </span>
                        <a href="{{ route('checkout.index') }}" 
                           class="px-4 py-2 bg-black text-white rounded-lg text-sm font-medium hover:bg-gray-800 transition shadow">
                            Proceed to Checkout
                        </a>
                    </div>
                @endif
            </div>
            <x-pagination :paginator="$cartItems" />
        </div>
    </div>
@endsection