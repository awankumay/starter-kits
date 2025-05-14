<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Units;
use App\Models\Fuel;
// Import model lain yang diperlukan, contoh:
// use App\Models\Request;
// use App\Models\FuelExpense;
// use App\Models\Employee;
use Livewire\Component;

class Dashboard extends Component
{
    public int $totalUsersRegistration = 0;
    public int $totalFuel = 0;
    public int $totalUnits = 0;
    // Siapkan variabel untuk statistik lainnya
    // public int $totalEmployees = 0;
    // public int $totalRequests = 0;
    // public float $totalFuelExpense = 0;

    // Interval polling berbeda untuk setiap jenis data
    protected $userRefreshInterval = 10; // dalam detik
    // protected $requestRefreshInterval = 5; // data request refresh lebih cepat
    // protected $fuelExpenseRefreshInterval = 30; // data expense jarang berubah

    public function mount()
    {
        $this->refreshUserData();
        // $this->refreshRequestData();
        // $this->refreshFuelExpenseData();
        // $this->refreshEmployeeData();
    }

    public function refreshUserData()
    {
        $this->totalUsersRegistration = User::count();
        $this->totalUnits = Units::count();
        $this->totalFuel = Fuel::count();
    }

    // Method terpisah untuk setiap jenis data
    // public function refreshRequestData()
    // {
    //     $this->totalRequests = Request::count();
    // }

    // public function refreshFuelExpenseData()
    // {
    //     $this->totalFuelExpense = FuelExpense::sum('amount');
    // }

    // public function refreshEmployeeData()
    // {
    //     $this->totalEmployees = Employee::count();
    // }

    public function render()
    {
        return view('dashboard');
    }
}
