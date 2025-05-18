<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use Masmerise\Toaster\Toaster;
use Spatie\Permission\Models\Role;

class Index extends Component
{
    public $search = '';
    public $userIdToDelete;
    public $showDeleteModal = false;

    // Gunakan dispatch (Livewire v3) alih-alih emit
    protected $listeners = [
        'userDeleted' => 'refreshUsers',
        'userCreated' => 'refreshUsers',
        'userEdited' => 'refreshUsers',
    ];

    public function refreshUsers()
    {
        $this->resetPage();
        $this->showDeleteModal = false;
    }

    public function edit($userId)
    {
        // dd($userId);
        $this->dispatch('edit', $userId);

    }

    public function confirmDelete($userId)
    {
        $this->userIdToDelete = $userId;
        $this->showDeleteModal = true;
    }

    /**
     * Menghapus user (soft delete)
     */
    public function deleteUser()
    {
        $user = User::find($this->userIdToDelete);

        if (!$user) {
            Toaster::error('Pengguna tidak ditemukan!');
            return;
        }

        // Melakukan soft delete
        $user->update(['is_deleted' => 1]);

        $this->showDeleteModal = false;
        $this->dispatch('userDeleted');
        Toaster::success('Pengguna berhasil dihapus!');
    }

    public function render()
    {
        $users = User::query()
            ->where('is_deleted', 0) // Hanya tampilkan user yang belum dihapus
            ->where(function($query) {
                $query->where('name', 'like', '%'.$this->search.'%')
                    ->orWhere('email', 'like', '%'.$this->search.'%');
            })->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.users.index', [
            'users' => $users
        ]);
    }
}
