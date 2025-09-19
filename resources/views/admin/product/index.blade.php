@extends('master')

@section('title')
    My Products | E-Commerce Mini App
@endsection

@section('main-content')
    <div class="max-w-2xl w-full mx-auto px-4 py-10 space-y-5">
        {{-- My Products Table --}}
        <div class="p-6 bg-white border border-gray-200 rounded-xl shadow">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">My Products</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse table-fixed">
                    <thead>
                        <tr class="bg-gray-50 text-sm text-gray-600">
                            <th class="py-3 px-4 border-b">Name</th>
                            <th class="py-3 px-4 border-b">Category</th>
                            <th class="py-3 px-4 border-b">Price</th>
                            <th class="py-3 px-4 border-b">Stock</th>
                            <th class="py-3 px-4 border-b w-32">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr class="text-sm text-gray-700 hover:bg-gray-50">
                                <td class="py-3 px-4 border-b">{{ Str::limit($product->name, 7, '...') }}</td>
                                <td class="py-3 px-4 border-b">{{ $product->category->name ?? 'Uncategorized' }}</td>
                                <td class="py-3 px-4 border-b">${{ number_format($product->price, 2) }}</td>
                                <td class="py-3 px-4 border-b">{{ $product->stock }}</td>
                                <td class="py-3 px-4 border-b">
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ route('admin.products.edit', $product->id) }}" 
                                           class="px-2 py-1 rounded-lg border border-gray-300 hover:border-black text-sm transition shadow">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="px-2 py-1 rounded-lg border border-gray-300 hover:border-red-500 hover:text-red-500 text-sm transition shadow">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-6 text-center text-gray-500">
                                    No products found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <x-pagination :paginator="$products" />
        </div>
    </div>
@endsection