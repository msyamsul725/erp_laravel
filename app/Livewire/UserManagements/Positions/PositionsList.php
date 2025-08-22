<?php

namespace App\Livewire\UserManagements\Positions;

use App\Domains\UserMangement\Position\Models\Position as ModelsPosition;
use Livewire\Component;
use Livewire\WithPagination;

use App\Shared\Traits\WithAlerts as TraitsWithAlerts;

class PositionsList extends Component
{
    use WithPagination, TraitsWithAlerts;

    public $search = '';
    public $perPage = 10;
    public $showInactive = false;
    public $sortField = 'title';
    public $sortDirection = 'asc';

    protected $listeners = ['positionSaved' => '$refresh'];

    protected $queryString = [
        'search' => ['except' => ''],
        'showInactive' => ['except' => false],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function togglePositionStatus($positionId)
    {
        $position = ModelsPosition::findOrFail($positionId);
        $oldStatus = $position->is_active;
        $newStatus = !$position->is_active;
        $status = $oldStatus ? 'deactivated' : 'activated';
        $position->update([
            'is_active' => $newStatus
        ]);

        $this->dispatch('refresh');
        $this->showSuccessToast("Position {$status} successfully!");
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

    public function confirmDeletePosition($positionId)
    {
        $position = ModelsPosition::findOrFail($positionId);
        $this->showConfirm(
            'Delete Position',
            "Are you sure you want to delete position '{$position->title}'? This action cannot be undone.",
            'deletePosition',
            ['positionId' => $positionId],
            'Yes, delete it!',
            'Cancel'
        );
    }

    public function deletePosition($positionId)
    {
        $position = ModelsPosition::findOrFail($positionId);
        $position->delete();

        $this->dispatch('$refresh');
        $this->showSuccessToast('Position deleted successfully!');
    }

    public function render()
    {
        $positions = ModelsPosition::query()
            ->select(['id', 'title', 'department_id', 'level', 'is_active', 'created_at', 'updated_at'])
            ->with('department:id,name') // biar bisa tampil nama department
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('title', 'like', '%' . $this->search . '%')
                        ->orWhere('level', 'like', '%' . $this->search . '%');
                });
            })
            ->when(!$this->showInactive, function ($query) {
                $query->where('is_active', true);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.user-managements.positions.positions-list', compact('positions'));
    }
}
