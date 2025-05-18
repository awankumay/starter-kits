<flux:modal wire:model.self="showAddPositionModal" name="add-position" class="md:w-[600px]">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">Add New Position</flux:heading>
            <flux:text class="mt-2">Create a new position with appropriate details.</flux:text>
        </div>
        <form wire:submit.prevent="createPosition" class="space-y-4">
            @include('livewire.position.form')
            <div class="flex justify-end space-x-3 pt-4">
                <flux:modal.close>
                    <flux:button type="button" variant="outline" x-on:click="$wire.showAddPositionModal = false">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="primary">Submit</flux:button>
            </div>
        </form>
    </div>
</flux:modal>
