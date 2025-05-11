<div>
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Users') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('User Management Pages') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    <div class="flex justify-between items-center mb-4">
        <div class="relative">
            <button id="actionDropdownButton"
                class="inline-flex items-center px-4 py-2 bg-zinc-800 dark:bg-zinc-700 text-white rounded-md">
                Action <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div id="actionDropdown" class="hidden absolute z-10 mt-1 py-1 w-48 bg-zinc-700 rounded-md shadow-lg">
                <a href="#" class="block px-4 py-2 text-sm text-white hover:bg-zinc-600">Bulk Deactivate</a>
                <a href="#" class="block px-4 py-2 text-sm text-white hover:bg-zinc-600">Bulk Activate</a>
                <a href="#" class="block px-4 py-2 text-sm text-white hover:bg-zinc-600">Bulk Delete</a>
            </div>

            {{-- Add New User --}}
            <button type="button" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md"
                x-on:click="$wire.showAddUserModal = true">
                Add User
            </button>

        </div>
        <div>
            <div class="relative">
                <input type="text" placeholder="Search for users" wire:model.live="search"
                    class="pl-10 pr-4 py-2 w-80 bg-zinc-700/20 dark:bg-zinc-700 text-zinc-800 dark:text-zinc-200 border border-zinc-300 dark:border-zinc-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <svg class="w-5 h-5 text-zinc-500 dark:text-zinc-400 absolute left-3 top-2.5" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
        </div>
    </div>

    <div class="overflow-x-auto bg-white dark:bg-zinc-800/40 rounded-lg">
        <table class="users-table">
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
                @forelse ($users as $user)
                <tr>
                    <td class="checkbox-cell">
                        <input type="checkbox"
                            class="rounded border-zinc-300 dark:border-zinc-600 text-blue-600 focus:ring-blue-500">
                    </td>
                    <td>
                        <div class="user-info">
                            <div class="user-avatar">
                                @if ($user->avatar && file_exists(public_path($user->avatar)))
                                <img src="{{ asset($user->avatar) }}" alt="{{ $user->name }}">
                                @else
                                <img src="{{ asset('personal.jpg') }}" alt="{{ $user->name }}">
                                @endif
                            </div>
                            <div class="user-details">
                                <div class="user-name">{{ $user->name }}</div>
                                <div class="user-email">{{ $user->email }}</div>
                            </div>
                        </div>
                    <td class="text-zinc-500 dark:text-zinc-400">{{ $user->email }}</td>
                    <td>{{ $user->role ?? 'Administrator' }}</td>
                    <td>
                        <div class="status-indicator">
                            {{-- <div class="status-dot {{ $user->status == 'active' ? 'active' : 'inactive' }}"></div>
                            <span>{{ ucfirst($user->status ?? 'Active') }}</span> --}}
                            <div class="status-dot active"></div>
                            <span>Active</span>
                        </div>
                    </td>
                    <td>
                        <div class="flex items-center justify-start space-x-4">
                            <flux:modal.trigger name="edit-user">
                                <button type="button"
                                    class="px-3.5 py-1.5 bg-blue-500 hover:bg-blue-600 text-white rounded-md text-sm font-medium transition-colors duration-150 flex items-center mr-2"
                                    wire:click="editUser({{ $user->id }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Edit
                                </button>
                            </flux:modal.trigger>
                            <flux:modal.trigger name="confirm-user-deletion">
                                <button wire:click="confirmDelete({{ $user->id }})" class="px-3.5 py-1.5 bg-red-500 hover:bg-red-600 text-white rounded-md text-sm font-medium transition-colors duration-150 flex items-center mr-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Delete
                                </button>
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
    </div>

    <!-- Add User Modal -->
    <flux:modal wire:model.self="showAddUserModal" name="add-user" class="md:w-[600px]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Add New User</flux:heading>
                <flux:text class="mt-2">Create a new user account with appropriate permissions.</flux:text>
            </div>

            <form wire:submit.prevent="createUser" class="space-y-4">
                <flux:input label="Full Name" placeholder="Enter full name" wire:model="name" required />
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                <flux:input label="Email Address" type="email" placeholder="user@example.com" wire:model="email" required />
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <flux:select label="Role" wire:model="role" required>
                            <option value="">Select role</option>
                            <option value="admin">Administrator</option>
                            <option value="finance">Finance</option>
                            <option value="supervisor">Supervisor</option>
                            <option value="user">Regular User</option>
                        </flux:select>
                        @error('role') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <flux:select label="Status" wire:model="status" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </flux:select>
                        @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <flux:input label="Password" type="password" placeholder="Create password" wire:model="password" required />
                        @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <flux:input label="Confirm Password" type="password" placeholder="Confirm password" wire:model="password_confirmation" required />
                    </div>
                </div>

                <div class="flex justify-end space-x-3 pt-4">
                    <flux:modal.close>
                        <flux:button type="button" variant="outline" x-on:click="$wire.showAddUserModal = false">Cancel</flux:button>
                    </flux:modal.close>
                    <flux:button type="submit" variant="primary">Add User</flux:button>
                </div>
            </form>
        </div>
    </flux:modal>

    <!-- Edit User Modal -->
    <flux:modal wire:model.self="showEditUserModal" name="edit-user" class="md:w-[600px]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Edit Pengguna</flux:heading>
                <flux:text class="mt-2">Perbarui informasi pengguna</flux:text>
            </div>

            @if($editUser)
            <div class="flex items-center justify-center mb-4">
                <div class="w-24 h-24 rounded-full overflow-hidden border-2 border-gray-300">
                    @if ($editUser->avatar && file_exists(public_path($editUser->avatar)))
                    <img src="{{ asset($editUser->avatar) }}" alt="{{ $editUser->name }}"
                        class="w-full h-full object-cover">
                    @else
                    <img src="{{ asset('personal.jpg') }}" alt="{{ $editUser->name }}"
                        class="w-full h-full object-cover">
                    @endif
                </div>
            </div>

            <form wire:submit.prevent="updateUser" class="space-y-6">
                <flux:input
                    label="Nama Lengkap"
                    wire:model="editUser.name"
                    required
                />
                @error('editUser.name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror

                <flux:input
                    label="Alamat Email"
                    type="email"
                    wire:model="editUser.email"
                    required
                />
                @error('editUser.email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <flux:select label="Peran" wire:model="editUser.role">
                            <option value="">-- Pilih Peran --</option>
                            <option value="admin">Administrator</option>
                            <option value="finance">Keuangan</option>
                            <option value="supervisor">Supervisor</option>
                            <option value="user">Pengguna Biasa</option>
                        </flux:select>
                        @error('editUser.role')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <flux:select label="Status" wire:model="editUser.status">
                            <option value="active">Aktif</option>
                            <option value="inactive">Tidak Aktif</option>
                        </flux:select>
                        @error('editUser.status')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <flux:input
                    label="Kata Sandi Baru"
                    type="password"
                    placeholder="Biarkan kosong untuk mempertahankan kata sandi saat ini"
                    wire:model="newPassword"
                />
                @error('newPassword')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror

                <div class="flex justify-end space-x-3 pt-4">
                    <flux:modal.close>
                        <flux:button variant="outline">Batal</flux:button>
                    </flux:modal.close>
                    <flux:button type="submit" variant="primary">Simpan Perubahan</flux:button>
                </div>
            </form>
            @else
            <div class="text-center p-4">
                <p>Informasi pengguna tidak tersedia.</p>
            </div>
            @endif
        </div>
    </flux:modal>

    <!-- Delete User Confirmation Modal -->
    <flux:modal wire:model.self="showDeleteModal" name="confirm-user-deletion" class="md:w-[400px]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg" class="text-red-600">Delete User</flux:heading>
                <flux:text class="mt-2">Are you sure you want to delete this user? This action cannot be undone.</flux:text>
            </div>
            <div class="flex justify-end space-x-3 pt-4">
                <flux:modal.close>
                    <flux:button type="button" variant="outline" x-on:click="$wire.showDeleteModal = false">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="button" variant="primary" wire:click="deleteUser">Confirm</flux:button>
            </div>
        </div>
    </flux:modal>

</div>


