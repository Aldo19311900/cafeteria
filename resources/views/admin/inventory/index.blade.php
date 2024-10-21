@extends('layouts.app')

@section('title', 'Inventory Adjustments')

@section('content')
<div class="flex justify-between items-center mb-5">
    <h3 class="text-3xl font-medium text-gray-700">Inventory Adjustments</h3>

    <!-- Search and Pagination Controls -->
    <div class="flex space-x-3 items-center mr-8">
        <!-- Search Form -->
        <form method="GET" action="{{ route('inventory.adjustments') }}" id="inventorySearchForm" class="flex items-center">
            <div class="relative mx-4 lg:mx-0">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </span>
                <input type="text" name="search" placeholder="Search by product or admin"
                    class="appearance-none bg-white text-black border-none rounded-2xl text-sm px-4 py-2 pl-10 pr-10 focus:outline-none"
                    value="{{ request('search') }}">
            </div>
        </form>

        <!-- Pagination Controls -->
        <form method="GET" action="{{ route('inventory.adjustments') }}" id="inventoryPerPageForm">
            <div class="relative">
                <select name="per_page" onchange="document.getElementById('inventoryPerPageForm').submit();"
                    class="appearance-none bg-gray-300 text-black border-none rounded-md text-sm px-4 py-2 pr-8 focus:outline-none">
                    <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                </select>
            </div>
        </form>
    </div>
</div>

    <!-- Table of Inventory Adjustments -->
<div class="w-full max-w-full mb-6 mx-auto">
    <div class="bg-white rounded-lg overflow-hidden shadow-lg">
        <!-- Table Header -->
        <table class="w-full text-left">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-sm font-medium text-gray-600">Product</th>
                    <th class="px-6 py-3 text-sm font-medium text-gray-600 text-center">Previous Stock</th>
                    <th class="px-6 py-3 text-sm font-medium text-gray-600 text-center">New Stock</th>
                    <th class="px-6 py-3 text-sm font-medium text-gray-600">Adjusted By</th>
                    <th class="px-6 py-3 text-sm font-medium text-gray-600">Date</th>
                </tr>
            </thead>

            <tbody>
                @forelse($adjustments as $adjustment)
                    <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }} border-b hover:bg-gray-100 transition">
                        <!-- Product Column -->
                        <td class="px-6 py-4 text-sm text-gray-800">
                            @if($adjustment->product)
                                <div class="flex items-center space-x-2">
                                    <div class="flex-shrink-0 w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center text-white font-bold text-xs">
                                        {{ strtoupper(substr($adjustment->product->name, 0, 1)) }}
                                    </div>
                                    <span>{{ $adjustment->product->name }}</span>
                                </div>
                            @else
                                <span class="text-red-500">N/A (Product ID: {{ $adjustment->product_id }})</span>
                            @endif
                        </td>

                        <!-- Previous Stock Column -->
                        <td class="px-6 py-4 text-center">
                            <span class="text-xs font-semibold text-gray-700 bg-yellow-100 px-2 py-1 rounded-full">
                                {{ $adjustment->previous_stock }}
                            </span>
                        </td>

                        <!-- New Stock Column -->
                        <td class="px-6 py-4 text-center">
                            <span class="text-xs font-semibold text-white {{ $adjustment->new_stock > $adjustment->previous_stock ? 'bg-green-500' : 'bg-red-500' }} px-2 py-1 rounded-full">
                                {{ $adjustment->new_stock }}
                            </span>
                        </td>

                        <!-- Adjusted By Column -->
                        <td class="px-6 py-4 text-sm text-gray-800">
                            {{ $adjustment->admin ? $adjustment->admin->name : 'N/A' }}
                        </td>

                        <!-- Date Column -->
                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $adjustment->created_at->format('d M Y, h:i:s A') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-6 text-gray-500">
                            No inventory adjustments available.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination Links -->
        <div class="bg-gray-100 px-6 py-4">
            {{ $adjustments->appends(['per_page' => request('per_page'), 'search' => request('search')])->links() }}
        </div>
    </div>
</div>

@endsection
