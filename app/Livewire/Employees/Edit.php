<?php

namespace App\Livewire\Employees;

use App\Models\Employee;
use App\Models\Position;
use Livewire\Component;
use Livewire\WithFileUploads;
use Masmerise\Toaster\Toaster;
use Livewire\Attributes\On;
use Flux\Flux;

class Edit extends Component
{
    use WithFileUploads;

    public $employeeId = null;
    public $employee_number, $name, $email, $phone, $photo, $join_date;
    public $is_active = 1;
    public $showEditEmployeeModal = false;
    public $positions;
    public $position_id;

    public function mount($employeeId = null)
    {
        $this->employeeId = $employeeId;
        $this->positions = Position::all();
        $this->loadEmployeeData();
    }

    #[On('edit')]
    public function loadEmployeeData()
    {
        $employee = Employee::findOrFail($this->employeeId);
        $this->employee_number = $employee->employee_number;
        $this->name = $employee->name;
        $this->email = $employee->email;
        $this->phone = $employee->phone;
        $this->join_date = $employee->join_date;
        $this->is_active = $employee->is_active;
        $this->position_id = $employee->position_id;
        // tambahkan field lain jika perlu
    }

    public function updateEmployee()
    {
        $this->validate([
            'employee_number' => 'required|unique:employees,employee_number,' . $this->employeeId,
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'join_date' => 'required|date',
            'position_id' => 'required|exists:positions,id',
        ]);

        $employee = Employee::findOrFail($this->employeeId);
        $employee->employee_number = $this->employee_number;
        $employee->name = $this->name;
        $employee->email = $this->email;
        $employee->phone = $this->phone;
        $employee->join_date = $this->join_date;
        $employee->is_active = $this->is_active;
        $employee->position_id = $this->position_id;
        $employee->save();

        session()->flash('message', 'Employee updated successfully.');
        // bisa tambahkan reset atau close modal
    }

    public function render()
    {
        return view('livewire.employees.edit');
    }
}
