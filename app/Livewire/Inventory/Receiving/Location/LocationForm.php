<?php

namespace App\Livewire\Inventory\Receiving\Location;

use App\Domains\Inventory\Receiving\Models\HeadLocation;
use App\Domains\Inventory\Receiving\Models\Location as ModelsLocation;
use App\Domains\User\Models\User;

use App\Shared\Traits\WithAlerts;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class LocationForm extends Component
{
    use WithAlerts;

    public $locationId;
    public $head_name = '';
    public $quantity = 0;
    public $head_location_id = '';
    public $user_id = '';
    public $showModal = false;
    public $isEditing = false;

    protected function rules()
    {
        return [
            'head_name'        => 'required|string|max:255',
            'quantity'         => 'required|integer|min:0',
            'head_location_id' => 'required|exists:head_location,id',

        ];
    }

    public function loadLocation($locationId)
    {
        $location = ModelsLocation::findOrFail($locationId);

        $this->locationId       = $location->id;
        $this->head_name        = $location->head_name;
        $this->quantity         = $location->quantity;
        $this->head_location_id = $location->head_location_id;
        $this->user_id          = $location->user_id;
        $this->isEditing        = true;
    }

    public function openModal($locationId = null)
    {
        $this->resetForm();

        if ($locationId) {
            $this->loadLocation($locationId);
        }

        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->locationId       = null;
        $this->head_name        = '';
        $this->quantity         = 0;
        $this->head_location_id = '';
        $this->user_id          = '';
        $this->isEditing        = false;
        $this->resetErrorBag();
    }
    public function generateHeadName()
    {
        $value = $this->head_location_id;

        if (!$value) {
            $this->head_name = '';
            return;
        }

        $headLocation = HeadLocation::find($value);
        if (!$headLocation) {
            $this->head_name = '';
            return;
        }

        // ambil singkatan dari nama lokasi
        $abbr = collect(explode(' ', $headLocation->location_name))
            ->map(fn($word) => substr($word, 0, 1))
            ->join('');
        $abbr = strtoupper($abbr);

        // cari record terakhir
        $lastLocation = ModelsLocation::where('head_location_id', $value)
            ->orderBy('id', 'desc')
            ->first();

        $batch = 1;
        $tier = 1;
        $num = 1;

        if ($lastLocation && preg_match('/([A-Z]+)(\d+)-T(\d+)-(\d+)/', $lastLocation->head_name, $matches)) {
            $batch = (int)$matches[2];
            $tier  = (int)$matches[3];
            $num   = (int)$matches[4];

            if ($num < 9) {
                $num++;
            } else {
                $num = 1;
                if ($tier < 9) {
                    $tier++;
                } else {
                    $tier = 1;
                    $batch++;
                }
            }
        }

        $this->head_name = sprintf("%s%d-T%d-%02d", $abbr, $batch, $tier, $num);
    }

    public function save()
    {
        $this->validate();

        if ($this->isEditing) {
            $location = ModelsLocation::findOrFail($this->locationId);
            $location->update([
                'head_name'        => $this->head_name,
                'quantity'         => $this->quantity,
                'head_location_id' => $this->head_location_id,
                'user_id'          => Auth::id(),
            ]);
        } else {
            $location = ModelsLocation::create([
                'head_name'        => $this->head_name,
                'quantity'         => $this->quantity,
                'head_location_id' => $this->head_location_id,
                'user_id'          => Auth::id(),
            ]);
        }

        $this->showSuccessToast(
            $this->isEditing ? 'Location updated successfully.' : 'Location created successfully.'
        );

        $this->closeModal();
        $this->dispatch('locationSaved');
    }

    public function render()
    {
        return view('livewire.inventory.receiving.location.location-form', [
            'headLocations' => HeadLocation::orderBy('location_name')->get(),
            'users'         => User::orderBy('name')->get(),

        ]);
    }
}
