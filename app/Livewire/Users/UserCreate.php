<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Masmerise\Toaster\Toaster;
use Spatie\Permission\Models\Role;

/**
 * Komponen Livewire untuk menambah user baru.
 * Setelah user berhasil ditambah, akan mengirim event ke parent agar data user di-refresh.
 *
 * Perubahan:
 * - Pemilihan role user sekarang menggunakan dropdown user type yang mengambil data dari database.
 * - Properti dan logika terkait checkbox role dihapus.
 * - Role user di-assign sesuai dengan user type yang dipilih.
 */
class UserCreate extends Component
{
    public $name = '';
    public $email = '';
    public $user_type = 'user'; // Default ke user
    public $status = 'active'; // Default ke active
    public $password = '';
    public $password_confirmation = '';
    public $showAddUserModal = false;

    // Role list untuk dropdown
    public $roles = [];

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'user_type' => 'required|string',
        'password' => 'required|string|min:8|confirmed',
    ];

    public function mount()
    {
        $this->roles = Role::all();
    }

    public function createUser()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'status' => $this->status,
        ]);

        // Assign role sesuai user_type yang dipilih
        if (!empty($this->user_type)) {
            $user->assignRole($this->user_type);
        } else {
            $user->assignRole('user');
        }

        $this->reset(['name', 'email', 'user_type', 'password', 'password_confirmation']);
        $this->status = 'active';
        $this->showAddUserModal = false;

        $this->dispatch('userCreated');
        Toaster::success('User added successfully!');
    }

    public function render()
    {
        return view('livewire.users.user-create');
    }
}
