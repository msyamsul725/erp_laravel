<?php

namespace App\Livewire\Inventory\Receiving\HeadLocation;

use App\Domains\Inventory\Receiving\Models\HeadLocation;
use App\Domains\Role\Models\Role;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use App\Shared\Traits\WithAlerts;

class HeadLocationForm extends Component
{
    use  WithAlerts;
    public $headLocations;
    public $location_name, $max_lantai, $max_rak, $headLocationsId;
    public $isEdit = false;
    public $showModal = false;
    public $message = null;
    public $error = null;


    public function mount($headId = null)
    {
        if ($headId) {
            $this->edit($headId);
        }
    }


    protected $rules = [
        'location_name' => 'required|string|max:255',
        'max_lantai'    => 'required|integer|min:0',
        'max_rak'       => 'required|integer|min:0',
    ];
    public function render()
    {

        return view('livewire.inventory.receiving.head-location.head-location-form',);
    }
    public function refreshList()
    {
        $this->headLocations = HeadLocation::latest()->get();
    }
    public function resetForm()
    {
        $this->location_name = '';
        $this->max_lantai = '';
        $this->max_rak = '';
        $this->headLocations = null;
        $this->isEdit = false;
    }

    public function edit($id)
    {
        $data = HeadLocation::findOrFail($id);

        $this->headLocationsId = $data->id;
        $this->location_name   = $data->location_name;
        $this->max_lantai      = $data->max_lantai;
        $this->max_rak         = $data->max_rak;
        $this->isEdit          = true;
    }
    public function openModal($headId = null)
    {
        $this->resetForm();
        if ($headId) {
            $this->edit($headId);
        } else {
            $this->isEdit = false;
        }
        $this->showModal = true;
    }
    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    public function save()
    {

        if ($this->isEdit) {
            $this->update();
        } else {
            $this->store();
        }

        $this->showSuccessToast($this->isEdit ? 'Head Location updated successfully.' : 'Head Location created successfully.');
        $this->closeModal();
        $this->dispatch('headSaved');
    }
    public function store()
    {
        $this->validate();

        try {
            HeadLocation::create([
                'location_name' => $this->location_name,
                'max_lantai'    => $this->max_lantai,
                'max_rak'       => $this->max_rak,
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal menambahkan Head Location: ' . $e->getMessage());

            // tampilkan pesan error di UI
            session()->flash('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
        }
    }

    public function update()
    {
        $this->validate();
        try {
            Log::debug('Max Rak', [
                'max_rax' => $this->max_rak,
            ]);
            $data = HeadLocation::findOrFail($this->headLocationsId);
            $data->update([
                'location_name' => $this->location_name,
                'max_lantai'    => $this->max_lantai,
                'max_rak'       => $this->max_rak,
            ]);
        } catch (\Throwable $th) {
            Log::error('Gagal menambahkan Head Location: ' . $th->getMessage());

            // tampilkan pesan error di UI
            session()->flash('error', 'Terjadi kesalahan saat updata data. Silakan coba lagi.');
        }
    }
}
