<?php

namespace App\Livewire\Inventory\Receiving\Location;

use App\Domains\Inventory\Receiving\Models\Location;
use App\Shared\Traits\WithAlerts;
use Livewire\Component;
use Livewire\WithPagination;

class LocationList extends Component
{

    use WithPagination, WithAlerts;

    public $search = '';
    public $perPage = 10;
    public $sortField = 'head_name';
    public $sortDirection = 'asc';
    protected $listeners = ['locationSaved' => '$refresh'];

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }


    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
    }


    public function confirmDeleteLocation($locationId)
    {

        $location = Location::findOrFail($locationId);
        $this->showConfirm(
            'Delete Location',
            "Are you sure you want to delete location '{$location->head_name}' ? This action cannot be undone.",
            'deleteLocation',
            ['locationId' => $locationId],
            'Yes, delete it!',
            'Cancel'
        );
    }

    public function deleteLocation($locationId)
    {

        $location = Location::findOrFail($locationId);
        $location->delete();

        $this->dispatch('$refresh');
        $this->showSuccessToast('Location deleted successfully!');
    }
    public function render()
    {

        $locations = Location::query()
            ->select(['id', 'head_name', 'quantity', 'head_location_id', 'user_id', 'created_at', 'updated_at'])
            ->when($this->search, function ($query) {
                $search = $this->search;

                $query->where(function ($q) use ($search) {
                    $q->where('head_name', 'like', '%' . $search . '%')
                        ->orWhereHas('headLocation', function ($q2) use ($search) {
                            $q2->where('location_name', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('user', function ($q3) use ($search) {
                            $q3->where('name', 'like', '%' . $search . '%');
                        });
                });
            })
            ->with([
                'headLocation:id,location_name',
                'user:id,name'
            ])
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
        return view('livewire.inventory.receiving.location.location-list', compact('locations'));
    }
}
