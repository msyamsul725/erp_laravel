<?php

namespace App\Livewire\UserManagements\Departments;

use App\Domains\UserMangement\Departement\Models\Department;
use App\Shared\Traits\WithAlerts;
use Illuminate\Validation\Rule;
use Livewire\Component;

class DepartmentsForm extends Component
{

    use WithAlerts;

    public $departmentId;
    public $name = '';
    public $code = '';
    public $is_active = true;
    public $showModal = false;
    public $isEditing = false;


    protected function rules()
    {

        return [
            'name' => 'required|string|max:255',
            'code' => [
                'required',
                'string',
                Rule::unique('departments', 'code')->ignore($this->departmentId),

            ],
            'is_active' => 'boolean'
        ];
    }
    public function mount($departmentId = null)
    {
        if ($departmentId) {
        }
    }

    public function loadDepartment($departmentId)
    {
        $department = Department::findOrFail($departmentId);
        $this->departmentId = $department->id;
        $this->name = $department->name;
        $this->code = $department->code;
        $this->is_active = $department->is_active;
        $this->isEditing = true;
    }
    public function openModal($departmentId = null)
    {

        $this->resetForm();
        if ($departmentId) {
            $this->loadDepartment($departmentId);
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
        $this->departmentId = null;
        $this->name = '';
        $this->code = '';
        $this->is_active = true;
        $this->isEditing = false;
        $this->resetErrorBag();
    }

    public function save()
    {
        $this->validate();

        if ($this->isEditing) {
            $department = Department::findOrFail($this->departmentId);
            $department->update([
                'name' => $this->name,
                'code' => $this->code,
                'is_active' => $this->is_active,

            ]);
        } else {
            $department = Department::create([
                'name' => $this->name,
                'code' => $this->code,
                'is_active' => $this->is_active,
            ]);
        }
        $this->showSuccessToast($this->isEditing ? 'Department updated successfully' : 'Depatment created successfully.');

        $this->closeModal();
        $this->dispatch('departmentSaved');
    }

    public function render()
    {
        return view('livewire.user-managements.departments.departments-form');
    }
}
