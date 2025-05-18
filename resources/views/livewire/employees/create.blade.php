<flux:modal wire:model.self="showAddEmployeeModal" name="add-employee" class="md:w-[600px]">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">Add New Employee</flux:heading>
            <flux:text class="mt-2">Create a new employee with appropriate details.</flux:text>
        </div>
        <form wire:submit.prevent="createEmployee" class="space-y-4">
            @include('livewire.employees.form')
            <div class="flex justify-end space-x-3 pt-4">
                <flux:modal.close>
                    <flux:button type="button" variant="outline" x-on:click="$wire.showAddEmployeeModal = false">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="primary">Submit</flux:button>
            </div>
        </form>
    </div>
</flux:modal>
