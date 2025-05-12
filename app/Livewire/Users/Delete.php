<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use Masmerise\Toaster\Toaster;

class Delete extends Component
{
    public $userId;
    public $showDeleteModal = false;

    public function confirmDelete($userId)
    {
        $this->userId = $userId;
        $this->showDeleteModal = true;
    }

    public function deleteUser()
    {
        $user = User::find($this->userId);

        if (!$user) {
            Toaster::error('User tidak ditemukan!');
            return;
        }

        // Menggunakan soft delete dengan mengubah is_deleted menjadi 1
        $user->softDelete();
        // atau bisa juga dengan $user->update(['is_deleted' => 1]);

        $this->showDeleteModal = false;
        $this->dispatch('userDeleted');
        Toaster::success('User berhasil dihapus!');
    }

    public function render()
    {
        return view('livewire.users.delete');
    }
}
