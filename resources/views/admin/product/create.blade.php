@extends('master')

@section('title')
    Create Product | E-Commerce Mini App
@endsection

@section('main-content')
    <div class="max-w-2xl mx-auto px-4 py-8">

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5 border border-gray-200 rounded-xl shadow bg-white overflow-hidden p-6">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700">Product Name</label>
                <input type="text" name="name" value="{{ old('name') }}"
                    class="w-full mt-1 border border-gray-300 rounded-lg px-3 py-2 text-sm outline-none focus:border-black focus:ring-0">
                @error('name') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Category</label>
                <select name="category_id" class="w-full mt-1 border border-gray-300 rounded-lg px-3 py-2">
                    <option value="">-- Choose Category --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Price</label>
                    <input type="number" step="0.01" name="price" value="{{ old('price') }}"
                        class="w-full mt-1 border border-gray-300 rounded-lg px-3 py-2 text-sm outline-none focus:border-black focus:ring-0">
                    @error('price') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Stock</label>
                    <input type="number" name="stock" value="{{ old('stock') }}"
                        class="w-full mt-1 border border-gray-300 rounded-lg px-3 py-2 text-sm outline-none focus:border-black focus:ring-0">
                    @error('stock') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" rows="4"
                        class="w-full mt-1 border border-gray-300 rounded-lg px-3 py-2 text-sm outline-none focus:border-black focus:ring-0">{{ old('description') }}</textarea>
                @error('description') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Image</label>
                <input type="file" name="image" class="w-full mt-1 text-sm">
                @error('image') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-black text-white rounded-lg hover:bg-gray-800">
                    Save Product
                </button>
            </div>
        </form>
    </div>
@endsection