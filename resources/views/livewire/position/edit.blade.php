{{-- filepath: d:\Project\MOMS\starter-kits\resources\views\livewire\position\edit.blade.php --}}
<flux:modal wire:model.self="showEditPositionModal" name="edit-position" class="md:w-[600px]">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">Edit Position</flux:heading>
            <flux:text class="mt-2">Edit position with appropriate details.</flux:text>
        </div>
        <form wire:submit.prevent="updatePosition" class="space-y-4">
            @include('livewire.position.form')
            <div class="flex justify-end space-x-3 pt-4">
                <flux:modal.close>
                    <flux:button type="button" variant="outline" x-on:click="$wire.showEditPositionModal = false">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="primary">Submit</flux:button>
            </div>
        </form>
    </div>
</flux:modal>
