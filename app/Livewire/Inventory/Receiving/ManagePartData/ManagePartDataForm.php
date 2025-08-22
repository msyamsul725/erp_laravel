<?php

namespace App\Livewire\Inventory\Receiving\ManagePartData;

use App\Domains\Inventory\Receiving\Models\Part;
use App\Shared\Traits\WithAlerts;
use Illuminate\Validation\Rule;
use Livewire\Component;

class ManagePartDataForm extends Component
{
    use WithAlerts;

    public $partId;
    public $part_number = '';
    public $part_name = '';
    public $stock = 0;
    public $minimum = 0;
    public $is_active = true;
    public $showModal = false;
    public $isEditing = false;

    protected function rules()
    {
        return [
            'part_number' => [
                'required',
                'string',
                Rule::unique('parts', 'part_number')->ignore($this->partId),
            ],
            'part_name' => 'required|string|max:255',
            'stock'     => 'required|integer|min:0',
            'minimum'   => 'required|integer|min:0',
            'is_active' => 'boolean',
        ];
    }

    public function loadPart($partId)
    {
        $part = Part::findOrFail($partId);

        $this->partId      = $part->id;
        $this->part_number = $part->part_number;
        $this->part_name   = $part->part_name;
        $this->stock       = $part->stock;
        $this->minimum     = $part->minimum;
        $this->is_active   = $part->is_active;
        $this->isEditing   = true;
    }

    public function openModal($partId = null)
    {
        $this->resetForm();

        if ($partId) {
            $this->loadPart($partId);
        } else {
            $this->isEditing = false;
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
        $this->partId      = null;
        $this->part_number = '';
        $this->part_name   = '';
        $this->stock       = 0;
        $this->minimum     = 0;
        $this->is_active   = true;
        $this->isEditing   = false;
        $this->resetErrorBag();
    }

    public function save()
    {
        $this->validate();

        if ($this->isEditing) {
            $part = Part::findOrFail($this->partId);
            $part->update([
                'part_number' => $this->part_number,
                'part_name'   => $this->part_name,
                'stock'       => $this->stock,
                'minimum'     => $this->minimum,
                'is_active'   => $this->is_active,
            ]);
        } else {
            $part = Part::create([
                'part_number' => $this->part_number,
                'part_name'   => $this->part_name,
                'stock'       => $this->stock,
                'minimum'     => $this->minimum,
                'is_active'   => $this->is_active,
            ]);
        }

        $this->showSuccessToast(
            $this->isEditing ? 'Part updated successfully.' : 'Part created successfully.'
        );

        $this->closeModal();
        $this->dispatch('partSaved');
    }

    public function render()
    {
        return view('livewire.inventory.receiving.manage-part-data.manage-part-data-form');
    }
}
