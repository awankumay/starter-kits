<flux:modal wire:model.self="showEditTypeModal" name="edit-types" class="md:w-[600px]">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">Edit Unit Type</flux:heading>
            <flux:text class="mt-2">Edit unit type with appropriate details.</flux:text>
        </div>
        <form wire:submit.prevent="updateUnitType" class="space-y-4">
            @include('livewire.unit-types.form')
            <div class="flex justify-end space-x-3 pt-4">
                <flux:modal.close>
                    <flux:button type="button" variant="outline" x-on:click="$wire.showEditTypeModal = false">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="primary">Submit</flux:button>
            </div>
        </form>
    </div>
</flux:modal>
