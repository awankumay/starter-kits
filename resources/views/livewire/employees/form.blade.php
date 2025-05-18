<div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <flux:label for="employee_number">Employee Number</flux:label>
            <flux:input wire:model="employee_number" id="employee_number" type="text" />
            @error('employee_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <div>
            <flux:label for="name">Name</flux:label>
            <flux:input wire:model="name" id="name" type="text" />
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <div>
            <flux:label for="email">Email</flux:label>
            <flux:input wire:model="email" id="email" type="email" />
            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <div>
            <flux:label for="phone">Phone</flux:label>
            <flux:input wire:model="phone" id="phone" type="text" />
            @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        {{-- <div>
            <flux:label for="position_id">Position</flux:label>
            <select wire:model="position_id" id="position_id" class="rounded-md border-gray-300 w-full">
                <option value="">Select Position</option>
                @foreach($positions as $position)
                    <option value="{{ $position->id }}">{{ $position->position }}</option>
                @endforeach
            </select>
            @error('position_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div> --}}
        <div>
            <flux:select label="Position" wire:model="position_id" id="position_id">
                <option value="">Select Position</option>
                @foreach($positions as $position)
                    <option value="{{ $position->id }}">{{ $position->position }}</option>
                @endforeach
            </flux:select>
            @error('position_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <div>
            <flux:label for="join_date">Join Date</flux:label>
            <flux:input wire:model="join_date" id="join_date" type="date" />
            @error('join_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        {{-- <div>
            <flux:label for="photo">Photo</flux:label>
            <input wire:model="photo" id="photo" type="file" class="mt-1 block w-full" />
            @error('photo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div> --}}
        <div>
            <flux:input type="file" label="Photo" wire:model="photo" id="photo" />
        </div>
        {{-- <div>
            <flux:label for="is_active">Status</flux:label>
            <select wire:model="is_active" id="is_active" class="rounded-md border-gray-300 w-full">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div> --}}
        <div>
            <flux:select label="Status" wire:model="is_active" id="is_active">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </flux:select>
            @error('is_active') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
    </div>
</div>
