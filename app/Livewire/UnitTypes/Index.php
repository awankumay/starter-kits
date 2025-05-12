<?php

namespace App\Livewire\UnitTypes;
use App\Models\UnitType;
use Masmerise\Toaster\Toaster;
use Spatie\Permission\Models\Role;

use Livewire\Component;

class Index extends Component
{
    public $type;
    public $brand;
    public $description;
    public $is_deleted = 0;
    public $showAddTypeModal = false;
    public $search = '';
    public $unitTypeIdToDelete;
    public $showDeleteModal = false;

    protected $listeners = [
        'unitTypeCreated' => 'refreshUnitTypes',
        'unitTypeEdit' => 'refreshUnitTypes', // Listener untuk event dari UnitTypeEdit
        'unitTypeDeleted' => 'refreshUnitTypes', // Listener untuk event dari UnitTypeDelete
    ];

    protected $rules = [
        'type' => 'required|string|max:255',
        'brand' => 'required|string|max:255',
        'description' => 'nullable|string|max:255',
        'is_deleted' => 'boolean',
    ];

    public function mount()
    {
        $this->unitTypes = UnitType::all();
    }

    // public function updatedSearch()
    // {
    //     $this->unitTypes = UnitType::where('type', 'like', '%' . $this->search . '%')
    //         ->orWhere('brand', 'like', '%' . $this->search . '%')
    //         ->orWhere('description', 'like', '%' . $this->search . '%')
    //         ->get();
    // }

    public function refreshUnitTypes()
    {
        $this->unitTypes = UnitType::all();
        $this->showAddTypeModal = false;
    }

    public function confirmDelete($unitTypeId)
    {
        $this->unitTypeIdToDelete = $unitTypeId;
        $this->showDeleteModal = true;
    }

    public function deleteUnitType()
    {
        $unitType = UnitType::find($this->unitTypeIdToDelete);
        if ($unitType) {
            $unitType->delete();
            Toaster::success('Unit Type deleted successfully.');
        } else {
            Toaster::error('Unit Type not found.');
        }

        $this->showDeleteModal = false;
        $this->unitTypeIdToDelete = null;
        $this->refreshUnitTypes();
    }

    public function edit($unitType)
    {
        $this->dispatch('edit', $unitType);
    }

    public function render()
    {
        $unitTypes = UnitType::query()
            ->when($this->search, function ($query) {
                $query->where('type', 'like', '%' . $this->search . '%')
                    ->orWhere('brand', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.unit-types.index', [
            'unitTypes' => $unitTypes
        ]);
    }
}
