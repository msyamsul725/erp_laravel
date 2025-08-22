<div class="space-y-4">
    <div class="flex items-center justify-between">
        <h2 class="text-xl font-semibold">Submissions</h2>
        <div class="text-sm text-gray-500">Dashboard &gt; Attendance &gt; Submissions</div>
    </div>

    @if (session('message'))
        <div class="p-3 rounded bg-green-50 text-green-700 border border-green-200">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="submit" class="space-y-3">
        <div>
            <label class="block text-sm mb-1">Tanggal</label>
            <input type="date" class="border rounded px-3 py-2 w-full">
        </div>
        <div>
            <label class="block text-sm mb-1">Keterangan</label>
            <textarea class="border rounded px-3 py-2 w-full" rows="3"></textarea>
        </div>
        <button class="px-4 py-2 rounded bg-blue-600 text-white">Kirim</button>
    </form>
</div>
