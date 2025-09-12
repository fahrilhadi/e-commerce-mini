@extends('master')

@section('title')
    Login | E-Commerce Mini App
@endsection

@section('main-content')
    <div class="w-full">
      <div class="max-w-md mx-auto px-4 py-12">
        <div class="border border-gray-200 rounded-xl shadow-lg p-6">
          <h2 class="text-lg font-semibold text-center mb-6">Login to Your Account</h2>

          <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf
            <div>
              <label class="block text-sm font-medium mb-1">Email</label>
              <input type="email" name="email" value="{{ old('email') }}" autocomplete="off"
                     class="@error('email') is-invalid @enderror w-full border border-gray-300 rounded-lg px-3 py-2 text-sm outline-none focus:border-black focus:ring-0">
            </div>
            <div>
              <label class="block text-sm font-medium mb-1">Password</label>
              <input type="password" name="password" 
                     class="@error('password') is-invalid @enderror w-full border border-gray-300 rounded-lg px-3 py-2 text-sm outline-none focus:border-black focus:ring-0">
            </div>
            <button type="submit"
                    class="w-full bg-black text-white rounded-lg py-2 text-sm font-medium hover:bg-gray-800 transition shadow">
              Login
            </button>
          </form>
        </div>
      </div>
    </div>
@endsection