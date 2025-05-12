<flux:modal wire:model.self="showAddTypeModal" name="add-types" class="md:w-[600px]">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">Add New Unit Type</flux:heading>
            <flux:text class="mt-2">Create a new unit type with appropriate details.</flux:text>
        </div>
        <form wire:submit.prevent="createUnitType" class="space-y-4">
            @include('livewire.unit-types.form')
            <div class="flex justify-end space-x-3 pt-4">
                <flux:modal.close>
                    <flux:button type="button" variant="outline" x-on:click="$wire.showAddTypeModal = false">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="primary">Submit</flux:button>
            </div>
        </form>
    </div>
</flux:modal>
