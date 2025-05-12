<?php

namespace App\Livewire\Units;

use App\Models\Units;
use App\Models\UnitType;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Create extends Component
{
    use WithFileUploads;

    public $showAddUnitModal = false;

    // Form fields
    public $code_unit;
    public $name;
    public $typeUnits;
    public $location;
    public $fuelType;
    public $operator;
    public $description;
    public $image_unit;

    protected $rules = [
        'code_unit' => 'required|unique:units,code',
        'name' => 'required',
        'typeUnits' => 'required|exists:unit_types,id',
        'location' => 'required',
        'fuelType' => 'nullable',
        'operator' => 'required',
        'description' => 'nullable',
        'image_unit' => 'nullable|image|max:1024',
    ];

    protected $messages = [
        'code_unit.required' => 'Kode unit tidak boleh kosong',
        'code_unit.unique' => 'Kode unit sudah digunakan',
        'name.required' => 'Nama unit tidak boleh kosong',
        'typeUnits.required' => 'Tipe unit tidak boleh kosong',
        'typeUnits.exists' => 'Tipe unit tidak valid',
        'location.required' => 'Lokasi tidak boleh kosong',
        'operator.required' => 'Operator tidak boleh kosong',
        'image_unit.image' => 'File harus berupa gambar',
        'image_unit.max' => 'Ukuran gambar maksimal 1MB',
    ];

    public function mount()
    {
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->reset([
            'code_unit',
            'name',
            'typeUnits',
            'location',
            'fuelType',
            'operator',
            'description',
            'image_unit',
        ]);

        $this->resetValidation();
    }

    public function createUnit()
    {
        $this->validate();

        try {
            $imagePath = null;

            if ($this->image_unit) {
                $imagePath = $this->image_unit->store('units', 'public');
            }

            Units::create([
                'code' => $this->code_unit,
                'name' => $this->name,
                'unit_type_id' => $this->typeUnits,
                'location' => $this->location,
                'fuel_type' => $this->fuelType,
                'operator' => $this->operator,
                'description' => $this->description,
                'image_unit' => $imagePath,
            ]);

            $this->dispatch('unit-created');
            $this->showAddUnitModal = false;
            $this->resetForm();
            session()->flash('message', 'Unit berhasil ditambahkan.');

        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $unitTypes = UnitType::all();
        return view('livewire.units.create', compact('unitTypes'));
    }
}
