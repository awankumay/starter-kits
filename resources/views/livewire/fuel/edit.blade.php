<flux:modal wire:model.self="showEditFuelModal" name="edit-fuel" class="md:w-[700px]">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">Edit Fuel Request</flux:heading>
            <flux:text class="mt-2">Update fuel request details.</flux:text>
        </div>
        <form wire:submit.prevent="updateFuel" class="space-y-4">
            @include('livewire.fuel.form')
            <div class="flex justify-end space-x-3 pt-4">
                <flux:modal.close>
                    <flux:button type="button" variant="outline" x-on:click="$wire.showEditFuelModal = false">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="primary">Update Request</flux:button>
            </div>
        </form>
    </div>
</flux:modal>

<script>
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('editFuel', (event) => {
            @this.edit(event.id);
        });
    });
</script>
