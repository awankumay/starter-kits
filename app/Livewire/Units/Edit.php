<?php

namespace App\Livewire\Units;

use App\Models\Units;
use App\Models\UnitType;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Edit extends Component
{
    use WithFileUploads;

    public $showEditModal = false;
    public $unit;
    public $unitId;

    // Form fields
    public $code_unit;
    public $name;
    public $typeUnits;
    public $location;
    public $fuelType;
    public $operator;
    public $description;
    public $image_unit;
    public $old_image;

    protected $rules = [
        'code_unit' => 'required',
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
            'old_image',
            'unitId'
        ]);

        $this->resetValidation();
    }

    public function edit($id)
    {
        $this->resetForm();
        $this->unitId = $id;
        $this->unit = Units::findOrFail($id);
        $this->code_unit = $this->unit->code;
        $this->name = $this->unit->name;
        $this->typeUnits = $this->unit->unit_type_id;
        $this->location = $this->unit->location;
        $this->fuelType = $this->unit->fuel_type;
        $this->operator = $this->unit->operator;
        $this->description = $this->unit->description;
        $this->old_image = $this->unit->image_unit;

        $this->showEditModal = true;
    }

    public function updateUnit()
    {
        $this->rules['code_unit'] = 'required|unique:units,code,'.$this->unitId;
        $this->validate();

        try {
            $unit = Units::findOrFail($this->unitId);

            $imagePath = $this->old_image;

            if ($this->image_unit) {
                // Hapus image lama jika ada
                if ($this->old_image && Storage::disk('public')->exists($this->old_image)) {
                    Storage::disk('public')->delete($this->old_image);
                }

                // Simpan image baru
                $imagePath = $this->image_unit->store('units', 'public');
            }

            $unit->update([
                'code' => $this->code_unit,
                'name' => $this->name,
                'unit_type_id' => $this->typeUnits,
                'location' => $this->location,
                'fuel_type' => $this->fuelType,
                'operator' => $this->operator,
                'description' => $this->description,
                'image_unit' => $imagePath,
            ]);

            $this->dispatch('unit-edited');
            $this->showEditModal = false;
            session()->flash('message', 'Unit berhasil diperbarui.');

        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $unitTypes = UnitType::all();
        return view('livewire.units.edit', compact('unitTypes'));
    }
}
