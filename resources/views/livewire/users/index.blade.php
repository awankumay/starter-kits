<div>
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Users') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('User Management Pages') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    <div class="flex justify-between items-center mb-4">
        <div class="relative flex space-x-2">
            {{-- Dropdown Action dengan FluxUI --}}
            <flux:dropdown>
                <flux:button icon:trailing="chevron-down">Action</flux:button>
                <flux:menu>
                    <flux:menu.item>Bulk Deactivate</flux:menu.item>
                    <flux:menu.item>Bulk Activate</flux:menu.item>
                    <flux:menu.separator />
                    <flux:menu.item variant="danger" icon="trash">Bulk Delete</flux:menu.item>
                </flux:menu>
            </flux:dropdown>

            {{-- Add New User --}}
            <flux:modal.trigger name="add-user">
                <flux:button variant="primary" icon:leading="plus">
                    Add User
                </flux:button>
            </flux:modal.trigger>
        </div>
        <div>
            <div class="relative">
                <flux:input
                    as="text"
                    placeholder="Search for users"
                    wire:model.live.debounce.300ms="search"
                    icon="magnifying-glass">
                </flux:input>
            </div>
        </div>
    </div>

    <div class="overflow-x-auto bg-white dark:bg-zinc-800/40 rounded-lg">
        <table class="table-custom">
            <thead>
                <tr>
                    <th class="checkbox-column">
                        <input type="checkbox"
                            class="rounded border-zinc-300 dark:border-zinc-600 text-blue-600 focus:ring-blue-500">
                    </th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Roles</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td class="checkbox-column">
                            <input type="checkbox" class="rounded border-zinc-300 dark:border-zinc-600 text-blue-600 focus:ring-blue-500">
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->roles->pluck('name')->implode(', ') }}</td>
                        <td>
                            <div class="status-indicator">
                                <div class="status-dot {{ $user->is_active ? 'active' : 'inactive' }}"></div>
                                <span>{{ $user->is_active ? 'Active' : 'Inactive' }}</span>
                            </div>
                        </td>
                        <td>
                    <div class="flex items-center justify-start space-x-4">
                        <div class="flex items-center justify-start space-x-4">
                            <flux:modal.trigger name="edit-user">
                                <flux:button type="button" class="mr-2" wire:click="edit({{ $user->id }})">
                                    Edit
                                </flux:button>
                            </flux:modal.trigger>

                            <flux:modal.trigger name="confirm-user-deletion">
                                <flux:button variant="danger" class="mr-2" wire:click="confirmDelete({{ $user->id }})">
                                    Delete
                                </flux:button>
                            </flux:modal.trigger>
                        </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">No users found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="py-4 px-3">
            {{ $users->links() }}
        </div>
    </div>

    <!-- Add User Modal -->
    <livewire:users.create />

    <!-- Edit User Modal -->
    <livewire:users.edit />

    <!-- Delete User Confirmation Modal -->
    <flux:modal wire:model="showDeleteModal" name="confirm-user-deletion" class="md:w-[400px]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg" class="text-red-600">Delete User</flux:heading>
                <flux:text class="mt-2">Are you sure you want to delete this user? This action cannot be undone.</flux:text>
            </div>
            <div class="flex justify-end space-x-3 pt-4">
                <flux:modal.close>
                    <flux:button type="button" variant="outline" x-on:click="$wire.showDeleteModal = false">Cancel
                    </flux:button>
                </flux:modal.close>
                <flux:button type="button" variant="primary" wire:click="deleteUser">Confirm</flux:button>
            </div>
        </div>
    </flux:modal>
</div>

