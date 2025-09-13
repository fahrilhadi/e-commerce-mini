<header class="w-full">
  <div class="max-w-2xl mx-auto px-4 py-4 flex justify-between items-center">
    <a href="{{ url('/') }}" class="text-xl font-semibold">E-Commerce Mini</a>
    <div class="flex items-center space-x-2">
      @if (Auth::check())
          {{-- Kalau sudah login --}}
          @if (request()->is('/'))
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
                + Add Product
                </a>
              @endif
              @if (request()->routeIs('admin.products.create','admin.products.edit','admin.products.show'))
                <a href="{{ route('admin.products.index') }}" 
                  class="px-4 py-2 bg-black text-white rounded-lg text-sm font-medium hover:bg-gray-800 transition shadow">
                  Back
                </a>
              @endif
              {{-- Logout --}}
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" 
                    class="px-4 py-2 bg-black text-white rounded-lg text-sm font-medium hover:bg-gray-800 transition shadow">
                    Logout
                </button>
              </form>
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