<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Masmerise\Toaster\Toaster;

/**
 * Komponen Livewire untuk menambah user baru.
 * Setelah user berhasil ditambah, akan mengirim event ke parent agar data user di-refresh.
 */
class UserCreate extends Component
{
    public $users;

    // Add User form properties
    public $name = '';
    public $email = '';
    public $role = '';
    public $status = 'active'; // Default to active
    public $password = '';
    public $password_confirmation = '';
    public $showAddUserModal = false;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            // 'role' => 'required|string',
            // 'status' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    protected $editRules = [
        'editUser.name' => 'required|string|max:255',
        'editUser.email' => 'required|string|email|max:255',
        // 'editUser.role' => 'required|string',
        // 'editUser.status' => 'required|string',
    ];

    public function createUser()
    {
        $validatedData = $this->validate();

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            // 'role' => $this->role,
            // 'status' => $this->status,
        ]);

        $this->reset(['name', 'email', 'role', 'password', 'password_confirmation']);
        $this->status = 'active';

        $this->showAddUserModal = false;

        // Gunakan dispatch untuk mengirim event ke parent pada Livewire v3
        $this->dispatch('userCreated');

        Toaster::success('User added successfully!');
    }

    public function render()
    {
        return view('livewire.users.user-create');
    }
}
