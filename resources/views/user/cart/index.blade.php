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
                            <th class="py-3 px-4 border-b">Subtotal</th>
                            <th class="py-3 px-4 border-b w-32">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($cartItems as $item)
                            <tr class="text-sm text-gray-700 hover:bg-gray-50">
                                <td class="py-3 px-4 border-b">{{ Str::limit($item->product->name, 7, '...') }}</td>
                                <td class="py-3 px-4 border-b">${{ number_format($item->product->price, 2) }}</td>
                                <td class="py-3 px-4 border-b">
                                    {{-- Form update quantity --}}
                                    <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center">
                                        @csrf
                                        @method('PATCH')
                                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1"
                                            class="w-16 px-2 py-1 border rounded text-center outline-none focus:border-black focus:ring-0">
                                        <button type="submit" class="ml-2 px-3 py-1 bg-gray-200 rounded hover:bg-gray-300">
                                            Update
                                        </button>
                                    </form>
                                </td>
                                <td class="py-3 px-4 border-b">${{ number_format($item->product->price * $item->quantity, 2) }}</td>
                                <td class="py-3 px-4 border-b">
                                    <div class="flex items-center space-x-2">
                                        {{-- Form delete item --}}
                                        <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                                                Remove
                                            </button>
                                        </form>
                                        {{-- <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST">
                                            <button type="button" onclick="openDeleteModal({{ $product->id }}, '{{ addslashes($product->name) }}')"
                                                    class="px-2 py-1 rounded-lg border border-gray-300 hover:border-red-500 hover:text-red-500 text-sm transition shadow">
                                                Delete
                                            </button>
                                        </form> --}}
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-6 text-center text-gray-500">
                                    Your cart is empty.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="flex justify-between items-center mt-4">
                    <span class="text-lg font-semibold text-gray-700">Total: ${{ number_format($total, 2) }}</span>
                    <a href="#" 
                    class="px-4 py-2 bg-black text-white rounded-lg hover:bg-gray-800 transition">
                        Proceed to Checkout
                    </a>
                </div>
            </div>
            {{-- <x-pagination :paginator="$cartItems" /> --}}
        </div>
    </div>

    {{-- <div id="deleteModal" class="fixed inset-0 backdrop-blur-sm z-[9999] hidden items-center justify-center">
      <div class="bg-white rounded-xl shadow-lg p-6 w-full max-w-sm text-center">
        <h2 class="text-lg font-semibold mb-2">Delete Product</h2>
        <p class="text-gray-600 text-sm mb-4">Are you sure you want to delete <span id="productTitle" class="font-medium"></span>?</p>
        <form id="deleteForm" method="POST" class="flex justify-center gap-3">
          @csrf
          @method('DELETE')
          <button type="button" onclick="closeDeleteModal()" 
                  class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium hover:border-black transition shadow">
            Cancel
          </button>
          <button type="submit" 
                  class="px-4 py-2 rounded-lg border border-gray-300 hover:border-red-500 hover:text-red-500 text-sm transition shadow">
            Delete
          </button>
        </form>
      </div>
    </div> --}}
@endsection

{{-- @push('addon-script')
  <script>
    function openDeleteModal(productId, productTitle) {
        const modal = document.getElementById('deleteModal');
        const form = document.getElementById('deleteForm');
        const titleSpan = document.getElementById('productTitle');

        form.action = '/admin/products/' + productId;
        titleSpan.textContent = productTitle;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeDeleteModal() {
        const modal = document.getElementById('deleteModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
  </script>
@endpush --}}