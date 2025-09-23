@extends('master')

@section('title')
    {{ $product->name }} | E-Commerce Mini App
@endsection

@section('main-content')
    <div class="w-full">
        <div class="max-w-2xl mx-auto px-4 py-8">
            <div class="bg-white border border-gray-200 rounded-xl shadow p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                
                {{-- Product Image --}}
                <div>
                    <img src="{{ asset('storage/'.$product->image) }}" 
                        alt="{{ $product->name }}" 
                        class="w-full  object-cover rounded-lg">
                </div>

                {{-- Product Info --}}
                <div>
                    <h1 class="text-xl font-bold text-gray-900 mb-2">
                        {{ $product->name }}
                    </h1>
                    
                    <p class="text-sm text-gray-700 mb-4">
                        Category: <span class="font-medium">{{ $product->category->name ?? 'Uncategorized' }}</span>
                    </p>

                    <p class="text-xl font-semibold text-black mb-4">
                        ${{ number_format($product->price, 2) }}
                    </p>

                    <p class="text-sm text-gray-700 mb-2">
                        Stock: <span class="font-medium"></span>{{ $product->stock }}
                    </p>

                    <p class="text-gray-700 text-sm mb-6">
                        {{ $product->description }}
                    </p>

                    {{-- CTA --}}
                    @guest
                        <div class="flex space-x-2">
                            <a href="{{ route('login') }}" 
                            class="px-4 py-2 text-sm border border-gray-300 rounded-lg hover:border-black hover:bg-gray-50 transition">
                            Add to Cart
                            </a>
                            <a href="{{ route('products.index') }}" 
                            class="px-4 py-2 text-sm border border-gray-300 rounded-lg hover:border-black hover:bg-gray-50 transition">
                            Back to List
                            </a>
                        </div>
                    @endguest

                    @auth
                        <form action="{{ route('cart.store', $product->id) }}" method="POST" class="flex space-x-2">
                            @csrf
                            <button type="submit" 
                                    class="add-to-cart-btn px-4 py-2 bg-black text-white text-sm rounded-lg hover:bg-gray-800 transition">
                                Add to Cart
                            </button>
                            <a href="{{ route('products.index') }}" 
                            class="px-4 py-2 text-sm border border-gray-300 rounded-lg hover:border-black hover:bg-gray-50 transition">
                            Back to List
                            </a>
                        </form>
                    @endauth
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
  document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
      btn.addEventListener('click', function(e) {
          e.preventDefault();
          fetch(this.href, {
              method: 'POST',
              headers: {
                  'X-CSRF-TOKEN': '{{ csrf_token() }}',
                  'Accept': 'application/json'
              }
          })
          .then(res => res.json())
          .then(data => {
              if (data.success) {
                  document.getElementById('cart-count').innerText = data.cart_count;
              }
          });
      });
  });
</script>