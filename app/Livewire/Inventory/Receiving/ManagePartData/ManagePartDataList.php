<?php

namespace App\Livewire\Inventory\Receiving\ManagePartData;

use App\Domains\Inventory\Receiving\Models\Part;
use App\Shared\Traits\WithAlerts;
use Livewire\Component;
use Livewire\WithPagination;

class ManagePartDataList extends Component
{
    use WithPagination, WithAlerts;

    public $search = '';
    public $showInactive = false;
    public $perPage = 10;
    public $sortField = 'part_number';
    public $sortDirection = 'asc';

    protected $listeners = ['partSaved' => '$refresh'];

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

    public function togglePartStatus($partId)
    {
        $part = Part::findOrFail($partId);
        $oldStatus = $part->is_active;
        $newStatus = !$part->is_active;
        $status = $oldStatus ? 'deactivated' : 'activated';

        $part->update([
            'is_active' => $newStatus
        ]);

        $this->dispatch('refresh');
        $this->showSuccessToast("Part {$status} successfully!");
    }

    public function confirmDeletePart($partId)
    {
        $part = Part::findOrFail($partId);

        $this->showConfirm(
            'Delete Part',
            "Are you sure you want to delete part '{$part->part_name}'? This action cannot be undone.",
            'deletePart',
            ['partId' => $partId],
            'Yes, delete it!',
            'Cancel'
        );
    }

    public function deletePart($partId)
    {
        $part = Part::findOrFail($partId);
        $part->delete();

        $this->dispatch('$refresh');
        $this->showSuccessToast('Part deleted successfully!');
    }

    public function render()
    {
        $parts = Part::query()
            ->select(['id', 'part_number', 'part_name', 'stock', 'minimum', 'is_active', 'created_at', 'updated_at'])
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('part_number', 'like', '%' . $this->search . '%')
                        ->orWhere('part_name', 'like', '%' . $this->search . '%');
                });
            })
            ->when(!$this->showInactive, function ($query) {
                $query->where('is_active', true);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.inventory.receiving.manage-part-data.manage-part-data-list', compact('parts'));
    }
}
