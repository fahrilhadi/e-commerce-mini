@extends('master')

@section('title')
    Admin Dashboard | E-Commerce Mini App
@endsection

@section('main-content')
    <div class="max-w-2xl w-full mx-auto px-4 py-10 space-y-5">

        {{-- Greeting --}}
        <div class="text-center">
            <h1 class="text-xl font-bold text-gray-900">
                Welcome, {{ Auth::user()->name }}
            </h1>
            <p class="mt-1 text-sm text-gray-600">Here’s an overview of your store activity.</p>
        </div>

        {{-- Stat Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <div class="p-6 bg-white border border-gray-200 rounded-xl shadow">
                <h3 class="text-sm font-medium text-gray-500">Total Users</h3>
                <p class="mt-2 text-2xl font-bold text-gray-900">{{ $totalUsers }}</p>
            </div>
            <a href="{{ route('admin.products.index') }}" class="block">
                <div class="p-6 bg-white border border-gray-200 rounded-xl shadow hover:shadow-lg transition">
                    <h3 class="text-sm font-medium text-gray-500">Total Products</h3>
                    <p class="mt-2 text-2xl font-bold text-green-600">{{ $totalProducts }}</p>
                </div>
            </a>
            <div class="p-6 bg-white border border-gray-200 rounded-xl shadow">
                <h3 class="text-sm font-medium text-gray-500">Pending Orders</h3>
                <p class="mt-2 text-2xl font-bold text-yellow-600">{{ $pendingOrders }}</p>
            </div>
        </div>

        {{-- Recent Orders Table --}}
        <div class="p-6 bg-white border border-gray-200 rounded-xl shadow">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Recent Orders</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse table-fixed">
                    <thead>
                        <tr class="bg-gray-50 text-sm text-gray-600">
                            <th class="py-3 px-4 border-b">Order ID</th>
                            <th class="py-3 px-4 border-b">Customer</th>
                            <th class="py-3 px-4 border-b">Total</th>
                            <th class="py-3 px-4 border-b">Status</th>
                            <th class="py-3 px-4 border-b">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recentOrders as $order)
                            <tr class="text-sm text-gray-700 hover:bg-gray-50">
                                <td class="py-3 px-4 border-b">#{{ $order->id }}</td>
                                <td class="py-3 px-4 border-b">{{ $order->user->name ?? 'Guest' }}</td>
                                <td class="py-3 px-4 border-b">${{ number_format($order->total, 2) }}</td>
                                <td class="py-3 px-4 border-b">
                                    @if ($order->status === 'pending')
                                        <span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-700 rounded-lg">Pending</span>
                                    @elseif ($order->status === 'processing')
                                        <span class="px-2 py-1 text-xs bg-green-100 text-green-700 rounded-lg">Processing</span>
                                    @elseif ($order->status === 'completed')
                                        <span class="px-2 py-1 text-xs bg-green-100 text-green-700 rounded-lg">Completed</span>
                                    @else
                                        <span class="px-2 py-1 text-xs bg-green-100 text-green-700 rounded-lg">Cancelled</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 border-b">
                                    <div class="flex items-center space-x-2">

                                        {{-- Pending: View --}}
                                        @if($order->status === 'completed' || $order->status === 'processing' || $order->status === 'pending')
                                            <a href="" 
                                            class="px-2 py-1 rounded-lg border border-gray-300 hover:border-black text-sm transition shadow">
                                                View
                                            </a>
                                        @endif

                                        {{-- Cancelled: Delete --}}
                                        @if($order->status === 'cancelled')
                                            <form action="" method="POST">
                                                <button type="button" onclick="openDeleteModal({{ $order->id }}, '{{ addslashes($order->title) }}')"
                                                        class="px-2 py-1 rounded-lg border border-gray-300 hover:border-red-500 hover:text-red-500 text-sm transition shadow">
                                                    Delete
                                                </button>
                                            </form>
                                        @endif

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-6 text-center text-gray-500">
                                    No recent orders.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <x-pagination :paginator="$recentOrders" />
        </div>

    </div>
@endsection