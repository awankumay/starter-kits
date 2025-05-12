<?php

namespace App\Livewire\Fuel;

use App\Models\Fuel;
use App\Models\Units;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{
    use WithFileUploads;

    public $showAddFuelModal = false;
    public $operations_unit_id;
    public $request_date;
    public $fuels_type;
    public $volume;
    public $location;
    public $notes;
    public $fuels_indicator_photo;
    public $units = [];

    protected $rules = [
        'operations_unit_id' => 'required',
        'request_date' => 'required|date',
        'fuels_type' => 'required|string',
        'volume' => 'required|numeric|min:0',
        'location' => 'required|string',
        'notes' => 'nullable|string',
        'fuels_indicator_photo' => 'nullable|image|max:1024', // max 1MB
    ];

    public function mount()
    {
        $this->units = Units::all();
        $this->request_date = now()->format('Y-m-d');
    }

    public function render()
    {
        return view('livewire.fuel.create');
    }

    public function createFuel()
    {
        $this->validate();

        $photoPath = null;
        if ($this->fuels_indicator_photo) {
            $photoPath = $this->fuels_indicator_photo->store('fuels_indicators', 'public');
        }

        Fuel::create([
            'request_number' => Fuel::generateRequestNumber(),
            'operations_unit_id' => $this->operations_unit_id,
            'request_date' => $this->request_date,
            'fuels_type' => $this->fuels_type,
            'volume' => $this->volume,
            'location' => $this->location,
            'notes' => $this->notes,
            'fuels_indicator_photo' => $photoPath,
            'requested_by' => Auth::id(),
            'status' => Fuel::STATUS_PENDING,
        ]);

        $this->reset(['operations_unit_id', 'request_date', 'fuels_type', 'volume', 'location', 'notes', 'fuels_indicator_photo']);
        $this->showAddFuelModal = false;
        $this->dispatch('fuelCreated');

        session()->flash('message', 'Fuel request created successfully.');
    }
}
