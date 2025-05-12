<?php

namespace App\Livewire\Fuel;

use App\Models\Fuel;
use App\Models\Units;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public $showEditFuelModal = false;
    public $fuel;
    public $fuel_id;
    public $operations_unit_id;
    public $request_date;
    public $fuels_type;
    public $volume;
    public $location;
    public $status;
    public $notes;
    public $newFuelIndicatorPhoto;
    public $units = [];

    protected $listeners = ['editFuel' => 'edit'];

    protected function rules()
    {
        return [
            'operations_unit_id' => 'required',
            'request_date' => 'required|date',
            'fuels_type' => 'required|string',
            'volume' => 'required|numeric|min:0',
            'location' => 'required|string',
            'status' => 'required|string',
            'notes' => 'nullable|string',
            'newFuelIndicatorPhoto' => 'nullable|image|max:1024', // max 1MB
        ];
    }

    public function mount()
    {
        $this->units = Units::all();
    }

    public function render()
    {
        return view('livewire.fuel.edit');
    }

    public function edit($id)
    {
        $this->fuel = Fuel::findOrFail($id);
        $this->fuel_id = $id;
        $this->operations_unit_id = $this->fuel->operations_unit_id;
        $this->request_date = $this->fuel->request_date->format('Y-m-d');
        $this->fuels_type = $this->fuel->fuels_type;
        $this->volume = $this->fuel->volume;
        $this->location = $this->fuel->location;
        $this->status = $this->fuel->status;
        $this->notes = $this->fuel->notes;

        $this->showEditFuelModal = true;
    }

    public function updateFuel()
    {
        $this->validate();

        $fuel = Fuel::findOrFail($this->fuel_id);

        $photoPath = $fuel->fuels_indicator_photo;
        if ($this->newFuelIndicatorPhoto) {
            $photoPath = $this->newFuelIndicatorPhoto->store('fuels_indicators', 'public');
        }

        $fuel->update([
            'operations_unit_id' => $this->operations_unit_id,
            'request_date' => $this->request_date,
            'fuels_type' => $this->fuels_type,
            'volume' => $this->volume,
            'location' => $this->location,
            'status' => $this->status,
            'notes' => $this->notes,
            'fuels_indicator_photo' => $photoPath,
        ]);

        $this->reset(['newFuelIndicatorPhoto']);
        $this->showEditFuelModal = false;
        $this->dispatch('fuelUpdated');

        session()->flash('message', 'Fuel request updated successfully.');
    }
}
