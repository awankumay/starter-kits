<?php

namespace App\Livewire\Position;

use App\Models\Position;
use Masmerise\Toaster\Toaster;
use Livewire\Component;

class Edit extends Component
{
    public $showEditPositionModal = false;
    public $positionId;
    public $position;
    public $description;

    protected $listeners = [
        'edit' => 'loadPosition',
    ];

    protected $rules = [
        'position' => 'required|string|max:255',
        'description' => 'nullable|string|max:255',
    ];

    public function loadPosition($positionId)
    {
        $position = Position::findOrFail($positionId);
        $this->positionId = $position->id;
        $this->position = $position->position;
        $this->description = $position->description;
        $this->showEditPositionModal = true;
    }

    public function updatePosition()
    {
        $this->validate();

        $position = Position::findOrFail($this->positionId);
        $position->update([
            'position' => $this->position,
            'description' => $this->description,
        ]);

        $this->showEditPositionModal = false;
        $this->dispatch('positionEdit');
        Toaster::success('Position updated successfully!');
    }

    public function render()
    {
        return view('livewire.position.edit');
    }
}
