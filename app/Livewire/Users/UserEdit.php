<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Masmerise\Toaster\Toaster;
use Spatie\Permission\Models\Role;
use Livewire\Attributes\On;
use Flux\Flux;
use Illuminate\Validation\Rule;

class UserEdit extends Component
{
    public $userId;
    public $name;
    public $email;
    public $user_type;
    public $status;
    public $password;
    public $password_confirmation;
    public $showEditUserModal = false;

    public $roles = [];
    public $selectedRoles = [];

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
        'status' => 'nullable|string',
        'password' => 'nullable|string|min:8|confirmed',
    ];

    public function mount()
    {
        $this->roles = Role::all();
    }

    #[On('edit')]
    public function editUser($userId)
    {
        $this->resetValidation();

        $user = User::findOrFail($userId);
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->status = $user->status;
        $this->password = '';
        $this->password_confirmation = '';

        // Get user's current roles
        $this->selectedRoles = $user->roles->pluck('name')->toArray();
        $this->user_type = count($this->selectedRoles) > 0 ? $this->selectedRoles[0] : 'user';

        $this->showEditUserModal = true;
        Flux::modal('edit-user')->show();
    }

    public function updateUser()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->userId)],
            'user_type' => 'required|string',
        ]);

        $user = User::findOrFail($this->userId);
        $user->name = $this->name;
        $user->email = $this->email;
        $user->status = $this->status;

        if ($this->password && $this->password_confirmation) {
            $this->validate([
                'password' => ['required', 'confirmed', Password::defaults()],
            ]);
            $user->password = Hash::make($this->password);
        }

        $user->save();

        // Sync roles
        $user->syncRoles([$this->user_type]);

        $this->showEditUserModal = false;
        $this->reset(['password', 'password_confirmation']);

        $this->dispatch('userUpdated');
        Toaster::success('User updated successfully!');
    }

    public function render()
    {
        return view('livewire.users.user-edit');
    }
}
