<!-- Edit Unit Modal -->
<flux:modal wire:model.self="showEditModal" name="edit-units" class="md:w-[600px]">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">Edit Unit</flux:heading>
            <flux:text class="mt-2">Update unit information.</flux:text>
        </div>

        <form wire:submit.prevent="updateUnit" class="space-y-4">
            @include('livewire.units.form')

            <div class="flex justify-end space-x-3 pt-4">
                <flux:modal.close>
                    <flux:button type="button" variant="outline" x-on:click="$wire.showEditModal = false">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="primary">Update Unit</flux:button>
            </div>
        </form>
    </div>
</flux:modal>
<!-- End Edit Unit Modal -->
