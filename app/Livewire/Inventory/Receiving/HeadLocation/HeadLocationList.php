<?php

namespace App\Livewire\Inventory\Receiving\HeadLocation;

use App\Domains\Inventory\Receiving\Models\HeadLocation;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Shared\Traits\WithAlerts;
use Illuminate\Support\Facades\Log;
use Livewire\WithPagination;

class HeadLocationList extends Component
{
    use WithPagination;
    use  WithAlerts;
    public $search = '';
    public $perPage = 10;
    public $sortField = 'location_name';
    public $sortDirection = 'asc';
    protected $listeners = ['headSaved' => '$refresh'];
    protected $queryString = [
        'search' => ['except' => ''],
    ];
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
    }


    public function confirmDelete($id)
    {
        // Log id yang masuk
        Log::debug('confirmDelete dipanggil', ['id' => $id]);

        $head = HeadLocation::findOrFail($id);

        // Log data HeadLocation yang ditemukan
        Log::debug('Data HeadLocation ditemukan', $head->toArray());

        $this->showConfirm(
            'Delete Head Location',
            "Are you sure you want to delete head location '{$head->location_name}'? This action cannot be undone.",
            'deleteHeadLocation',
            ['id' => $id],
            'Yes, proceed!',
            'Cancel'
        );
    }



    public function deleteHeadLocation($id)
    {
        try {
            Log::debug('Delete HeadLocation dipanggil', ['id' => $id]);

            $head = HeadLocation::findOrFail($id);
            Log::debug('Data ditemukan', $head->toArray());

            $head->delete();
            Log::debug('Data berhasil dihapus', ['id' => $id]);


            $this->showSuccessToast("Head Location '{$head->location_name}' deleted successfully.");
        } catch (\Throwable $th) {
            Log::error('Gagal delete Head Location', [
                'id' => $id,
                'error' => $th->getMessage()
            ]);

            $this->showErrorToast('Failed to delete Head Location.');
        }
    }


    public function render()
    {
        return view('livewire.inventory.receiving.head-location.head-location-list', [
            'headLocations' => HeadLocation::query()
                ->where('location_name', 'like', "%{$this->search}%")
                ->latest()
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->perPage),
        ]);
    }
}
