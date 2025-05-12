<!-- Add User Modal -->
    <flux:modal wire:model.self="showAddUserModal" name="add-user" class="md:w-[600px]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Add New User</flux:heading>
                <flux:text class="mt-2">Create a new user account with appropriate permissions.</flux:text>
            </div>

            <form wire:submit.prevent="createUser" class="space-y-4">
                @include('livewire.users.form')

                <div class="flex justify-end space-x-3 pt-4">
                    <flux:modal.close>
                        <flux:button type="button" variant="outline" x-on:click="$wire.showAddUserModal = false">Cancel</flux:button>
                    </flux:modal.close>
                    <flux:button type="submit" variant="primary">Add User</flux:button>
                </div>
            </form>
            {{-- <form wire:submit.prevent="createDummy" class="space-y-4">
                <flux:button type="submit" variant="primary">Submit</flux:button>
            </form> --}}
        </div>
    </flux:modal>
<!-- End Add User Modal -->

