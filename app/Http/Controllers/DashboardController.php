<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Units;
use App\Models\Fuel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsersRegistration = User::count();

        $totalUnits = Units::count();

        $totalFuel = Fuel::count();

        dd($totalUsersRegistration, $totalUnits, $totalFuel);

        $totalEmployees = 0; // Tambahkan perhitungan jumlah pegawai sesuai model Anda

        $totalFuelExpense = 0; // Tambahkan perhitungan total pengeluaran BBM

        return view('dashboard', [
            // 'totalUsersRegistration' => $totalUsersRegistration,
            'totalUnits' => $totalUnits,
            'totalFuel' => $totalFuel,
            'totalEmployees' => $totalEmployees,
            'totalFuelExpense' => $totalFuelExpense
        ]);
    }
}
