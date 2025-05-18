<?php

namespace App\Livewire\Position;

use App\Models\Position;
use Masmerise\Toaster\Toaster;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Create extends Component
{
    public $position, $description;
    public $is_deleted = 0;
    public $showAddPositionModal = false;

    protected $listeners = [
        'positionCreated' => 'refreshPositions',
    ];

    protected $rules = [
        'position' => 'required|string|max:255',
        'description' => 'nullable|string|max:255',
        'is_deleted' => 'boolean',
    ];

    public function mount()
    {
        $this->position = '';
        $this->description = '';
        $this->is_deleted = 0;
    }

    public function createPosition()
    {
        $this->validate();

        Position::create([
            'position' => $this->position,
            'description' => $this->description,
            'is_deleted' => $this->is_deleted,
        ]);

        $this->showAddPositionModal = false;

        $this->dispatch('positionCreated');
        Toaster::success('Position added successfully!');
    }

    public function render()
    {
        return view('livewire.position.create');
    }
}
