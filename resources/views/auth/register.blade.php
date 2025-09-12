@extends('master')

@section('title')
    Register | E-Commerce Mini App
@endsection

@section('main-content')
    <div class="w-full">
      <div class="max-w-md mx-auto px-4 py-12">
        <div class="border border-gray-200 rounded-xl shadow-lg p-6">
          <h2 class="text-lg font-semibold text-center mb-6">Create an Account</h2>

          <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf
            <div>
              <label class="block text-sm font-medium mb-1">Name</label>
              <input type="text" name="name" autocomplete="off" value="{{ old('name') }}" 
                     class="@error('name') is-invalid @enderror w-full border border-gray-300 rounded-lg px-3 py-2 text-sm outline-none focus:border-black focus:ring-0">
            </div>
            <div>
              <label class="block text-sm font-medium mb-1">Email</label>
              <input type="email" name="email" autocomplete="off" value="{{ old('email') }}"
                     class="@error('email') is-invalid @enderror w-full border border-gray-300 rounded-lg px-3 py-2 text-sm outline-none focus:border-black focus:ring-0">
            </div>
            <div>
              <label class="block text-sm font-medium mb-1">Password</label>
              <input type="password" name="password" value="{{ old('password') }}" 
                     class="@error('password') is-invalid @enderror w-full border border-gray-300 rounded-lg px-3 py-2 text-sm outline-none focus:border-black focus:ring-0">
            </div>
            <div>
              <label class="block text-sm font-medium mb-1">Confirm Password</label>
              <input type="password" name="password_confirmation" 
                     class="@error('password_confirmation') is-invalid @enderror w-full border border-gray-300 rounded-lg px-3 py-2 text-sm outline-none focus:border-black focus:ring-0">
            </div>
            <button type="submit" 
                    class="w-full bg-black text-white rounded-lg py-2 text-sm font-medium hover:bg-gray-800 transition shadow">
              Register
            </button>
          </form>
        </div>
      </div>
    </div>
@endsection