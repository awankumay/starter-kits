<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            {{-- Dashboard View Total Users Registration --}}
            <div class="flex h-full items-center justify-between gap-4 rounded-xl bg-primary-50 p-4 dark:bg-primary-900">
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
</x-layouts.app>
