<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;
use Spatie\Permission\Models\Role;

class Index extends Component
{
    public $users;
    public $search = '';
    public $userIdToDelete;
    public $showDeleteModal = false;

    protected $listeners = [
        'userCreated' => 'refreshUsers',
        'userUpdated' => 'refreshUsers',
        'userDeleted' => 'refreshUsers'
    ];

    public function render()
    {
        $users = User::query()
            ->where('name', 'like', '%'.$this->search.'%')
            ->orWhere('email', 'like', '%'.$this->search.'%')
            ->paginate(10);

        return view('livewire.users.index', compact('users'));
    }
}
