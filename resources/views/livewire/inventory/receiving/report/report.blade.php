<div class="bg-white shadow-xl rounded-2xl border border-gray-200 overflow-hidden">
    {{-- Header --}}
    <div class="bg-gradient-to-r from-blue-50 via-indigo-50 to-purple-50 px-6 py-6 border-b border-gray-200">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <div class="btn-icon">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 7h18M3 12h18M3 17h18" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">History Report</h2>
                    <p class="text-sm text-gray-600 mt-1">Track all stock movements & transactions</p>
                </div>
            </div>
            <div class="flex items-center space-x-3">
                {{-- Tombol Print --}}
                <button wire:click="printReport"
                    class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-xl hover:bg-green-700 shadow-sm transition-all duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 9V2h12v7M6 18H4a2 2 0 01-2-2V9h20v7a2 2 0 01-2 2h-2m-6 0v4m-6-4h12" />
                    </svg>
                    Print Report
                </button>
            </div>
        </div>

        {{-- Filter / Search --}}
        <div
            class="mt-6 flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0 lg:space-x-6">
            <div class="flex-1">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input wire:model.live="search" type="text"
                        placeholder="Search by part, location, user, description..."
                        class="block w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                </div>
            </div>
            <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4">
                <select wire:model.live="perPage"
                    class="px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white text-sm font-medium transition-all duration-200">
                    <option value="10">10 per page</option>
                    <option value="25">25 per page</option>
                    <option value="50">50 per page</option>
                </select>
            </div>
        </div>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="min-w-full">
            <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                <tr>
                    <th wire:click="sortBy('part_id')"
                        class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider cursor-pointer">
                        Part
                    </th>
                    <th wire:click="sortBy('location_id')"
                        class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider cursor-pointer">
                        Location
                    </th>
                    <th wire:click="sortBy('user_id')"
                        class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider cursor-pointer">
                        User
                    </th>
                    <th wire:click="sortBy('quantity')"
                        class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider cursor-pointer">
                        Qty
                    </th>
                    <th wire:click="sortBy('stock')"
                        class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider cursor-pointer">
                        Stock
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Description
                    </th>
                    <th wire:click="sortBy('created_at')"
                        class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider cursor-pointer">
                        Date
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @forelse($histories as $history)
                    <tr
                        class="hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 transition-all duration-300">
                        <td class="px-6 py-5">{{ $history->part->part_name ?? '-' }}</td>
                        <td class="px-6 py-5">{{ $history->location->head_name ?? '-' }}</td>
                        <td class="px-6 py-5">{{ $history->user->name ?? '-' }}</td>
                        <td class="px-6 py-5">{{ $history->quantity }}</td>
                        <td class="px-6 py-5">{{ $history->stock }}</td>
                        <td class="px-6 py-5">{{ $history->description }}</td>
                        <td class="px-6 py-5">
                            <div class="text-sm">
                                <div class="font-medium">{{ $history->created_at->format('M d, Y H:i') }}</div>
                                <div class="text-xs text-gray-500">{{ $history->created_at->diffForHumans() }}</div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div
                                    class="w-20 h-20 bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl flex items-center justify-center mb-6 shadow-inner">
                                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z">
                                        </path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">No history found</h3>
                                <p class="text-gray-500 mb-6 max-w-sm text-center">
                                    @if ($search)
                                        Try adjusting your search or filter criteria.
                                    @else
                                        No history records yet.
                                    @endif
                                </p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Footer --}}
    <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-blue-50 border-t border-gray-200 rounded-b-2xl">
        <div class="flex items-center justify-between">
            <div class="text-sm text-gray-600">
                Showing <span class="font-medium">{{ $histories->firstItem() ?? 0 }}</span> to
                <span class="font-medium">{{ $histories->lastItem() ?? 0 }}</span> of
                <span class="font-medium">{{ $histories->total() }}</span> records
            </div>
            <div class="flex-1 flex justify-center">
                {{ $histories->links() }}
            </div>
        </div>
    </div>
</div>
