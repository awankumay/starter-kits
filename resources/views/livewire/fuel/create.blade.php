<flux:modal wire:model.self="showAddFuelModal" name="add-fuel" class="md:w-[700px]">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">Add New Fuel Request</flux:heading>
            <flux:text class="mt-2">Create a new fuel request for operations units.</flux:text>
        </div>
        <form wire:submit.prevent="createFuel" class="space-y-4">
            @include('livewire.fuel.form')
            <div class="flex justify-end space-x-3 pt-4">
                <flux:modal.close>
                    <flux:button type="button" variant="outline" x-on:click="$wire.showAddFuelModal = false">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="primary">Submit Request</flux:button>
            </div>
        </form>
    </div>
</flux:modal>
