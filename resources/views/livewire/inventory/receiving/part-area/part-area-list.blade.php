<div class="bg-white shadow-xl rounded-2xl border border-gray-200 overflow-hidden">
    {{-- Header --}}
    <div
        class="bg-gradient-to-r from-blue-50 via-indigo-50 to-purple-50 px-6 py-5 border-b border-gray-200 flex justify-between items-center">
        <h2 class="text-xl font-bold text-gray-900">
            {{ $view === 'head' ? 'Part Area' : $headLocation->location_name }}
        </h2>

        @if ($view === 'layout')
            <button wire:click="backToList"
                class="px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-xl hover:bg-gray-200 transition">
                ← Back
            </button>
        @endif
    </div>

    {{-- Content --}}
    <div class="p-6">
        @if ($view === 'head')
            {{-- List Head Locations --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach ($headLocations as $head)
                    <div wire:click="openHeadLocation({{ $head->id }})"
                        class="cursor-pointer border rounded-xl p-5 hover:shadow-md hover:border-blue-300 transition group">
                        <h3 class="font-semibold text-gray-900 text-lg group-hover:text-blue-700">
                            {{ $head->location_name }}
                        </h3>
                        <p class="text-sm text-gray-600 mt-1">
                            Max Lantai: <span class="font-medium">{{ $head->max_lantai }}</span> |
                            Max Rak: <span class="font-medium">{{ $head->max_rak }}</span>
                        </p>
                        <p class="mt-3 text-xs text-gray-500">
                            Total lokasi: <span class="font-semibold">{{ $head->locations_count }}</span>
                        </p>
                    </div>
                @endforeach
            </div>
        @elseif($view === 'layout')
            {{-- Layout per Head Location --}}
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 mt-4">
                @foreach ($headLocation->locations as $loc)
                    <div wire:click="selectLocation({{ $loc->id }})"
                        class="cursor-pointer p-4 rounded-xl text-center border shadow-sm transition
                               {{ $loc->quantity > 0
                                   ? 'bg-green-50 border-green-300 hover:bg-green-100'
                                   : 'bg-gray-50 border-gray-300 hover:bg-gray-100' }}">
                        <div class="text-sm font-semibold text-gray-800">
                            {{ $loc->head_name }}
                        </div>
                        <div class="mt-1 text-xs {{ $loc->quantity > 0 ? 'text-green-700' : 'text-gray-500' }}">
                            {{ $loc->quantity > 0 ? $loc->quantity . ' Filled' : 'Empty' }}
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Footer --}}
            <div
                class="px-4 py-3 mt-6 bg-gradient-to-r from-gray-50 to-blue-50 border rounded-xl text-sm text-gray-600 flex justify-between">
                <span>Total Locations: {{ $headLocation->locations->count() }}</span>
                <span>
                    Filled: {{ $headLocation->locations->where('quantity', '>', 0)->count() }} |
                    Empty: {{ $headLocation->locations->where('quantity', 0)->count() }}
                </span>
            </div>
        @endif
    </div>
</div>
