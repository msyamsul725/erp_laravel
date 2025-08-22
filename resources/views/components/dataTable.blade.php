<div class="bg-white shadow-xl rounded-2xl border border-gray-200 overflow-hidden">
    {{-- Header --}}
    <div class="bg-gradient-to-r from-blue-50 via-indigo-50 to-purple-50 px-6 py-6 border-b border-gray-200">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-4">
                @isset($icon)
                    <div
                        class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                        {{ $icon }}
                    </div>
                @endisset
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">{{ $title }}</h2>
                    <p class="text-sm text-gray-600 mt-1">{{ $subtitle ?? '' }}</p>
                </div>
            </div>
            <div>
                {{ $actions ?? '' }}
            </div>
        </div>

        {{-- Filter / Search Bar --}}
        <div
            class="mt-6 flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0 lg:space-x-6">
            <div class="flex-1">
                {{ $search ?? '' }}
            </div>
            <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4">
                {{ $filters ?? '' }}
            </div>
        </div>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="min-w-full">
            <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                {{ $thead }}
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                {{ $tbody }}
            </tbody>
        </table>
    </div>

    {{-- Footer --}}
    <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-blue-50 border-t border-gray-200 rounded-b-2xl">
        {{ $footer ?? '' }}
    </div>
</div>
