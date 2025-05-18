<?php

namespace App\Livewire\Employees;

use App\Models\Employee;
use Livewire\Component;

class Index extends Component
{
    public $employee_number, $name, $email, $phone, $photo, $join_date;
    public $is_active = 1;
    public $showAddEmployeeModal = false;
    public $search = '';
    public $employeeIdToDelete;
    public $showDeleteModal = false;
    public $employees = [];
    public $showEditEmployeeModal = false;

    protected $listeners = [
        'employeeCreated' => 'refreshEmployees',
        'employeeEdit' => 'refreshEmployees',
        'employeeDeleted' => 'refreshEmployees',
    ];
    protected $rules = [
        'employee_number' => 'required|string|max:255',
        'name' => 'required|string|max:255',
        'email' => 'nullable|email|max:255',
        'phone' => 'nullable|string|max:255',
        'join_date' => 'nullable|date',
        'photo' => 'nullable|image|max:1024', // 1MB Max
        'is_active' => 'boolean',
    ];
    public function mount()
    {
        $this->employees = Employee::all();
    }
    public function refreshEmployees()
    {
        $this->employees = Employee::all();
        $this->showAddEmployeeModal = false;
    }
    public function confirmDelete($employeeId)
    {
        $this->employeeIdToDelete = $employeeId;
        $this->showDeleteModal = true;
    }
    public function deleteEmployee()
    {
        $employee = Employee::find($this->employeeIdToDelete);
        if ($employee) {
            $employee->delete();
            Toaster::success('Employee deleted successfully.');
        } else {
            Toaster::error('Employee not found.');
        }

        $this->showDeleteModal = false;
        $this->employeeIdToDelete = null;
        $this->refreshEmployees();
    }
    public function edit($employeeId)
    {
        $this->dispatch('edit', $employeeId);
    }


    public function render()
    {
        $employees = Employee::query()
            ->where('name', 'like', '%' . $this->search . '%')
            ->orWhere('employee_number', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->orWhere('phone', 'like', '%' . $this->search . '%')
            ->orWhere('join_date', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('livewire.employees.index', [
            'employees' => $employees
        ]);
    }
}
