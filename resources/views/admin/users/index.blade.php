@extends('layouts.app')

@section('title', 'Users')

@section('content')
    <div class="flex justify-between items-center mb-5">
        <h3 class="text-3xl font-medium text-gray-700">Users</h3>

        <div class="flex space-x-3 items-center mr-8">
            <!-- Showing -->
            <span class="text-gray-600 mr-2">Showing</span>
            <form method="GET" action="{{ route('users') }}" id="productsPerPageForm">
                <div class="relative">
                    <select name="per_page" onchange="document.getElementById('productsPerPageForm').submit();"
                        class="appearance-none bg-gray-300 text-black border-none rounded-md text-sm px-4 py-2 pr-8 focus:outline-none">
                        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                        <!-- Optionally, you can add an icon here for the select -->
                    </div>
                </div>
            </form>

            <!-- Filter -->
            <div>
                <button
                    class="bg-gray-100 flex items-center px-3 py-2 rounded-md text-gray-600 hover:bg-blue-500 hover:text-white transition-colors duration-200">
                    <i class="fa-solid fa-filter mr-2"></i>
                    Filter
                </button>
            </div>

            <!-- Export -->
            <div>
                <button
                    class="bg-gray-100 flex items-center px-3 py-2 rounded-md text-gray-600 hover:bg-blue-500 hover:text-white transition-colors duration-200">
                    <i class="fa-solid fa-file-export mr-2"></i>
                    Export
                </button>
            </div>
        </div>
    </div>


    <div class="w-full max-w-full  mb-6  mx-auto">
        <div class="relative flex-[1_auto] flex flex-col break-words min-w-0 bg-clip-border rounded-[.95rem] bg-white m-5">
            <div
                class="relative flex flex-col min-w-0 break-words border border-dashed bg-clip-border rounded-2xl border-stone-200 bg-light/30">
                <!-- card body  -->
                <div class="flex-auto block py-8 pt-6 px-9">
                    <div class="overflow-x-auto">
                        <table class="w-full my-0 align-middle text-dark border-neutral-200">
                            <thead class="align-bottom text-center">
                                <tr class="font-semibold text-[0.95rem] text-secondary-dark">
                                    <th class="pb-3 text-start min-w-[175px]">User Name</th>
                                    <th class="pb-3 text-center min-w-[175px]">User Email</th>
                                    <th class="pb-3 text-center min-w-[100px]">User ID</th>
                                    <th class="pb-3 text-center min-w-[100px]">Balance</th>
                                    <th class="pb-3 text-center min-w-[50px]">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                    <tr class="border-b border-dashed last:border-b-0">
                                        <td class="p-1.5 pl-0">
                                            <div class="flex items-center">
                                                <div class="relative inline-block shrink-0 rounded-2xl me-3">
                                                    <img class="w-[40px] h-[40px] inline-block shrink-0 rounded-2xl"
                                                        src="https://images.unsplash.com/photo-1528892952291-009c663ce843?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=296&q=80">
                                                </div>
                                                <div class="flex flex-col justify-start">
                                                    <span
                                                        class="mb-1 font-semibold transition-colors duration-200 ease-in-out text-sm text-secondary-inverse hover:text-primary">
                                                        {{ $user->name }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="p-2.5 pr-0 text-center">
                                            <span
                                                class="text-center align-baseline inline-flex px-2 py-1 mr-auto items-center font-semibold text-sm text-success bg-success-light rounded-lg">
                                                {{ $user->email }}
                                            </span>
                                        </td>
                                        <td class="p-1.5 pr-0 text-center">
                                            <span
                                                class="font-semibold text-light-inverse text-sm">{{ $user->id }}</span>

                                        </td>
                                        <td class="p-2.5 pr-0 text-center">
                                            <span
                                                class="text-center align-baseline inline-flex px-2 py-1 mr-auto items-center font-semibold text-sm text-success bg-success-light rounded-lg">
                                                @if ($user->credit)
                                                    ${{ number_format($user->credit->balance, 2) }}
                                                @else
                                                    No balance available
                                                @endif
                                            </span>
                                        </td>
                                        <td class="p-1.5 pr-0 text-center relative">
                                            
                                            <form action="{{ route('products.destroy', $user->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                                                    <i class="fa-solid fa-sack-dollar"></i>
                                                    Add Credit
                                                  </button>
                                            </form>
                                            
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center p-5">
                                            No products available.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>

                        </table>
                        <div class="mt-4">
                            {{ $users->appends(['per_page' => request('per_page')])->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
       
    </script>
@endsection
