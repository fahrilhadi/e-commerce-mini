@extends('master')

@section('title')
    Edit Product | E-Commerce Mini App
@endsection

@push('addon-styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('main-content')
    <div class="w-full max-w-2xl mx-auto px-4 py-8">
        <form action="{{ route('admin.products.update', $product->slug) }}" method="POST" enctype="multipart/form-data" class="space-y-5 border border-gray-200 rounded-xl shadow bg-white overflow-hidden p-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Product Name</label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}"
                        class="@error('name') is-invalid @enderror w-full mt-1 border border-gray-300 rounded-lg px-3 py-2 text-sm outline-none focus:border-black focus:ring-0">
                </div>

                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                    <select name="category_id" id="category" class="w-full category-select @error('category_id') is-invalid @enderror">
                        <option value="">-- Select or type category --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Price</label>
                    <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}"
                        class="@error('price') is-invalid @enderror w-full mt-1 border border-gray-300 rounded-lg px-3 py-2 text-sm outline-none focus:border-black focus:ring-0">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Stock</label>
                    <input type="number" name="stock" value="{{ old('stock', $product->stock) }}"
                        class="@error('stock') is-invalid @enderror w-full mt-1 border border-gray-300 rounded-lg px-3 py-2 text-sm outline-none focus:border-black focus:ring-0">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" rows="2"
                        class="w-full mt-1 border border-gray-300 rounded-lg px-3 py-2 text-sm outline-none focus:border-black focus:ring-0">{{ old('description', $product->description) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Image</label>
                <input type="file" name="image" 
                    class="w-full mt-1 border border-gray-300 rounded-lg px-3 py-2 text-sm outline-none focus:border-black focus:ring-0">
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-black text-white rounded-lg text-sm font-medium hover:bg-gray-800 transition shadow">
                    Update Product
                </button>
            </div>
        </form>
    </div>
@endsection

@push('addon-script')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#category').select2({
                tags: true,
                placeholder: "Select or type category",
                allowClear: true,
                createTag: function (params) {
                    return {
                        id: params.term,
                        text: params.term,
                        newTag: true
                    }
                }
            });
        });
    </script>
@endpush