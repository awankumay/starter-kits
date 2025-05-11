<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;

class UserIndex extends Component
{
    use WithPagination;
    // use Toaster; // Add the Toaster trait

    public $users;

    // Add User form properties
    public $name = '';
    public $email = '';
    public $role = '';
    public $status = 'active'; // Default to active
    public $password = '';
    public $password_confirmation = '';

    // Edit User form properties
    public $editUserId;
    public $editUser;
    public $newPassword;

    // Search and delete properties
    public $search = '';
    public $userIdToDelete;
    public $showDeleteModal = false;
    public $showAddUserModal = false;
    public $showEditUserModal = false;

    protected $listeners = ['deleteConfirmed' => 'deleteUser'];

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

    public function mount()
    {
        $this->users = User::all();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

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

        // Reset form fields
        $this->reset(['name', 'email', 'role', 'password', 'password_confirmation']);
        $this->status = 'active'; // Reset to default

        // Update the users list
        $this->users = User::all();

        $this->showAddUserModal = false; // Tutup modal setelah berhasil tambah user
        Toaster::success('User added successfully!');
    }

    public function editUser($userId)
    {
        $this->editUserId = $userId;
        $this->editUser = User::find($userId);
        $this->newPassword = '';
        $this->showEditUserModal = true;

        dd($this->editUser); // Debug: cek apakah data user berhasil diambil
    }

    public function updateUser()
    {
        $this->validate($this->editRules);

        $userWithSameEmail = User::where('email', $this->editUser->email)
            ->where('id', '!=', $this->editUser->id)
            ->first();

        if ($userWithSameEmail) {
            $this->addError('editUser.email', 'The email has already been taken.');
            return;
        }

        if ($this->newPassword) {
            $this->validate([
                'newPassword' => ['required', Password::defaults()],
            ]);
            $this->editUser->password = Hash::make($this->newPassword);
        }

        $this->editUser->save();
        $this->users = User::all();

        $this->showEditUserModal = false; // Tutup modal setelah update
        Toaster::success('User updated successfully!');
    }

    public function confirmDelete($userId)
    {
        $this->userIdToDelete = $userId;
        $this->showDeleteModal = true;
    }

    public function deleteUser()
    {
        $user = User::find($this->userIdToDelete);

        if ($user) {
            $user->delete();
            $this->users = User::all();
            Toaster::success('User deleted successfully!');
        } else {
            Toaster::error('User not found!');
        }

        $this->showDeleteModal = false; // Tutup modal setelah proses selesai
    }

    public function render()
    {
        $users = User::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.users.user-index', [
            'users' => $users
        ]);
    }
}
