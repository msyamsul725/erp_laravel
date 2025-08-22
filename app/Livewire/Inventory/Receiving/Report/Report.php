<?php

namespace App\Livewire\Inventory\Receiving\Report;

use App\Domains\Inventory\Receiving\Models\History;

use App\Shared\Traits\WithAlerts;
use Livewire\Component;
use Livewire\WithPagination;

class Report extends Component
{
    use WithPagination, WithAlerts;

    public $search = '';
    public $perPage = 10;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

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
    public function printReport()
    {
        // Bisa langsung redirect ke route cetak
        return redirect()->route('report.print');
    }
    public function render()
    {
        $histories = History::query()
            ->select(['id', 'part_id', 'location_id', 'user_id', 'stock', 'quantity', 'description', 'created_at'])
            ->when($this->search, function ($query) {
                $search = $this->search;

                $query->where(function ($q) use ($search) {
                    $q->where('description', 'like', '%' . $search . '%')
                        ->orWhereHas('part', function ($q2) use ($search) {
                            $q2->where('part_name', 'like', '%' . $search . '%')
                                ->orWhere('part_number', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('location', function ($q3) use ($search) {
                            $q3->where('head_name', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('user', function ($q4) use ($search) {
                            $q4->where('name', 'like', '%' . $search . '%');
                        });
                });
            })
            ->with([
                'part:id,part_number,part_name',
                'location:id,head_name',
                'user:id,name'
            ])
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.inventory.receiving.report.report', compact('histories'));
    }
}
