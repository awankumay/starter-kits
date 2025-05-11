<div>
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
<!-- End Add User Modal -->
</div>
