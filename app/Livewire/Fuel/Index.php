<?php

namespace App\Livewire\Fuel;

use App\Models\Fuel;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $showDeleteModal = false;
    public $fuelIdToDelete;

    public function mount()
    {
        //
    }

    public function render()
    {
        $fuels = Fuel::when($this->search, function ($query) {
                $query->where('request_number', 'like', '%' . $this->search . '%')
                    ->orWhere('fuels_type', 'like', '%' . $this->search . '%')
                    ->orWhere('location', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.fuel.index', [
            'fuels' => $fuels
        ]);
    }

    public function confirmDelete($id)
    {
        $this->fuelIdToDelete = $id;
        $this->showDeleteModal = true;
    }

    public function deleteFuel()
    {
        $fuel = Fuel::find($this->fuelIdToDelete);
        if ($fuel) {
            $fuel->delete();
            session()->flash('message', 'Fuel request successfully deleted.');
        }

        $this->showDeleteModal = false;
        $this->fuelIdToDelete = null;
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }
}
