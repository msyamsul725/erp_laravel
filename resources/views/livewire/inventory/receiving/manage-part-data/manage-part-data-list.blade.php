<div class="bg-white shadow-xl rounded-2xl border border-gray-200 overflow-hidden">
    <div class="bg-gradient-to-r from-blue-50 via-indigo-50 to-purple-50 px-6 py-6 border-b border-gray-200">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <div class="btn-icon">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <!-- Icon: Chip/Box -->
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 7h16M4 17h16M7 4v16m10-16v16" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Parts Management</h2>
                    <p class="text-sm text-gray-600 mt-1">Manage inventory parts and stock levels</p>
                </div>
            </div>

            @permission('users.create')
                <button wire:click="$dispatch('openPartForm')" class="btn-primary">
                    <svg class="w-5 h-5 mr-2 transition-transform duration-300 group-hover:rotate-90" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Add Part
                </button>
            @endpermission
        </div>

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
                    <input wire:model.live="search" type="text" placeholder="Search part by number, name..."
                        class="block w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                </div>
            </div>
            <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4">
                <label
                    class="flex items-center px-4 py-3 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 transition-colors duration-200">
                    <input wire:model.live="showInactive" type="checkbox"
                        class="rounded border-gray-300 text-blue-600 focus:ring-blue-500 focus:ring-offset-0">
                    <span class="ml-3 text-sm font-medium text-gray-700">Show Inactive</span>
                </label>
                <select wire:model.live="perPage"
                    class="px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white text-sm font-medium transition-all duration-200">
                    <option value="10">10 per page</option>
                    <option value="25">25 per page</option>
                    <option value="50">50 per page</option>
                </select>
            </div>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full">
            <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                <tr>
                    {{-- Part Number --}}
                    <th wire:click="sortBy('part_number')"
                        class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider cursor-pointer hover:bg-gray-200 transition-colors duration-200 rounded-tl-xl">
                        <div class="flex items-center space-x-2">
                            <span>Part Number</span>
                            @if ($sortField === 'part_number')
                                <div class="w-4 h-4 bg-blue-100 rounded flex items-center justify-center">
                                    <svg class="w-3 h-3 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        @if ($sortDirection === 'asc')
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 15l7-7 7 7"></path>
                                        @else
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7"></path>
                                        @endif
                                    </svg>
                                </div>
                            @endif
                        </div>
                    </th>

                    {{-- Part Name --}}
                    <th wire:click="sortBy('part_name')"
                        class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider cursor-pointer hover:bg-gray-200 transition-colors duration-200">
                        <div class="flex items-center space-x-2">
                            <span>Part Name</span>
                            @if ($sortField === 'part_name')
                                <div class="w-4 h-4 bg-blue-100 rounded flex items-center justify-center">
                                    <svg class="w-3 h-3 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        @if ($sortDirection === 'asc')
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 15l7-7 7 7"></path>
                                        @else
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7"></path>
                                        @endif
                                    </svg>
                                </div>
                            @endif
                        </div>
                    </th>

                    {{-- Stock --}}
                    <th wire:click="sortBy('stock')"
                        class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider cursor-pointer hover:bg-gray-200 transition-colors duration-200">
                        <div class="flex items-center space-x-2">
                            <span>Stock</span>
                            @if ($sortField === 'stock')
                                <div class="w-4 h-4 bg-blue-100 rounded flex items-center justify-center">
                                    <svg class="w-3 h-3 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        @if ($sortDirection === 'asc')
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 15l7-7 7 7"></path>
                                        @else
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7"></path>
                                        @endif
                                    </svg>
                                </div>
                            @endif
                        </div>
                    </th>

                    {{-- Minimum --}}
                    <th wire:click="sortBy('minimum')"
                        class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider cursor-pointer hover:bg-gray-200 transition-colors duration-200">
                        <div class="flex items-center space-x-2">
                            <span>Minimum</span>
                            @if ($sortField === 'minimum')
                                <div class="w-4 h-4 bg-blue-100 rounded flex items-center justify-center">
                                    <svg class="w-3 h-3 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        @if ($sortDirection === 'asc')
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 15l7-7 7 7"></path>
                                        @else
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7"></path>
                                        @endif
                                    </svg>
                                </div>
                            @endif
                        </div>
                    </th>

                    {{-- Created At --}}
                    <th wire:click="sortBy('created_at')"
                        class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider cursor-pointer hover:bg-gray-200 transition-colors duration-200">
                        <div class="flex items-center space-x-2">
                            <span>Created</span>
                            @if ($sortField === 'created_at')
                                <div class="w-4 h-4 bg-blue-100 rounded flex items-center justify-center">
                                    <svg class="w-3 h-3 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        @if ($sortDirection === 'asc')
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 15l7-7 7 7"></path>
                                        @else
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7"></path>
                                        @endif
                                    </svg>
                                </div>
                            @endif
                        </div>
                    </th>

                    {{-- Actions --}}
                    <th
                        class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider rounded-tr-xl">
                        Actions
                    </th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-100">
                @forelse($parts as $part)
                    <tr
                        class="hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 transition-all duration-300 group">
                        <td class="px-6 py-5 whitespace-nowrap text-sm font-semibold text-gray-900">
                            {{ $part->part_number }}
                        </td>
                        <td class="px-6 py-5 whitespace-nowrap text-sm text-gray-700">
                            {{ $part->part_name }}
                        </td>
                        <td class="px-6 py-5 whitespace-nowrap text-sm text-gray-700">
                            {{ $part->stock }}
                        </td>
                        <td class="px-6 py-5 whitespace-nowrap text-sm text-gray-700">
                            {{ $part->minimum }}
                        </td>
                        <td class="px-6 py-5 whitespace-nowrap">
                            <span
                                class="inline-flex items-center px-3 py-1.5 rounded-xl text-xs font-semibold shadow-sm 
                                {{ $part->is_active
                                    ? 'bg-gradient-to-r from-green-100 to-emerald-100 text-green-800'
                                    : 'bg-gradient-to-r from-red-100 to-pink-100 text-red-800' }}">
                                <div
                                    class="w-2 h-2 rounded-full mr-2 {{ $part->is_active ? 'bg-green-500 animate-pulse' : 'bg-red-500' }}">
                                </div>
                                {{ $part->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-6 py-5 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                @permission('users.edit')
                                    <button wire:click="$dispatch('openPartForm', { partId: {{ $part->id }} })"
                                        class="group/btn inline-flex items-center px-3 py-2 text-xs font-semibold text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100 hover:text-blue-700 transition-all duration-200 transform hover:scale-105">
                                        <svg class="w-4 h-4 mr-1.5 group-hover/btn:rotate-12 transition-transform duration-200"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                        Edit
                                    </button>
                                @endpermission
                                @permission('users.edit')
                                    <button wire:click="togglePartStatus({{ $part->id }})"
                                        class="group/btn inline-flex items-center px-3 py-2 text-xs font-semibold text-yellow-600 bg-yellow-50 rounded-lg hover:bg-yellow-100 hover:text-yellow-700 transition-all duration-200 transform hover:scale-105">
                                        <svg class="w-4 h-4 mr-1.5 group-hover/btn:rotate-180 transition-transform duration-300"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            @if ($part->is_active)
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728">
                                                </path>
                                            @else
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            @endif
                                        </svg>
                                        {{ $part->is_active ? 'Deactivate' : 'Activate' }}
                                    </button>
                                @endpermission
                                @permission('users.delete')
                                    <button wire:click="confirmDeletePart({{ $part->id }})"
                                        class="group/btn inline-flex items-center px-3 py-2 text-xs font-semibold text-red-600 bg-red-50 rounded-lg hover:bg-red-100 hover:text-red-700 transition-all duration-200 transform hover:scale-105">
                                        <svg class="w-4 h-4 mr-1.5 group-hover/btn:animate-bounce" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                        Delete
                                    </button>
                                @endpermission
                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div
                                    class="w-20 h-20 bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl flex items-center justify-center mb-6 shadow-inner">
                                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <!-- Icon box untuk part -->
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M4 7h16M4 17h16M7 4v16m10-16v16" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">No parts found</h3>
                                <p class="text-gray-500 mb-6 max-w-sm text-center">
                                    @if ($search || !$showInactive)
                                        Try adjusting your search or filter criteria to find what you're looking for.
                                    @else
                                        Get started by creating your first part to manage your inventory.
                                    @endif
                                </p>

                                @if (!$search)
                                    @permission('users.create')
                                        <button wire:click="$dispatch('openPartForm')" class="btn-primary">
                                            Create First Part
                                        </button>
                                    @endpermission
                                @else
                                    <button wire:click="$set('search', ''); $set('showInactive', false);"
                                        class="btn-secondary">
                                        Clear Filters
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-blue-50 border-t border-gray-200 rounded-b-2xl">
        <div class="flex items-center justify-between">
            <div class="text-sm text-gray-600">
                Showing <span class="font-medium">{{ $parts->firstItem() ?? 0 }}</span> to <span
                    class="font-medium">{{ $parts->lastItem() ?? 0 }}</span> of <span
                    class="font-medium">{{ $parts->total() }}</span> parts
            </div>
            <div class="flex-1 flex justify-center">
                {{ $parts->links() }}
            </div>
        </div>
    </div>
</div>
