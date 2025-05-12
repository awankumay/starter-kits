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
    public $name, $email, $password, $password_confirmation, $is_active, $is_deleted;
    public $user_type = 'user';
    public $showAddUserModal = false;
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
        ]);

        // Assign role sesuai user_type yang dipilih
        if (!empty($this->user_type)) {
            $user->assignRole($this->user_type);
        } else {
            $user->assignRole('user');
        }

        $this->reset(['name', 'email', 'user_type', 'password', 'password_confirmation']);

        $this->showAddUserModal = false;

        $this->dispatch('userCreated');
        Toaster::success('User added successfully!');
    }

    public function render()
    {
        return view('livewire.users.create');
    }
}
