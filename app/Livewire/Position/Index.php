<?php

namespace App\Livewire\Position;

use App\Models\Position;
use Masmerise\Toaster\Toaster;
use Livewire\Component;

class Index extends Component
{
    public $position, $description;
    public $is_deleted = 0;
    public $showAddPositionModal = false;
    public $search = '';
    public $positionIdToDelete;
    public $showDeleteModal = false;

    protected $listeners = [
        'positionCreated' => 'refreshPositions',
        'positionEdit' => 'refreshPositions',
        'positionDeleted' => 'refreshPositions',
    ];

    protected $rules = [
        'position' => 'required|string|max:255',
        'description' => 'nullable|string|max:255',
        'is_deleted' => 'boolean',
    ];

    public function mount()
    {
        $this->positions = Position::all();
    }

    public function refreshPositions()
    {
        $this->positions = Position::all();
        $this->showAddPositionModal = false;
    }

    public function confirmDelete($positionId)
    {
        $this->positionIdToDelete = $positionId;
        $this->showDeleteModal = true;
    }

    public function deletePosition()
    {
        $position = Position::find($this->positionIdToDelete);
        if ($position) {
            $position->delete();
            Toaster::success('Position deleted successfully.');
        } else {
            Toaster::error('Position not found.');
        }

        $this->showDeleteModal = false;
        $this->positionIdToDelete = null;
        $this->refreshPositions();
    }

    public function edit($positionId)
    {
        $this->dispatch('edit', $positionId);
        // dd($positionId);
    }

    public function render()
    {
        $positions = Position::query()
            ->when($this->search, function ($query) {
                $query->where('position', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.position.index', [
            'positions' => $positions
        ]);
    }
}
