<?php

namespace App\Livewire\UserManagements\Departments;

use App\Domains\UserMangement\Departement\Models\Department;
use App\Shared\Traits\WithAlerts;
use Livewire\Component;
use Livewire\WithPagination;

class DepartmentsList extends Component



{
    use WithPagination, WithAlerts;

    public $search = '';
    public $showInactive = false;
    public $perPage = 10;
    public $sortField = 'name';
    public $sortDirection = 'asc';
    protected $listeners = ['departmentSaved' => '$refresh'];
    protected $queryString = [

        'search' => ['except' => ''],
        'showInactive' => ['except' => false],
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

    public function toggleDepartmentStatus($departmentId)
    {
        $departement = Department::findOrFail($departmentId);
        $oldStatus = $departement->is_active;
        $newStatus = !$departement->is_active;
        $status = $oldStatus ? 'deactivated' : 'activated';
        $departement->update([
            'is_active' => $newStatus
        ]);

        $this->dispatch('refresh');
        $this->showSuccessToast("Departement {$status} successfully!");
    }


    public function confirmDeleteDepartment($departmentId)
    {
        $department = Department::findOrFail($departmentId);
        $this->showConfirm(
            'Delete department',
            "Are you sure you want to delete department '{$department->name}'? This action cannot be undone.",
            'deleteDepartment',
            ['departmentId' => $departmentId],
            'Yes, delete it!',
            'Cancel'
        );
    }

    public function deleteDepartment($departmentId)
    {

        $department = Department::findOrFail($departmentId);




        $department->delete();

        // Refresh the component to show updated data
        $this->dispatch('$refresh');

        $this->showSuccessToast('Department deleted successfully!');
    }


    public function render()
    {
        $departments = Department::query()
            ->select(['id', 'name', 'code', 'is_active', 'created_at', 'updated_at'])
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('code', 'like', '%' . $this->search . '%');
                });
            })
            ->when(!$this->showInactive, function ($query) {
                $query->where('is_active', true);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.user-managements.departments.departments-list', compact('departments'));
    }
}
