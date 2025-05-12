{{-- Modal Form Unit --}}
<div class="grid grid-cols-2 gap-4">
    <div>
        <flux:input label="Code Unit" placeholder="Code Unit" wire:model="code_unit" required />
    </div>

    <div>
        <flux:input label="Name" placeholder="Name Unit" wire:model="name" required />
    </div>
</div>
<div class="grid grid-cols-2 gap-4">
    <div>
        <flux:input label="Location" placeholder="Location Unit" wire:model="location" required />
    </div>

    <div>
        <flux:select label="Type" wire:model="typeUnits">
            <option value="">Select unit type</option>
            @foreach($unitTypes as $type)
            <option value="{{ $type->id }}">{{ $type->type }} - {{ $type->brand }}</option>
            @endforeach
        </flux:select>
    </div>
</div>
<div class="grid grid-cols-2 gap-4">
    <div>
        <flux:input label="Operator" placeholder="Operator Unit" wire:model="operator" required />
    </div>

    <div>
        <flux:select label="Fuel Type" wire:model="fuelType">
            <option value="">Select fuel type</option>
            <option value="solar">Solar</option>
            <option value="dex-lite">Dex Lite</option>
            <option value="dex">Dex</option>
            <option value="bio-solar">Bio Solar</option>
            <option value="pertamax-turbo">Pertamax Turbo</option>
            <option value="pertamax">Pertamax</option>
            <option value="pertalite">Pertalite</option>
        </flux:select>
    </div>
</div>
<div class="grid grid-cols-2 gap-4">
    <div>
        <flux:input type="file" wire:model="image_unit" label="Image Unit"/>
    </div>
</div>
<flux:textarea label="Description" placeholder="Description Unit" wire:model="description" />
