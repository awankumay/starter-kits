<section>
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Fuel') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Fuel Request Management') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>
    <div class="flex justify-between items-center mb-4">
        <div class="relative flex space-x-2">
            {{-- Dropdown Action dengan FluxUI --}}
            <flux:dropdown>
                <flux:button icon:trailing="chevron-down">Action</flux:button>
                <flux:menu>
                    <flux:menu.item>Bulk Approve</flux:menu.item>
                    <flux:menu.item>Bulk Reject</flux:menu.item>
                    <flux:menu.separator />
                    <flux:menu.item variant="danger" icon="trash">Bulk Delete</flux:menu.item>
                </flux:menu>
            </flux:dropdown>
            {{-- Add New Fuel Request --}}
            <flux:modal.trigger name="add-fuel">
                <flux:button variant="primary" icon:leading="plus">
                    Add Fuel Request
                </flux:button>
            </flux:modal.trigger>
        </div>
        <div>
            <div class="relative">
                <flux:input
                    as="text"
                    wire:model.lazy="search"
                    placeholder="Search for fuel requests"
                    icon="magnifying-glass">
                </flux:input>
            </div>
        </div>
    </div>
    <div class="overflow-x-auto bg-white dark:bg-zinc-800/40 rounded-lg">
        <table class="table-custom">
            <thead>
                <tr>
                    <th class="checkbox-column">
                        <input type="checkbox"
                            class="rounded border-zinc-300 dark:border-zinc-600 text-blue-600 focus:ring-blue-500">
                    </th>
                    <th>Request Number</th>
                    <th>Unit</th>
                    <th>Request Date</th>
                    <th>Fuel Type</th>
                    <th>Volume</th>
                    <th>Location</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($fuels as $fuel)
                <tr>
                    <td class="checkbox-cell">
                        <input type="checkbox"
                            class="rounded border-zinc-300 dark:border-zinc-600 text-blue-600 focus:ring-blue-500">
                    </td>
                    <td>{{ $fuel->request_number }}</td>
                    <td>{{ $fuel->operationsUnit->name ?? 'N/A' }}</td>
                    <td>{{ $fuel->request_date->format('d M Y') }}</td>
                    <td>{{ $fuel->fuels_type }}</td>
                    <td>{{ $fuel->volume }} liter</td>
                    <td>{{ $fuel->location }}</td>
                    <td>
                        <span class="px-2 py-1 text-xs font-medium rounded-full
                            @if($fuel->status === 'pending') bg-yellow-100 text-yellow-800
                            @elseif($fuel->status === 'approved') bg-green-100 text-green-800
                            @elseif($fuel->status === 'rejected') bg-red-100 text-red-800
                            @elseif($fuel->status === 'completed') bg-blue-100 text-blue-800
                            @endif">
                            {{ ucfirst($fuel->status) }}
                        </span>
                    </td>
                    <td>
                    <div class="flex items-center justify-start space-x-4">
                        <div class="flex items-center justify-start space-x-4">
                            <flux:modal.trigger name="edit-fuel">
                                <flux:button type="button" class="mr-2" wire:click="$dispatch('editFuel', { id: {{ $fuel->id }} })">
                                    Edit
                                </flux:button>
                            </flux:modal.trigger>
                            <flux:modal.trigger name="confirmDelete">
                                <flux:button variant="danger" class="mr-2" wire:click="confirmDelete({{ $fuel->id }})">
                                    Delete
                                </flux:button>
                            </flux:modal.trigger>
                        </div>
                    </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center py-4">
                            {{ __('No fuel requests found.') }}
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="px-4 py-3 bg-white dark:bg-zinc-800/40 border-t border-zinc-200 dark:border-zinc-700">
            {{ $fuels->links() }}
        </div>
    </div>

    {{-- Modal Create Fuel --}}
    <livewire:fuel.create />

    {{-- Modal Edit Fuel --}}
    <livewire:fuel.edit />

    {{-- Modal Show Delete Confirm --}}
    <flux:modal wire:model.self="showDeleteModal" name="confirmDelete" class="md:w-[400px]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg" class="text-red-600">Delete Fuel Request</flux:heading>
                <flux:text class="mt-2">Are you sure you want to delete this fuel request? This action cannot be undone.</flux:text>
            </div>
            <div class="flex justify-end space-x-3 pt-4">
                <flux:modal.close>
                    <flux:button type="button" variant="outline" x-on:click="$wire.showDeleteModal = false">Cancel
                    </flux:button>
                </flux:modal.close>
                <flux:button type="button" variant="primary" wire:click="deleteFuel">Confirm</flux:button>
            </div>
        </div>
    </flux:modal>
</section>
