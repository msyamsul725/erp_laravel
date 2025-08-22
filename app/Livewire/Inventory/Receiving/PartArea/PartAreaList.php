<?php

namespace App\Livewire\Inventory\Receiving\PartArea;

use App\Domains\Inventory\Receiving\Models\HeadLocation;
use App\Domains\Inventory\Receiving\Models\Location;
use Livewire\Component;

class PartAreaList extends Component

{
    public $headLocations;
    public $headLocation;    // model HeadLocation aktif
    public $view = 'head';   // head | layout

    public function mount()
    {
        // preload semua HeadLocation
        $this->headLocations = HeadLocation::withCount('locations')->get();
    }

    public function openHeadLocation(int $id)
    {
        $this->headLocation = HeadLocation::with('locations')->findOrFail($id);
        $this->view = 'layout';
    }

    public function backToList()
    {
        $this->reset(['headLocation']);
        $this->view = 'head';
    }

    public function selectLocation(int $id)
    {
        $this->dispatch('openLocationDetail', ['location_id' => $id]);
    }

    public function createLocation()
    {
        $this->dispatch('openLocationForm', ['head_location_id' => $this->headLocation->id]);
    }

    public function render()
    {
        return view('livewire.inventory.receiving.part-area.part-area-list', [
            'headLocations' => $this->headLocations,
            'headLocation'  => $this->headLocation,
        ]);
    }
}
