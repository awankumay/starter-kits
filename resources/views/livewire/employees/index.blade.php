<section>
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Employees') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Employees Pages') }}</flux:subheading>
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
            {{-- Add New Employees --}}
            <flux:modal.trigger name="add-employee">
                <flux:button variant="primary" icon:leading="plus">
                    Add Employee
                </flux:button>
            </flux:modal.trigger>
        </div>
        <div>
            <div class="relative">
                <flux:input as="text" placeholder="Search for employees" wire:model.live="search"
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
                        <input
                            type="checkbox"
                            class="rounded border-zinc-300 dark:border-zinc-600 text-blue-600 focus:ring-blue-500"
                        />
                    </th>
                    <th>Employee Number</th>
                    <th>Name</th>
                    {{-- <th>Email</th>
                    <th>Phone</th> --}}
                    <th>Position</th>
                    <th>Join Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($employees as $employee)
                <tr>
                    <td class="checkbox-cell">
                        <input type="checkbox"
                            class="rounded border-zinc-300 dark:border-zinc-600 text-blue-600 focus:ring-blue-500">
                    </td>
                    <td>{{ $employee->employee_number }}</td>
                    <td>{{ $employee->name }}</td>
                    {{-- <td>{{ $employee->email }}</td>
                    <td>{{ $employee->phone }}</td> --}}
                    <td>{{ $employee->position?->position }}</td>
                    <td>{{ $employee->join_date }}</td>
                    <td>{{ $employee->is_active ? 'Active' : 'Inactive' }}</td>
                    <td>
                        <div class="flex items-center justify-start space-x-4">
                            <div class="flex items-center justify-start space-x-4">
                                <flux:modal.trigger name="edit-Employee">
                                    <flux:button type="button" class="mr-2" wire:click="edit({{ $employee->id }})">
                                        Edit
                                    </flux:button>
                                </flux:modal.trigger>
                                <flux:modal.trigger name="confirm-Employee-deletion">
                                    <flux:button variant="danger" class="mr-2"
                                        wire:click="confirmDelete({{ $employee->id }})">
                                        Delete
                                    </flux:button>
                                </flux:modal.trigger>
                            </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center py-4">
                        {{ __('No types found.') }}
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Modal Add / Create Employee --}}
    <livewire:employees.create />

    {{-- Modal Edit Employee --}}
    {{-- <livewire:employees.edit/> --}}

    {{-- Modal Delete --}}
    <flux:modal wire:model.self="showDeleteEmployeeModal" name="confirm-employee-deletion" class="md:w-[400px]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg" class="text-red-600">Delete Employee</flux:heading>
                <flux:text class="mt-2">Are you sure you want to delete this Employee? This action cannot be undone.</flux:text>
            </div>
            <div class="flex justify-end space-x-3 pt-4">
                <flux:modal.close>
                    <flux:button type="button" variant="outline" x-on:click="$wire.showDeleteModal = false">Cancel
                    </flux:button>
                </flux:modal.close>
                <flux:button type="button" variant="primary" wire:click="deleteEmployee">Confirm</flux:button>
            </div>
        </div>
    </flux:modal>
</section>
