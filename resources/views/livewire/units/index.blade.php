<section>
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Units') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Units Pages') }}</flux:subheading>
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
            {{-- Add New User --}}
            <flux:modal.trigger name="add-units">
                <flux:button variant="primary" icon:leading="plus">
                    Add Units
                </flux:button>
            </flux:modal.trigger>
        </div>
        <div>
            <div class="relative">
                <flux:input
                    as="text"
                    placeholder="Search for units"
                    wire:model.live="search"
                    icon="magnifying-glass">
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
                    <th>Code Unit</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Location</th>
                    {{-- <th>Fuel Type</th> --}}
                    <th>Operator</th>
                    {{-- <th>Description</th> --}}
                    <th>Image Unit</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($units as $unit)
                <tr>
                    <td class="checkbox-column">
                        <input type="checkbox" value="{{ $unit->id }}"
                            class="rounded border-zinc-300 dark:border-zinc-600 text-blue-600 focus:ring-blue-500">
                    </td>
                    <td>{{ $unit->code }}</td>
                    <td>{{ $unit->name }}</td>
                    <td>{{ $unit->unitType->type ?? 'N/A' }}</td>
                    <td>{{ $unit->location }}</td>
                    {{-- <td>{{ $unit->fuel_type }}</td> --}}
                    <td>{{ $unit->operator }}</td>
                    {{-- <td>{{ Str::limit($unit->description, 30) }}</td> --}}
                    <td>
                        @if($unit->image_unit)
                            <img src="{{ Storage::url($unit->image_unit) }}" class="h-10 w-10 rounded-full object-cover">
                        @else
                            <span>No Image</span>
                        @endif
                    </td>
                    <td class="flex space-x-2">
                        <flux:button wire:click="$dispatch('editUnit', { id: {{ $unit->id }} })" size="sm" variant="primary">Edit</flux:button>
                        <flux:button wire:click="confirmDelete({{ $unit->id }})" size="sm" variant="danger">Delete</flux:button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-center py-4">No units found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4">
            {{ $units->links() }}
        </div>
    </div>
    {{-- Modal Create --}}
    <livewire:units.create />

    {{-- Modal Edit --}}
    <livewire:units.edit />

    {{-- Modal Show Delete Confirm --}}
    <flux:modal wire:model.self="showDeleteModal" name="confirm-unit-deletion" class="md:w-[400px]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg" class="text-red-600">Delete Unit</flux:heading>
                <flux:text class="mt-2">Are you sure you want to delete this unit? This action cannot be undone.</flux:text>
            </div>
            <div class="flex justify-end space-x-3 pt-4">
                <flux:modal.close>
                    <flux:button type="button" variant="outline" x-on:click="$wire.showDeleteModal = false">Cancel
                    </flux:button>
                </flux:modal.close>
                <flux:button type="button" variant="primary" wire:click="deleteUnit">Confirm</flux:button>
            </div>
        </div>
    </flux:modal>
</section>
