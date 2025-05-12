{{-- Modal Form Fuel --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <flux:select label="Operations Unit" wire:model="operations_unit_id" required>
        <option value="">Select Unit</option>
        @foreach($units as $unit)
            <option value="{{ $unit->id }}">{{ $unit->name }}</option>
        @endforeach
    </flux:select>

    <flux:input type="date" label="Request Date" wire:model="request_date" required />

    <flux:select label="Fuel Type" wire:model="fuels_type" required>
        <option value="">Select Fuel Type</option>
        <option value="Solar">Solar</option>
        <option value="Pertalite">Pertalite</option>
        <option value="Pertamax">Pertamax</option>
        <option value="Pertamax Turbo">Pertamax Turbo</option>
        <option value="Dexlite">Dexlite</option>
        <option value="Pertamina Dex">Pertamina Dex</option>
    </flux:select>

    <flux:input type="number" label="Volume (liters)" placeholder="Volume in liters" wire:model="volume" required step="0.01" />

    <flux:input label="Location" placeholder="Location for fueling" wire:model="location" required />

    @if(isset($status))
    <flux:select label="Status" wire:model="status" required>
        <option value="pending">Pending</option>
        <option value="approved">Approved</option>
        <option value="rejected">Rejected</option>
        <option value="completed">Completed</option>
    </flux:select>
    @endif
</div>

<div class="mt-4">
    @if(isset($newFuelIndicatorPhoto))
        <flux:input type="file" label="Fuel Indicator Photo" wire:model="newFuelIndicatorPhoto" accept="image/*" />
        @if($newFuelIndicatorPhoto)
            <div class="mt-2">
                <p class="text-sm text-zinc-500">Preview:</p>
                <img src="{{ $newFuelIndicatorPhoto->temporaryUrl() }}" class="mt-1 h-32 w-auto object-cover rounded">
            </div>
        @elseif(isset($fuel) && $fuel->fuels_indicator_photo)
            <div class="mt-2">
                <p class="text-sm text-zinc-500">Current Photo:</p>
                <img src="{{ asset('storage/' . $fuel->fuels_indicator_photo) }}" class="mt-1 h-32 w-auto object-cover rounded">
            </div>
        @endif
    @else
        <flux:input type="file" label="Fuel Indicator Photo" wire:model="fuels_indicator_photo" accept="image/*" />
        @if(isset($fuels_indicator_photo) && $fuels_indicator_photo)
            <div class="mt-2">
                <p class="text-sm text-zinc-500">Preview:</p>
                <img src="{{ $fuels_indicator_photo->temporaryUrl() }}" class="mt-1 h-32 w-auto object-cover rounded">
            </div>
        @endif
    @endif
</div>

<div class="mt-4">
    <flux:textarea label="Notes" placeholder="Additional notes" wire:model="notes" rows="3" />
</div>
