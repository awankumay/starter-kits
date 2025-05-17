<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Masmerise\Toaster\Toaster;
use Spatie\Permission\Models\Role;

class Create extends Component
{
    public $name, $email, $password, $password_confirmation;
    public $user_type = 'user';
    public $status = 'active'; // default status aktif
    public $showAddUserModal = false;
    public $roles = [];

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'user_type' => 'required|string',
        'status' => 'required|in:active,inactive',
        'password' => 'required|string|min:8|confirmed',
    ];

    public function mount()
    {
        $this->roles = Role::all();
    }

    public function createUser()
    {
        $this->validate();

        // Konversi nilai status menjadi boolean untuk is_active
        $is_active = $this->status === 'active' ? 1 : 0;

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'is_active' => $is_active,
            'is_deleted' => 0 // Default untuk user baru
        ]);

        // Assign role sesuai user_type yang dipilih
        if (!empty($this->user_type)) {
            $user->assignRole($this->user_type);
        } else {
            $user->assignRole('user');
        }

        $this->reset(['name', 'email', 'user_type', 'password', 'password_confirmation', 'status']);

        // $this->showAddUserModal = false;

        Toaster::success('User added successfully!');
    }

    public function render()
    {
        return view('livewire.users.create');
    }
}
