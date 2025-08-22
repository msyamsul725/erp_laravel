<div>
    {{-- 
        1. Bungkus semuanya dengan Alpine.js untuk state management.
           'open' adalah state kita, awalnya 'false' (tertutup).
    --}}
    <div x-data="{ open: false }">

        {{-- 2. Tombol ini akan mengubah state 'open' menjadi 'true' saat diklik --}}
        <button @click="open = true"
            class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2">
            Tampilkan Detail Pengguna
        </button>

        {{-- 
            3. Gunakan komponen Dialog dari shadcn/ui.
               Kita bind statusnya ke state 'open' dari Alpine.js.
        --}}
        <x-ui.dialog :open="open" @close.window="open = false">
            <x-ui.dialog-content class="sm:max-w-[425px]">
                <x-ui.dialog-header>
                    <x-ui.dialog-title>Profil Pengguna</x-ui.dialog-title>
                    <x-ui.dialog-description>
                        Ini adalah detail pengguna yang diambil dari komponen Livewire.
                    </x-ui.dialog-description>
                </x-ui.dialog-header>

                {{-- Data dari komponen Livewire Anda bisa ditampilkan di sini --}}
                <div class="py-4">
                    <p>Nama: <strong>{{ $namaPengguna }}</strong></p>
                    <p>Email: <strong>{{ $emailPengguna }}</strong></p>
                </div>

                <x-ui.dialog-footer>
                    {{-- Tombol ini akan menutup dialog dengan mengubah state 'open' menjadi 'false' --}}
                    <button @click="open = false" type="button"
                        class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2">
                        Tutup
                    </button>
                </x-ui.dialog-footer>
            </x-ui.dialog-content>
        </x-ui.dialog>

    </div>
</div>
