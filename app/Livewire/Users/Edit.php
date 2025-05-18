<?php

namespace App\Livewire\Users;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Masmerise\Toaster\Toaster;
use Spatie\Permission\Models\Role;
use Livewire\Attributes\On;
use Flux\Flux;
use Livewire\Component;


class Edit extends Component
{

    public $userId;
    public $name, $email, $password, $password_confirmation;
    public $status;
    public $roles = []; // Inisialisasi dengan array kosong
    public $selectedRoles = [];
    public $user_type;
    public $showEditUserModal = false;

    protected $listeners = [
        'userEdited' =>'refreshUsers',
    ];

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'user_type' => 'required|string',
        'status' => 'required|in:active,inactive',
        'password' => 'required|string|min:8|confirmed',
    ];

    public function mount()
    {
        // Inisialisasi roles
        $this->roles = Role::all();
    }

    #[On('edit')]
    public function editUser($userId)
    {
        // dd($userId);
        $this->resetValidation();

        $user = User::findOrFail($userId);
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->status = $user->is_active ? 'active' : 'inactive';
        $this->password = '';
        $this->password_confirmation = '';

        // Get user's current roles
        $this->selectedRoles = $user->roles->pluck('name')->toArray();
        $this->user_type = count($this->selectedRoles) > 0 ? $this->selectedRoles[0] : 'user';

        $this->roles = Role::all();

        $this->showEditUserModal = true;
        Flux::modal('edit-user')->show();
    }

    public function updateUser(){
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->userId)],
            'user_type' => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);

        // Konversi nilai status menjadi boolean untuk is_active
        $is_active = $this->status === 'active' ? 1 : 0;

        $user = User::find($this->userId);
        $user->name = $this->name;
        $user->email = $this->email;
        $user->is_active = $is_active;

        // Hanya update password jika diisi
        if (!empty($this->password)) {
            $this->validate([
                'password' => 'required|string|min:8|confirmed',
            ]);
            $user->password = Hash::make($this->password);
        }

        $user->save();

        // Assign role sesuai user_type yang dipilih
        if (!empty($this->user_type)) {
            $user->syncRoles([$this->user_type]);
        }

        $this->showEditUserModal = false;
        $this->dispatch('userEdited');
        Toaster::success('User updated successfully!');
    }

    public function render()
    {
        if ($this->roles === null) {
            $this->roles = Role::all();
        }

        return view('livewire.users.edit');
    }
}
