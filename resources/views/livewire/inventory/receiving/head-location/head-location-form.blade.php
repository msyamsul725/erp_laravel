<div>
    <!-- Notifikasi Toast -->
    @if (session()->has('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
            x-transition:enter="transform ease-out duration-300 transition"
            x-transition:enter-start="translate-x-10 opacity-0" x-transition:enter-end="translate-x-0 opacity-100"
            x-transition:leave="transform ease-in duration-300 transition"
            x-transition:leave-start="translate-x-0 opacity-100" x-transition:leave-end="translate-x-10 opacity-0"
            class="fixed top-5 right-5 bg-green-600 text-white px-6 py-3 rounded-xl shadow-lg flex items-center space-x-3"
            style="display: none;">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if (session()->has('error'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
            x-transition:enter="transform ease-out duration-300 transition"
            x-transition:enter-start="translate-x-10 opacity-0" x-transition:enter-end="translate-x-0 opacity-100"
            x-transition:leave="transform ease-in duration-300 transition"
            x-transition:leave-start="translate-x-0 opacity-100" x-transition:leave-end="translate-x-10 opacity-0"
            class="fixed top-5 right-5 bg-red-600 text-white px-6 py-3 rounded-xl shadow-lg flex items-center space-x-3"
            style="display: none;">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
            <span>{{ session('error') }}</span>
        </div>
    @endif
    @if ($showModal)
        <!-- Overlay -->
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 flex items-start justify-center py-12"
            wire:click="closeModal">

            <!-- Modal Card -->
            <div class="relative w-full max-w-3xl bg-white rounded-xl shadow-2xl p-8 animate-fadeInUp" wire:click.stop>

                <!-- Header -->
                <div class="flex justify-between items-center mb-6 border-b pb-3">
                    <h3 class="text-xl font-semibold text-gray-800">
                        {{ $isEdit ? '✏️ Edit Head Location' : '➕ Create Head Location' }}
                    </h3>
                    <button wire:click="closeModal" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Form -->
                <form wire:submit.prevent="save" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Location Name -->
                        <div>
                            <label for="location_name" class="block text-sm font-medium text-gray-700 mb-2">
                                📍 Location Name
                            </label>
                            <input wire:model="location_name" type="text" id="location_name"
                                class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm 
                                       focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                                       placeholder-gray-400"
                                placeholder="contoh: Gudang A">
                            @error('location_name')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Max Lantai -->
                        <div>
                            <label for="max_lantai" class="block text-sm font-medium text-gray-700 mb-2">
                                🏢 Max Lantai
                            </label>
                            <input wire:model="max_lantai" type="number" id="max_lantai" min="0" step="1"
                                class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm 
                                       focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500
                                       placeholder-gray-400 text-right"
                                placeholder="misal: 3">
                            @error('max_lantai')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                            <p class="text-xs text-gray-500 mt-1">Isi jumlah lantai maksimal (tidak boleh negatif)</p>
                        </div>
                    </div>

                    <!-- Max Rak -->
                    <div>
                        <label for="max_rak" class="block text-sm font-medium text-gray-700 mb-2">
                            📦 Max Rak
                        </label>
                        <input wire:model="max_rak" type="number" id="max_rak" min="0" step="1"
                            class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm 
                                   focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500
                                   placeholder-gray-400 text-right"
                            placeholder="misal: 20">
                        @error('max_rak')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                        <p class="text-xs text-gray-500 mt-1">Isi jumlah rak maksimal (tidak boleh negatif)</p>
                    </div>

                    <!-- Footer -->
                    <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
                        <button type="button" wire:click="closeModal"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 
                                   rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-lg 
                                   hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            {{ $isEdit ? 'Update' : 'Create' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>

<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('openForm', (event) => {
            if (event && event.headId) {
                @this.openModal(event.headId);
            } else {
                @this.openModal();
            }
        });
    });
</script>
