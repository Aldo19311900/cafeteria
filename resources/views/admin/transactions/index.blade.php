@extends('layouts.app')

@section('title', 'Transactions')

@section('content')
<div class="flex justify-between items-center mb-5">
    <h3 class="text-3xl font-medium text-gray-700">Transactions</h3>

    <!-- Search and Pagination Controls -->
    <div class="flex space-x-3 items-center">
        <form method="GET" action="{{ route('transactions') }}" id="transactionsSearchForm" class="flex items-center">
            <div class="relative">
                <input type="text" name="search" placeholder="Search by user or amount"
                    class="appearance-none bg-gray-100 text-black border-none rounded-full text-sm px-4 py-2 pl-10 pr-10 focus:outline-none"
                    value="{{ request('search') }}">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </span>
            </div>
        </form>

        <form method="GET" action="{{ route('transactions') }}" id="transactionsPerPageForm">
            <div class="relative">
                <select name="per_page" onchange="document.getElementById('transactionsPerPageForm').submit();"
                    class="appearance-none bg-gray-100 text-black border-none rounded-full text-sm px-4 py-2 pr-8 focus:outline-none">
                    <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                </select>
            </div>
        </form>
    </div>
</div>

<!-- Tab Navigation -->
<div class="mb-5">
    <ul class="flex border-b">
        <li class="-mb-px mr-1">
            <a href="#" class="bg-white inline-block py-2 px-4 text-blue-500 font-semibold border-b-2 border-blue-500">All Transactions</a>
        </li>
        <li class="mr-1">
            <a href="#" class="bg-white inline-block py-2 px-4 text-gray-500 hover:text-blue-500">Incoming Transactions</a>
        </li>
        <li class="mr-1">
            <a href="#" class="bg-white inline-block py-2 px-4 text-gray-500 hover:text-blue-500">Outgoing Transactions</a>
        </li>
    </ul>
</div>

<!-- Transactions Table -->
<div class="bg-white rounded-lg overflow-hidden shadow-md">
    <table class="min-w-full text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-6 py-3 text-left font-semibold text-gray-600">User</th>
                <th class="px-6 py-3 text-left font-semibold text-gray-600">Details</th>
                <th class="px-6 py-3 text-left font-semibold text-gray-600">Date</th>
                <th class="px-6 py-3 text-left font-semibold text-gray-600">Amount</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $transaction)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-6 py-4 flex items-center">
                        <div class="w-8 h-8 rounded-full bg-gray-300 flex-shrink-0 overflow-hidden mr-3">
                            <img src="https://via.placeholder.com/40" alt="{{ $transaction->user ? $transaction->user->name : 'N/A' }}" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <div class="font-medium text-gray-700">
                                {{ $transaction->user ? $transaction->user->name : 'N/A' }}
                            </div>
                            <div class="text-gray-500 text-sm">
                                {{ $transaction->user ? $transaction->user->email : 'N/A' }}
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        @if ($transaction->type == 'addition')
                            <span class="text-green-500 font-medium">Added Credit</span>
                        @elseif ($transaction->type == 'deduction')
                            <span class="text-red-500 font-medium">Deducted for Purchase</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        {{ $transaction->created_at->format('d M Y, h:i:s A') }}
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-lg font-semibold {{ $transaction->type == 'addition' ? 'text-green-500' : 'text-red-500' }}">
                            {{ $transaction->type == 'addition' ? '+' : '-' }} ${{ number_format($transaction->amount, 2) }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center py-4 text-gray-500">No transactions available.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="p-4">
        {{ $transactions->appends(['per_page' => request('per_page'), 'search' => request('search')])->links() }}
    </div>
</div>
@endsection
