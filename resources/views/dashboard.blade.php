<div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            {{-- Dashboard View Total Users Registration --}}
            <div wire:poll.10s="refreshUserData" class="flex h-full items-center justify-between gap-4 rounded-xl bg-primary-50 p-4 dark:bg-primary-900">
                <div class="flex h-full items-center justify-center gap-2 rounded-xl bg-primary-100 p-2 dark:bg-primary-950">
                    <flux:icon.user/>
                </div>
                <div class="flex flex-1 flex-col gap-1">
                    <p class="text-sm font-medium text-neutral-800 dark:text-neutral-50">Total Users</p>
                    <p class="text-lg font-semibold text-neutral-900 dark:text-neutral-50">
                        {{ $totalUsersRegistration }}
                    </p>
                </div>
            </div>

            {{-- Total Pegawai Card --}}
            <div wire:poll.10s="" class="flex h-full items-center justify-between gap-4 rounded-xl bg-blue-50 p-4 dark:bg-blue-900">
                <div class="flex h-full items-center justify-center gap-2 rounded-xl bg-blue-100 p-2 dark:bg-blue-950">
                    <flux:icon.users/>
                </div>
                <div class="flex flex-1 flex-col gap-1">
                    <p class="text-sm font-medium text-neutral-800 dark:text-neutral-50">Total Pegawai</p>
                    <p class="text-lg font-semibold text-neutral-900 dark:text-neutral-50">
                        {{ $totalEmployees ?? 0 }}
                    </p>
                </div>
            </div>

            {{-- Total Request Masuk Card --}}
            <div wire:poll.5s="" class="flex h-full items-center justify-between gap-4 rounded-xl bg-green-50 p-4 dark:bg-green-900">
                <div class="flex h-full items-center justify-center gap-2 rounded-xl bg-green-100 p-2 dark:bg-green-950">
                    <flux:icon.inbox/>
                </div>
                <div class="flex flex-1 flex-col gap-1">
                    <p class="text-sm font-medium text-neutral-800 dark:text-neutral-50">Total Request Masuk</p>
                    <p class="text-lg font-semibold text-neutral-900 dark:text-neutral-50">
                        {{ $totalRequests ?? 0 }}
                    </p>
                </div>
            </div>
        </div>

        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            {{-- Total Pengeluaran Bahan Bakar Card --}}
            <div wire:poll.30s="" class="flex h-full items-center justify-between gap-4 rounded-xl bg-amber-50 p-4 dark:bg-amber-900">
                <div class="flex h-full items-center justify-center gap-2 rounded-xl bg-amber-100 p-2 dark:bg-amber-950">
                    {{-- <flux:icon.fuel/> --}}
                </div>
                <div class="flex flex-1 flex-col gap-1">
                    <p class="text-sm font-medium text-neutral-800 dark:text-neutral-50">Total Pengeluaran BBM</p>
                    <p class="text-lg font-semibold text-neutral-900 dark:text-neutral-50">
                        Rp {{ number_format($totalFuelExpense ?? 0, 0, ',', '.') }}
                    </p>
                </div>
            </div>

            {{-- Placeholders untuk card lain --}}
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
        </div>

        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
        </div>
    </div>
