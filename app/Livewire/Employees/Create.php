<?php

namespace App\Livewire\Employees;

use App\Models\Employee;
use App\Models\Position;
use Livewire\WithFileUploads;
use Masmerise\Toaster\Toaster;

use Livewire\Component;

class Create extends Component
{
    use WithFileUploads;

    public $employeeId;
    public $employee_number, $name, $email, $phone, $photo, $join_date;
    public $is_active = 1;
    public $showCreateEmployeeModal = false;
    public $positions = []; // Initialize as empty array
    public $position_id;

    public function mount()
    {
        // Get all positions as a collection (not array)
        $this->positions = Position::all();
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'employee_number' => 'required|unique:employees,employee_number',
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'photo' => 'nullable|image|max:1024', // Made photo optional
            'join_date' => 'required|date',
            'position_id' => 'required|exists:positions,id',
        ]);
    }
    public function createEmployee()
    {
        $this->validate([
            'employee_number' => 'required|unique:employees,employee_number',
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'photo' => 'nullable|image|max:1024', // Made photo optional
            'join_date' => 'required|date',
            'position_id' => 'required|exists:positions,id',
        ]);

        $employee = new Employee();
        $employee->employee_number = $this->employee_number;
        $employee->name = $this->name;
        $employee->email = $this->email;
        $employee->phone = $this->phone;
        $employee->position_id = $this->position_id;
        if ($this->photo) {
            $employee->photo = $this->photo->store('photos', 'public');
        }
        $employee->join_date = $this->join_date;
        $employee->is_active = $this->is_active;
        $employee->save();

        session()->flash('message', 'Employee created successfully.');
        $this->reset();
    }
    public function resetFields()
    {
        $this->employeeId = null;
        $this->employee_number = '';
        $this->name = '';
        $this->email = '';
        $this->phone = '';
        $this->photo = '';
        $this->join_date = '';
        $this->is_active = 1;
        $this->position_id = '';
    }

    public function render()
    {
        // Ensure positions is never null when rendering
        if (!$this->positions) {
            $this->positions = Position::all();
        }

        return view('livewire.employees.create', [
            'positions' => $this->positions,
        ]);
    }
}
