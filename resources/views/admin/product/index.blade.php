@extends('master')

@section('title')
    E-Commerce Mini App
@endsection

@section('main-content')
    <div class="max-w-2xl w-full mx-auto px-4 py-6">
        @if ($products->isEmpty())
            <div class="p-8 border border-gray-200 rounded-xl shadow bg-white text-center">
                <h1 class="text-lg font-semibold text-gray-700 mb-2">
                    No products available yet
                </h1>
                <p class="text-sm text-gray-500">
                    Please come back later to see our catalog.
                </p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($products as $product)
                    <div class="border border-gray-200 rounded-xl shadow bg-white overflow-hidden">
                        <img src="{{ asset('storage/'.$product->image) }}" 
                             alt="{{ $product->name }}" 
                             class="w-full h-40 object-cover">

                        <div class="p-4">
                            <h2 class="text-lg font-semibold text-gray-900 mb-1">
                                {{ $product->name }}
                            </h2>
                            <p class="text-sm text-gray-500 mb-2">
                                Category: <span class="font-medium">{{ $product->category->name ?? 'Uncategorized' }}</span>
                            </p>

                            <p class="text-gray-700 font-bold mb-2">
                                ${{ number_format($product->price, 2) }}
                            </p>

                            <p class="text-sm mb-3">
                                Stock: <span class="font-medium">{{ $product->stock }}</span>
                            </p>

                            <a href="{{ route('products.show', $product->slug) }}" 
                               class="block w-full text-center px-3 py-2 text-sm border border-gray-300 rounded-lg hover:border-black hover:bg-gray-50 transition">
                                View Details →
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <x-pagination :paginator="$products" />
        @endif
    </div>
@endsection