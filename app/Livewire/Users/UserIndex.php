<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;
use Spatie\Permission\Models\Role;

class UserIndex extends Component
{
    use WithPagination;

    public $users;
    public $search = '';
    public $userIdToDelete;
    public $showDeleteModal = false;

    protected $listeners = [
        'userCreated' => 'refreshUsers',
        'userUpdated' => 'refreshUsers',
        'userDeleted' => 'refreshUsers'
    ];

    public function mount()
    {
        $this->users = User::all();
    }

    public function updatedSearch()
    {
        $this->resetPage();
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

        $this->showDeleteModal = false;
        $this->dispatch('userDeleted');
    }

    public function refreshUsers()
    {
        $this->users = User::all();
    }

    public function edit($userId)
    {
        $this->dispatch('edit', $userId);
    }

    public function render()
    {
        $users = User::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.users.user-index', [
            'users' => $users
        ]);
    }
}
