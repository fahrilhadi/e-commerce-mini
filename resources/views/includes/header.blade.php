<header class="w-full">
  <div class="max-w-2xl mx-auto px-4 py-4 flex justify-between items-center">
    <a href="{{ url('/') }}" class="text-xl font-semibold">E-Commerce Mini</a>
    <div class="flex items-center space-x-2">
      @if (Auth::check())
          {{-- Kalau sudah login --}}
          @if (request()->is('/'))
              @php
              $cartCount = auth()->check() 
                  ? \App\Models\CartItem::whereHas('cart', fn($q) => $q->where('user_id', auth()->id()))->sum('quantity')
                  : 0;
              @endphp

              <a href="{{ route('cart.index') }}" 
                class="relative px-4 py-2 bg-black text-white rounded-lg text-sm font-medium hover:bg-gray-800 transition shadow">
                  My Cart
                  @if($cartCount > 0)
                      <span id="cart-count"
                            class="absolute -top-2 -left-2 bg-red-500 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">
                          {{ $cartCount }}
                      </span>
                  @endif
              </a>
              {{-- Kalau user sedang di URL / --}}
              <a href="{{ route('dashboard') }}" 
                 class="px-4 py-2 bg-black text-white rounded-lg text-sm font-medium hover:bg-gray-800 transition shadow">
                 Dashboard
              </a>
          @else
              {{-- Tampilkan Add Post hanya jika role admin --}}
              @if(Auth::check() && Auth::user()->role === 'admin' && (request()->routeIs('admin.products.index')))
                <a href="{{ route('admin.products.create') }}" 
                class="px-4 py-2 bg-black text-white rounded-lg text-sm font-medium hover:bg-gray-800 transition shadow">
                + Product
                </a>
              @endif
              @if (request()->routeIs('admin.products.index'))
                <a href="{{ route('admin.dashboard') }}" 
                  class="px-4 py-2 bg-black text-white rounded-lg text-sm font-medium hover:bg-gray-800 transition shadow">
                  Back
                </a>
              @endif
              @if (request()->routeIs('admin.products.create','admin.products.edit','admin.products.show'))
                <a href="{{ route('admin.products.index') }}" 
                  class="px-4 py-2 bg-black text-white rounded-lg text-sm font-medium hover:bg-gray-800 transition shadow">
                  Back
                </a>
              @endif
              @if (request()->routeIs('products.show'))
                @php
                $cartCount = auth()->check() 
                    ? \App\Models\CartItem::whereHas('cart', fn($q) => $q->where('user_id', auth()->id()))->sum('quantity')
                    : 0;
                @endphp

                <a href="{{ route('cart.index') }}" 
                  class="relative px-4 py-2 bg-black text-white rounded-lg text-sm font-medium hover:bg-gray-800 transition shadow">
                    My Cart
                    @if($cartCount > 0)
                        <span id="cart-count"
                              class="absolute -top-2 -left-2 bg-red-500 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">
                            {{ $cartCount }}
                        </span>
                    @endif
                </a>
                <a href="{{ route('products.index') }}" 
                  class="px-4 py-2 bg-black text-white rounded-lg text-sm font-medium hover:bg-gray-800 transition shadow">
                  Back
                </a>
              @endif
              @if (request()->routeIs('admin.dashboard'))
                {{-- Logout --}}
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" 
                      class="px-4 py-2 bg-black text-white rounded-lg text-sm font-medium hover:bg-gray-800 transition shadow">
                      Logout
                  </button>
                </form>
              @endif
              @if (request()->routeIs('dashboard'))
                @php
                $cartCount = auth()->check() 
                    ? \App\Models\CartItem::whereHas('cart', fn($q) => $q->where('user_id', auth()->id()))->sum('quantity')
                    : 0;
                @endphp

                <a href="{{ route('cart.index') }}" 
                  class="relative px-4 py-2 bg-black text-white rounded-lg text-sm font-medium hover:bg-gray-800 transition shadow">
                    My Cart
                    @if($cartCount > 0)
                        <span id="cart-count"
                              class="absolute -top-2 -left-2 bg-red-500 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">
                            {{ $cartCount }}
                        </span>
                    @endif
                </a>
                {{-- Logout --}}
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" 
                      class="px-4 py-2 bg-black text-white rounded-lg text-sm font-medium hover:bg-gray-800 transition shadow">
                      Logout
                  </button>
                </form>
              @endif
              @if (request()->routeIs('cart.index'))
                <a href="{{ route('dashboard') }}" 
                    class="px-4 py-2 bg-black text-white rounded-lg text-sm font-medium hover:bg-gray-800 transition shadow">
                    Back
                </a>
              @endif
          @endif
      @else
          {{-- Guest --}}
          @if (request()->routeIs('login','register'))
              <a href="{{ url('/') }}" 
                  class="px-4 py-2 bg-black text-white rounded-lg text-sm font-medium hover:bg-gray-800 transition shadow">
                  Back
              </a>
          @else
              <a href="{{ route('login') }}" 
                  class="px-4 py-2 bg-black text-white rounded-lg text-sm font-medium hover:bg-gray-800 transition shadow">
                  Login
              </a>
              <a href="{{ route('register') }}" 
                  class="px-4 py-2 bg-black text-white rounded-lg text-sm font-medium hover:bg-gray-800 transition shadow">
                  Register
              </a>
          @endif
      @endif
    </div>
  </div>
</header>
