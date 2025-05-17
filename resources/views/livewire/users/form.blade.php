<flux:input label="Full Name" placeholder="Enter full name" wire:model="name" required />
<flux:input label="Email Address" type="email" placeholder="user@example.com" wire:model="email" required />

<div class="grid grid-cols-2 gap-4">
    <div>
        {{-- <flux:select label="User Type" wire:model="user_type">
            <option value="">Select user type</option>
            @foreach($roles as $role)
            <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
            @endforeach
        </flux:select> --}}
    </div>

    <div>
        {{-- <flux:select label="Status" wire:model="status" required>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
        </flux:select> --}}
    </div>
</div>

<div class="grid grid-cols-2 gap-4">
    <div>
        <flux:input label="Password" type="password" placeholder="Create password" wire:model="password" required />
    </div>
    <div>
        <flux:input label="Confirm Password" type="password" placeholder="Confirm password"
            wire:model="password_confirmation" required />
    </div>
</div>
