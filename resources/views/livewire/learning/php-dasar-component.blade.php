<div class="space-y-6">
    <!-- Header + Progress -->
    <div class="bg-white dark:bg-[#161615] rounded-lg p-6 shadow-sm border border-gray-200/60 dark:border-[#3E3E3A]">
        <div class="flex items-center justify-between gap-4">
            <div>
                <h1 class="text-xl font-semibold dark:text-[#EDEDEC]">Learning with Laravel — PHP 8+ Dasar</h1>
                <p class="text-sm text-gray-600 dark:text-[#A1A09A]">
                    Variabel, Array, Fungsi, dan OOP mini. Kamu bisa ubah input dan lihat hasil langsung.
                </p>
            </div>
            <div class="text-right">
                <div class="text-sm font-medium">Progress:
                    <span class="tabular-nums">{{ $this->progress }}%</span>
                </div>
                <div class="mt-2 h-2 w-48 bg-gray-200 rounded-full overflow-hidden">
                    <div class="h-2 bg-blue-600" style="width: {{ $this->progress }}%"></div>
                </div>
                <button wire:click="resetChecks" class="mt-2 text-xs text-blue-600 hover:underline">Reset</button>
            </div>
        </div>
    </div>
    <div class="bg-white dark:bg-gray-900 rounded-lg shadow p-6">
        <h2 class="text-lg font-semibold mb-4">Daftar Perintah PHP Artisan</h2>

        <table class="min-w-full border border-gray-200 dark:border-gray-700">
            <thead class="bg-gray-100 dark:bg-gray-800">
                <tr>
                    <th class="px-4 py-2 text-left">Deskripsi</th>
                    <th class="px-4 py-2 text-left">Perintah</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                <tr>
                    <td class="px-4 py-2">Membuat Model</td>
                    <td class="px-4 py-2"><code>php artisan make:model NamaModel</code></td>
                </tr>
                <tr>
                    <td class="px-4 py-2">Membuat Controller</td>
                    <td class="px-4 py-2"><code>php artisan make:controller NamaController --resource</code></td>
                </tr>
                <tr>
                    <td class="px-4 py-2">Membuat Migration (Buat Tabel Baru)</td>
                    <td class="px-4 py-2">
                        <code>php artisan make:migration create_nama_tabel_table</code>
                    </td>
                </tr>
                <tr>
                    <td class="px-4 py-2">Menambahkan Kolom pada Tabel</td>
                    <td class="px-4 py-2">
                        <code>php artisan make:migration add_nama_kolom_to_nama_tabel_table --table=nama_tabel</code>
                    </td>
                </tr>
                <tr>
                    <td class="px-4 py-2">Mengubah Kolom pada Tabel (butuh doctrine/dbal)</td>
                    <td class="px-4 py-2">
                        <code>php artisan make:migration change_nama_kolom_in_nama_tabel_table
                            --table=nama_tabel</code><br>
                        <small>Install dulu: <code>composer require doctrine/dbal</code></small>
                    </td>
                </tr>
                <tr>
                    <td class="px-4 py-2">Menghapus Kolom pada Tabel</td>
                    <td class="px-4 py-2">
                        <code>php artisan make:migration remove_nama_kolom_from_nama_tabel_table
                            --table=nama_tabel</code>
                    </td>
                </tr>
                <tr>
                    <td class="px-4 py-2">Menghapus Seluruh Tabel</td>
                    <td class="px-4 py-2">
                        <code>php artisan make:migration drop_nama_tabel_table</code>
                    </td>
                </tr>
                <tr>
                    <td class="px-4 py-2">Menjalankan Semua Migration</td>
                    <td class="px-4 py-2">
                        <code>php artisan migrate</code>
                    </td>
                </tr>
                <tr>
                    <td class="px-4 py-2">Rollback (Batalkan Migration Terakhir)</td>
                    <td class="px-4 py-2">
                        <code>php artisan migrate:rollback</code>
                    </td>
                </tr>
                <tr>
                    <td class="px-4 py-2">Rollback Semua Migration</td>
                    <td class="px-4 py-2">
                        <code>php artisan migrate:reset</code>
                    </td>
                </tr>
                <tr>
                    <td class="px-4 py-2">Refresh Migration (Rollback & Migrate Ulang)</td>
                    <td class="px-4 py-2">
                        <code>php artisan migrate:refresh</code>
                    </td>
                </tr>
                <tr>
                    <td class="px-4 py-2">Fresh Migration (Drop Semua Tabel & Migrate Ulang)</td>
                    <td class="px-4 py-2">
                        <code>php artisan migrate:fresh</code>
                    </td>
                </tr>
                <tr>
                    <td class="px-4 py-2">Membuat Seeder</td>
                    <td class="px-4 py-2"><code>php artisan make:seeder NamaSeeder</code></td>
                </tr>
                <tr>
                    <td class="px-4 py-2">Membuat Factory</td>
                    <td class="px-4 py-2"><code>php artisan make:factory NamaFactory --model=NamaModel</code></td>
                </tr>
                <tr>
                    <td class="px-4 py-2">Membuat Livewire Component</td>
                    <td class="px-4 py-2"><code>php artisan make:livewire nama-component</code></td>
                </tr>
                <tr>
                    <td class="px-4 py-2">Membuat Request Validation</td>
                    <td class="px-4 py-2"><code>php artisan make:request NamaRequest</code></td>
                </tr>
                <tr>
                    <td class="px-4 py-2">Membuat Resource</td>
                    <td class="px-4 py-2"><code>php artisan make:resource NamaResource</code></td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Checklist -->
    <div class="bg-white dark:bg-[#161615] rounded-lg p-6 shadow-sm border border-gray-200/60 dark:border-[#3E3E3A]">
        <h2 class="text-lg font-semibold mb-4 dark:text-[#EDEDEC]">Checklist Pemba</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
            <label class="flex items-center gap-3 text-sm">
                <input type="checkbox" class="h-4 w-4" wire:model="checks.tipe-data">
                <span>Tipe Data (string, int, bool)</span>
            </label>
            <label class="flex items-center gap-3 text-sm">
                <input type="checkbox" class="h-4 w-4" wire:model="checks.variables">
                <span>Variabel (string, int, bool) & binding</span>
            </label>
            <label class="flex items-center gap-3 text-sm">
                <input type="checkbox" class="h-4 w-4" wire:model="checks.arrays">
                <span>Array (indexed/associative) & loop</span>
            </label>
            <label class="flex items-center gap-3 text-sm">
                <input type="checkbox" class="h-4 w-4" wire:model="checks.functions">
                <span>Fungsi (parameter, return, helper)</span>
            </label>
            <label class="flex items-center gap-3 text-sm">
                <input type="checkbox" class="h-4 w-4" wire:model="checks.oop">
                <span>OOP (class, method)</span>
            </label>
            <label class="flex items-center gap-3 text-sm">
                <input type="checkbox" class="h-4 w-4" wire:model="checks.practice">
                <span>Latihan mini (tambah/hapus item)</span>
            </label>
        </div>
    </div>
    <!-- Tipe Data -->
    <div class="bg-white dark:bg-[#161615] rounded-lg p-6 shadow-sm border border-gray-200/60 dark:border-[#3E3E3A]">
        <h3 class="text-lg font-semibold mb-3 dark:text-[#EDEDEC]">1) Tipe Data</h3>

        <table class="w-full border border-gray-300 text-sm">
            <thead class="bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white">
                <tr>
                    <th class="px-4 py-2 border">Label</th>
                    <th class="px-4 py-2 border">Nilai</th>
                    <th class="px-4 py-2 border">Tipe Data</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataTypes as $data)
                    <tr class="border-t dark:border-gray-600">
                        <td class="px-4 py-2 border">{{ $data['label'] }}</td>
                        <td class="px-4 py-2 border">{{ $data['value'] }}</td>
                        <td class="px-4 py-2 border text-blue-600 font-medium">{{ $data['type'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    <!-- Variabel -->
    <div class="bg-white dark:bg-[#161615] rounded-lg p-6 shadow-sm border border-gray-200/60 dark:border-[#3E3E3A]">
        <h3 class="text-lg font-semibold mb-3 dark:text-[#EDEDEC]">2) Variabel</h3>
        <div class="p-4 bg-white rounded shadow">
            <h3 class="font-bold text-lg">Informasi Produk</h3>
            <p>Nama: {{ $name }}</p>
            <p>Nama Seller: {{ $sellerName }}</p>
            <p>Harga: Rp {{ number_format($price, 0, ',', '.') }}</p>
            <p>Kategori: {{ $category }}</p>
        </div>
        <div class="grid md:grid-cols-4 gap-4">
            <div>
                <label class="text-xs text-gray-500">Nama Produk</label>
                <input type="text" class="mt-1 w-full border rounded px-3 py-2" wire:model.defer="name"
                    placeholder="Isi nama Produk...">
            </div>
            <div>
                <label class="text-xs text-gray-500">Nama Seller</label>
                <input type="text" class="mt-1 w-full border rounded px-3 py-2" wire:model.defer="sellerName"
                    placeholder="Isi nama Seller...">
            </div>
            <div>
                <label class="text-xs text-gray-500">Harga</label>
                <input type="number" class="mt-1 w-full border rounded px-3 py-2" wire:model.defer="price"
                    placeholder="Isi Harga...">
            </div>
            <div>
                <label class="text-xs text-gray-500">Kategori</label>
                <input type="text" class="mt-1 w-full border rounded px-3 py-2" wire:model.defer="category"
                    placeholder="Isi Kategori...">
            </div>
            <div class="flex items-end gap-2">
                <label class="flex items-center gap-2">
                    <input type="checkbox" wire:model="aktif">
                    <span class="text-sm">Aktif?</span>
                </label>
                <button wire:click="updateProduct" class="ml-auto text-xs px-3 py-2 border rounded">Lihat
                    Output</button>
            </div>
        </div>

        <div class="mt-4 text-sm text-gray-700 dark:text-[#A1A09A]">
            Output:
            <strong>{{ "Halo, $nama (umur $umur) alamat $address hobi $hoby — " . ($aktif ? 'Aktif' : 'Tidak aktif') }}</strong>
        </div>
    </div>

    <!-- Array & Fungsi -->
    <div class="bg-white dark:bg-[#161615] rounded-lg p-6 shadow-sm border border-gray-200/60 dark:border-[#3E3E3A]">
        <h3 class="text-lg font-semibold mb-3 dark:text-[#EDEDEC]">3) Array & Fungsi</h3>

        <div class="flex items-center gap-3">
            <input type="number" class="w-32 border rounded px-3 py-2" wire:model="angkaBaru">
            <button class="px-3 py-2 border rounded" wire:click="tambahAngka">Tambah ke Array</button>
            <div class="ml-auto text-sm">
                Total (array_sum): <strong>{{ $this->jumlahkanAngka() }}</strong>
            </div>
        </div>

        <ul class="mt-4 text-sm list-disc pl-5">
            @foreach ($angka as $i => $n)
                <li class="flex items-center gap-3">
                    <span>Index {{ $i }} =&gt; {{ $n }}</span>
                    <button class="text-xs text-red-600 hover:underline"
                        wire:click="hapusAngka({{ $i }})">hapus</button>
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Latihan mini: daftar user -->
    <div class="bg-white dark:bg-[#161615] rounded-lg p-6 shadow-sm border border-gray-200/60 dark:border-[#3E3E3A]">
        <h3 class="text-lg font-semibold mb-3 dark:text-[#EDEDEC]">4) Latihan Mini (Array of Associative)</h3>

        <div class="grid md:grid-cols-3 gap-4">
            <input type="text" class="border rounded px-3 py-2" placeholder="Nama" wire:model="userNama">
            <input type="email" class="border rounded px-3 py-2" placeholder="Email" wire:model="userEmail">
            <button class="px-3 py-2 border rounded" wire:click="tambahUser">Tambah User</button>
        </div>

        <table class="mt-4 w-full text-sm border">
            <thead>
                <tr class="bg-gray-50">
                    <th class="p-2 border">#</th>
                    <th class="p-2 border">Nama</th>
                    <th class="p-2 border">Email</th>
                    <th class="p-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $i => $u)
                    <tr>
                        <td class="p-2 border">{{ $i + 1 }}</td>
                        <td class="p-2 border">{{ $u['nama'] }}</td>
                        <td class="p-2 border">{{ $u['email'] }}</td>
                        <td class="p-2 border">
                            <button class="text-xs text-red-600 hover:underline"
                                wire:click="hapusUser({{ $i }})">hapus</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @error('userNama')
            <div class="text-xs text-red-600 mt-2">{{ $message }}</div>
        @enderror
        @error('userEmail')
            <div class="text-xs text-red-600">{{ $message }}</div>
        @enderror
    </div>

    <!-- OOP mini -->
    <div class="bg-white dark:bg-[#161615] rounded-lg p-6 shadow-sm border border-gray-200/60 dark:border-[#3E3E3A]">
        <h3 class="text-lg font-semibold mb-3 dark:text-[#EDEDEC]">5) OOP Mini </h3>

        <div class="grid md:grid-cols-5 gap-3">
            <div>
                <label class="text-xs text-gray-500">a</label>
                <input type="number" class="mt-1 w-full border rounded px-3 py-2" wire:model="a">
            </div>
            <div>
                <label class="text-xs text-gray-500">b</label>
                <input type="number" class="mt-1 w-full border rounded px-3 py-2" wire:model="b">
            </div>
            <div class="md:col-span-3 flex items-end">
                <button class="px-3 py-2 border rounded" wire:click="hitungOop">Hitung (class kalkulator)</button>
                <div class="ml-4 text-sm">
                    Tambah: <strong>{{ $hasilTambah ?? '-' }}</strong> &nbsp;|&nbsp;
                    Kali: <strong>{{ $hasilKali ?? '-' }}</strong>
                </div>
            </div>
        </div>

        <p class="mt-3 text-xs text-gray-600 dark:text-[#A1A09A]">
            Di method <code>hitungOop()</code> kita membuat objek kalkulator (class anonim), lalu panggil
            <code>tambah()</code> dan <code>kali()</code>. Ini contoh dasar OOP: enkapsulasi & pemanggilan method.
        </p>
    </div>
</div>
