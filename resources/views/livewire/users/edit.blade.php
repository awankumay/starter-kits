<!-- Edit User Modal -->
    <flux:modal wire:model.self="showEditUserModal" name="edit-user" class="md:w-[600px]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Edit User</flux:heading>
                <flux:text class="mt-2">Edit the user account with appropriate permissions.</flux:text>
            </div>

            <form wire:submit.prevent="updateUser" class="space-y-4">
                @include('livewire.users.form')

                <div class="flex justify-end space-x-3 pt-4">
                    <flux:modal.close>
                        <flux:button type="button" variant="outline" x-on:click="$wire.showEditUserModal = false">Cancel</flux:button>
                    </flux:modal.close>
                    <flux:button type="submit" variant="primary">Update User</flux:button>
                </div>
            </form>
        </div>
    </flux:modal>
<!-- End Edit User Modal -->


