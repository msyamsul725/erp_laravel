<div class="space-y-4">
    <div class="flex items-center justify-between">
        <h2 class="text-xl font-semibold">Attendance List</h2>
        <input type="text" wire:model.live="search" class="border rounded px-3 py-2"
            placeholder="Cari user / tanggal...">
    </div>

    <div class="rounded-lg border">
        <table class="w-full text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="text-left p-3">User</th>
                    <th class="text-left p-3">Tanggal</th>
                    <th class="text-left p-3">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($items as $row)
                    <tr class="border-t">
                        <td class="p-3">{{ $row->user->name }}</td>
                        <td class="p-3">{{ $row->date }}</td>
                        <td class="p-3">{{ $row->status }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="p-4 text-center text-gray-500">Belum ada data.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
