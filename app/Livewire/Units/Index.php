<?php

namespace App\Livewire\Units;

use App\Models\Units;
use Livewire\Component;

class Index extends Component
{
    public $search = '';
    public $showEditModal = false;
    public $showAddUnitModal = false;
    public $showDeleteModal = false;
    public $unitIdToDelete;

    protected $listeners = [
        'unit-created' => 'refreshUnits',
        'unit-edited' => 'refreshUnits',
        'unit-deleted' => 'refreshUnits',
    ];

    public function refreshUnits()
    {
        // Reset pagination setelah refresh
        $this->resetPage();
    }

    public function confirmDelete($unitId)
    {
        $this->unitIdToDelete = $unitId;
        $this->showDeleteModal = true;
    }

    public function deleteUnit()
    {
        if ($this->unitIdToDelete) {
            Units::find($this->unitIdToDelete)->delete();
            session()->flash('message', 'Unit berhasil dihapus.');
            $this->dispatch('unit-deleted');
        }

        $this->showDeleteModal = false;
        $this->unitIdToDelete = null;
    }

    public function render()
    {
        $units = Units::when($this->search, function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%')
            ->orWhere('code', 'like', '%' . $this->search . '%');
        })
        ->with('unitType')
        ->orderBy('created_at', 'desc')
        ->paginate(10);

        return view('livewire.units.index', [
            'units' => $units
        ]);
    }
}
