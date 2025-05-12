<!-- Add User Modal -->
    <flux:modal wire:model.self="showAddUnitModal" name="add-units" class="md:w-[600px]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Add New Unit</flux:heading>
                <flux:text class="mt-2">Create a new unit with appropriate details.</flux:text>
            </div>

            <form wire:submit.prevent="createUnit" class="space-y-4">
                @include('livewire.units.form')

                <div class="flex justify-end space-x-3 pt-4">
                    <flux:modal.close>
                        <flux:button type="button" variant="outline" x-on:click="$wire.showAddUnitModal = false">Cancel</flux:button>
                    </flux:modal.close>
                    <flux:button type="submit" variant="primary">Add Units</flux:button>
                </div>
            </form>
            {{-- <form wire:submit.prevent="createDummy" class="space-y-4">
                <flux:button type="submit" variant="primary">Submit</flux:button>
            </form> --}}
        </div>
    </flux:modal>
<!-- End Add User Modal -->

