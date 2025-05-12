<?php

namespace App\Livewire\UnitTypes;
use App\Models\UnitType;
use Masmerise\Toaster\Toaster;
use Spatie\Permission\Models\Role;

use Livewire\Component;

class Create extends Component
{

    public $type, $brand, $description;
    public $is_deleted = 0;
    public $showAddTypeModal = false;

    protected $listeners = [
        'unitTypeCreated' => 'refreshUnitTypes', // Listener untuk event dari UnitTypeCreate
    ];

    protected $rules = [
        'type' => 'required|string|max:255',
        'brand' => 'required|string|max:255',
        'description' => 'nullable|string|max:255',
        'is_deleted' => 'boolean',
    ];

    public function mount()
    {
        $this->type = '';
        $this->brand = '';
        $this->description = '';
        $this->is_deleted = 0;
    }

    public function createUnitType()
    {
        $this->validate();

        // Create the unit type
        UnitType::create([
            'type' => $this->type,
            'brand' => $this->brand,
            'description' => $this->description,
            'is_deleted' => $this->is_deleted,
        ]);

        $this->showAddTypeModal = false;

        $this->dispatch('unitTypeCreated');
        Toaster::success('Type added successfully!');
    }

    public function render()
    {
        return view('livewire.unit-types.create');
    }
}
