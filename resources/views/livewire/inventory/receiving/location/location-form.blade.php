<div>
    @if ($showModal)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50" wire:click="closeModal">
            <div class="relative top-20 mx-auto p-6 border w-full max-w-2xl shadow-lg rounded-2xl bg-white"
                wire:click.stop>

                <div class="mt-3">
                    <!-- Header -->
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900">
                            {{ $isEditing ? 'Edit Location' : 'Create Location' }}
                        </h3>
                        <button wire:click="closeModal" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Form -->
                    <form wire:submit="save" class="space-y-4">
                        <!-- Head Location -->
                        <div>
                            <label for="head_location_id" class="block text-sm font-medium text-gray-700">
                                Head Location
                            </label>
                            <select wire:model="head_location_id" wire:change="generateHeadName" id="head_location_id"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <option value="">-- Select Head Location --</option>
                                @foreach ($headLocations as $hl)
                                    <option value="{{ $hl->id }}">{{ $hl->location_name }}</option>
                                @endforeach
                            </select>
                            @error('head_location_id')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror


                        </div>



                        <!-- Head Name (Auto Generated) -->
                        <div>
                            <label for="head_name" class="block text-sm font-medium text-gray-700">
                                Head Name (Auto Generated)
                            </label>
                            <input wire:model="head_name" type="text" id="head_name" readonly
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 shadow-sm focus:outline-none">
                            @error('head_name')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Quantity -->
                        <div>
                            <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                            <input wire:model="quantity" type="number" id="quantity" min="0"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            @error('quantity')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Actions -->
                        <div class="flex justify-end space-x-3 pt-4">
                            <button type="button" wire:click="closeModal"
                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500">
                                Cancel
                            </button>
                            <button type="submit"
                                class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                {{ $isEditing ? 'Update' : 'Create' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>

<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('openLocationForm', (event) => {
            if (event && event.locationId) {
                @this.openModal(event.locationId); // Edit
            } else {
                @this.openModal(); // Create
            }
        });
    });
</script>
