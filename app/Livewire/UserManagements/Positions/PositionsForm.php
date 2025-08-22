<?php

namespace App\Livewire\UserManagements\Positions;

use App\Domains\UserMangement\Departement\Models\Department as ModelsDepartment;
use App\Domains\UserMangement\Position\Models\Position as ModelsPosition;
use Livewire\Component;
use App\Models\Position;

use App\Shared\Traits\WithAlerts as TraitsWithAlerts;
use Illuminate\Validation\Rule;


class PositionsForm extends Component
{
    use TraitsWithAlerts;

    public $positionId;
    public $title = '';
    public $department_id = '';
    public $level = '';
    public $showModal = false;
    public $isEditing = false;

    protected function rules()
    {
        return [
            'title'         => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
            'level'         => 'nullable|string|max:100',
        ];
    }

    public function loadPosition($positionId)
    {
        $position = ModelsPosition::findOrFail($positionId);

        $this->positionId   = $position->id;
        $this->title        = $position->title;
        $this->department_id = $position->department_id;
        $this->level        = $position->level;
        $this->isEditing    = true;
    }

    public function openModal($positionId = null)
    {
        $this->resetForm();

        if ($positionId) {
            $this->loadPosition($positionId);
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
        $this->positionId   = null;
        $this->title        = '';
        $this->department_id = '';
        $this->level        = '';
        $this->isEditing    = false;
        $this->resetErrorBag();
    }

    public function save()
    {
        $this->validate();

        if ($this->isEditing) {
            $position = ModelsPosition::findOrFail($this->positionId);
            $position->update([
                'title'         => $this->title,
                'department_id' => $this->department_id,
                'level'         => $this->level,
            ]);
        } else {
            $position = ModelsPosition::create([
                'title'         => $this->title,
                'department_id' => $this->department_id,
                'level'         => $this->level,
            ]);
        }

        $this->showSuccessToast($this->isEditing ? 'Position updated successfully.' : 'Position created successfully.');

        $this->closeModal();
        $this->dispatch('positionSaved');
    }

    public function render()
    {
        return view('livewire.user-managements.positions.positions-form', [
            'departments' => ModelsDepartment::orderBy('name')->get(), // untuk dropdown pilih department
        ]);
    }
}
