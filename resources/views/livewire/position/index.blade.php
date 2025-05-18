<section>
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Positions') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Positions Pages') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>
    <div class="flex justify-between items-center mb-4">
        <div class="relative flex space-x-2">
            {{-- Dropdown Action dengan FluxUI --}}
            <flux:dropdown>
                <flux:button icon:trailing="chevron-down">Action</flux:button>
                <flux:menu>
                    <flux:menu.item>Bulk Deactivate</flux:menu.item>
                    <flux:menu.item>Bulk Activate</flux:menu.item>
                    <flux:menu.separator />
                    <flux:menu.item variant="danger" icon="trash">Bulk Delete</flux:menu.item>
                </flux:menu>
            </flux:dropdown>
            {{-- Add New Positions --}}
            <flux:modal.trigger name="add-position">
                <flux:button variant="primary" icon:leading="plus">
                    Add Position
                </flux:button>
            </flux:modal.trigger>
        </div>
        <div>
            <div class="relative">
                <flux:input as="text" placeholder="Search for units" wire:model.live="search" icon="magnifying-glass">
                </flux:input>
            </div>
        </div>
    </div>

    @if(session()->has('message'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
        <p>{{ session('message') }}</p>
    </div>
    @endif
    <div class="overflow-x-auto bg-white dark:bg-zinc-800/40 rounded-lg">
        <table class="table-custom">
            <thead>
                <tr>
                    <th class="checkbox-column">
                        <input type="checkbox"
                            class="rounded border-zinc-300 dark:border-zinc-600 text-blue-600 focus:ring-blue-500">
                    </th>
                    <th>Positions</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($positions as $position)
                <tr>
                    <td class="checkbox-cell">
                        <input type="checkbox"
                            class="rounded border-zinc-300 dark:border-zinc-600 text-blue-600 focus:ring-blue-500">
                    </td>
                    <td>{{ $position->position }}</td>
                    <td>{{ $position->description }}</td>
                    <td>
                    <div class="flex items-center justify-start space-x-4">
                        <div class="flex items-center justify-start space-x-4">
                            <flux:modal.trigger name="edit-position">
                                <flux:button type="button" class="mr-2" wire:click="edit({{ $position->id }})">
                                    Edit
                                </flux:button>

                            </flux:modal.trigger>
                            <flux:modal.trigger name="confirm-position-deletion">
                                <flux:button variant="danger" class="mr-2" wire:click="confirmDelete({{ $position->id }})">
                                    Delete
                                </flux:button>
                            </flux:modal.trigger>
                        </div>
                    </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">
                            {{ __('No types found.') }}
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <livewire:position.create />
    <livewire:position.edit />

    {{-- Modal Delete --}}
    <flux:modal wire:model.self="showDeletePositionModal" name="confirm-position-deletion" class="md:w-[400px]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg" class="text-red-600">Delete Position</flux:heading>
                <flux:text class="mt-2">Are you sure you want to delete this position? This action cannot be undone.</flux:text>
            </div>
            <div class="flex justify-end space-x-3 pt-4">
                <flux:modal.close>
                    <flux:button type="button" variant="outline" x-on:click="$wire.showDeleteModal = false">Cancel
                    </flux:button>
                </flux:modal.close>
                <flux:button type="button" variant="primary" wire:click="deletePosition">Confirm</flux:button>
            </div>
        </div>
    </flux:modal>


</section>
