<?php

namespace App\Livewire\UnitTypes;
use App\Models\UnitType;
use Flux\Flux;
use Masmerise\Toaster\Toaster;
use Spatie\Permission\Models\Role;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Validation\Rule;

class Edit extends Component
{
    public $type, $brand, $description;
    public $is_deleted = 0;
    public $showEditTypeModal = false;
    public $unitTypeId;

    protected $listeners = [
        'unitTypeEdit' => 'refreshUnitTypes', // Listener untuk event dari UnitTypeEdit
    ];

    protected $rules = [
        'type' => 'required|string|max:255',
        'brand' => 'required|string|max:255',
        'description' => 'nullable|string|max:255',
        'is_deleted' => 'boolean',
    ];

    #[On('edit')]
    public function editUnitType($unitType)
    {
        $this->resetValidation();

        $unitType = UnitType::findOrFail($unitType);
        $this->unitTypeId = $unitType->id;
        $this->type = $unitType->type;
        $this->brand = $unitType->brand;
        $this->description = $unitType->description;
        $this->is_deleted = $unitType->is_deleted;
        $this->showEditTypeModal = true;
        Flux::modal('edit-types')->show();
    }

    public function updateUnitType()
    {
        $this->validate([
            'type' => [
                'required',
                'string',
                'max:255',
                Rule::unique('unit_types')->ignore($this->unitTypeId),
            ],
            'brand' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);
        $unitType = UnitType::find($this->unitTypeId);
        $unitType->type = $this->type;
        $unitType->brand = $this->brand;
        $unitType->description = $this->description;
        $unitType->is_deleted = $this->is_deleted;
        $unitType->save();
        $this->dispatch('unitTypeEdit');
        Toaster::success('Unit Type updated successfully.');
        $this->showEditTypeModal = false;
    }

    public function render()
    {
        return view('livewire.unit-types.edit');
    }
}
