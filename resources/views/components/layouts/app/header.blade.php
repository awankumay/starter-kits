<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800">
    <flux:header container class="border-b border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        <a href="{{ route('dashboard') }}" class="ms-2 me-5 flex items-center space-x-2 rtl:space-x-reverse lg:ms-0"
            wire:navigate>
            <x-app-logo />
        </a>

        <flux:navbar class="-mb-px max-lg:hidden">
            <flux:navbar.item icon="layout-grid" :href="route('dashboard')" :current="request()->routeIs('dashboard')"
                wire:navigate>
                {{ __('Dashboard') }}
            </flux:navbar.item>
            @if(auth()->user()->hasRole('administrator'))
                <flux:dropdown class="max-lg:hidden">
                    <flux:navbar.item icon:trailing="chevron-down">Logistic</flux:navbar.item>
                    <flux:navmenu>
                        <flux:navmenu.item href="#">Request</flux:navmenu.item>
                        <flux:navmenu.item href="#">Stock</flux:navmenu.item>
                        <flux:navmenu.item href="#">Items</flux:navmenu.item>
                    </flux:navmenu>
                </flux:dropdown>
                {{-- Operations --}}
                <flux:dropdown class="max-lg:hidden">
                    <flux:navbar.item icon:trailing="chevron-down">Operations</flux:navbar.item>
                    <flux:navmenu>
                        <flux:navmenu.item href="#">Form Request</flux:navmenu.item>
                        <flux:navmenu.item href="#">Stock</flux:navmenu.item>
                        <flux:navmenu.item href="#">Units</flux:navmenu.item>
                        <flux:navmenu.item :href="route('unit-types.index')" :current="request()->routeIs('unit-types.index')" wire:navigate>{{ __('Types') }}</flux:navmenu.item>
                    </flux:navmenu>
                </flux:dropdown>
                {{-- Employee --}}
                <flux:dropdown class="max-lg:hidden">
                    <flux:navbar.item icon:trailing="chevron-down">Employee</flux:navbar.item>
                    <flux:navmenu>
                        <flux:navmenu.item href="#">List Employee</flux:navmenu.item>
                        <flux:navmenu.item href="#">Absence</flux:navmenu.item>
                        <flux:navmenu.item href="#">Position</flux:navmenu.item>
                        <flux:navmenu.item href="#">Shift Scheduling</flux:navmenu.item>
                    </flux:navmenu>
                </flux:dropdown>
                {{-- Reporting --}}
                <flux:dropdown class="max-lg:hidden">
                    <flux:navbar.item icon:trailing="chevron-down">Reporting</flux:navbar.item>
                    <flux:navmenu>
                        <flux:navmenu.item href="#">Logistic</flux:navmenu.item>
                        <flux:navmenu.item href="#">Operations</flux:navmenu.item>
                        <flux:navmenu.item href="#">Employee</flux:navmenu.item>
                    </flux:navmenu>
                </flux:dropdown>
                {{-- User Management --}}
                <flux:dropdown class="max-lg:hidden">
                    <flux:navbar.item icon:trailing="chevron-down">User Management</flux:navbar.item>
                    <flux:navmenu>
                        <flux:navmenu.item :href="route('users-management.roles')" :current="request()->routeIs('users-management.roles')" wire:navigate>{{ __('Roles') }}</flux:navmenu.item>
                        <flux:navmenu.item :href="route('users-management.permissions')" :current="request()->routeIs('users-management.permissions')" wire:navigate>{{ __('Permissions') }}</flux:navmenu.item>
                        {{-- <flux:navmenu.item href="#">Users</flux:navmenu.item> --}}
                        <flux:navmenu.item :href="route('users.index')" :current="request()->routeIs('users.index')" wire:navigate>{{ __('Users') }}
                        </flux:navmenu.item>
                    </flux:navmenu>
                </flux:dropdown>
            @endif
        </flux:navbar>

        <flux:spacer />

        <flux:navbar class="me-1.5 space-x-0.5 rtl:space-x-reverse py-0!">
            {{-- <flux:tooltip :content="__('Search')" position="bottom">
                <flux:navbar.item class="!h-10 [&>div>svg]:size-5" icon="magnifying-glass" href="#"
                    :label="__('Search')" />
            </flux:tooltip> --}}
            {{-- <flux:tooltip :content="__('Repository')" position="bottom">
                <flux:navbar.item class="h-10 max-lg:hidden [&>div>svg]:size-5" icon="folder-git-2"
                    href="https://github.com/laravel/livewire-starter-kit" target="_blank" :label="__('Repository')" />
            </flux:tooltip>
            <flux:tooltip :content="__('Documentation')" position="bottom">
                <flux:navbar.item class="h-10 max-lg:hidden [&>div>svg]:size-5" icon="book-open-text"
                    href="https://laravel.com/docs/starter-kits#livewire" target="_blank" label="Documentation" />
            </flux:tooltip> --}}
        </flux:navbar>

        <!-- Desktop User Menu -->
        <flux:dropdown position="top" align="end">
            <flux:profile class="cursor-pointer" :initials="auth()->user()->initials()" />

            <flux:menu>
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                <span
                                    class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                                    {{ auth()->user()->initials() }}
                                </span>
                            </span>

                            <div class="grid flex-1 text-start text-sm leading-tight">
                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>
                    <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}
                    </flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:header>

    <!-- Mobile Menu -->
    <flux:sidebar stashable sticky
        class="lg:hidden border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

        <a href="{{ route('dashboard') }}" class="ms-1 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
            <x-app-logo />
        </a>

        <flux:navlist variant="outline">
            <flux:navlist.group :heading="__('Platform')">
                <flux:navlist.item icon="layout-grid" :href="route('dashboard')"
                    :current="request()->routeIs('dashboard')" wire:navigate>
                    {{ __('Dashboard') }}
                </flux:navlist.item>
            </flux:navlist.group>
            @if(auth()->user()->hasRole('administrator'))
                <flux:navlist.group :heading="__('Menu')">
                    <flux:navlist.item icon="cube" href="#">Logistic</flux:navlist.item>
                    <flux:navlist.item icon="clipboard-document-list" href="#">Operations</flux:navlist.item>
                    <flux:navlist.item icon="users" href="#">Employee</flux:navlist.item>
                    <flux:navlist.item icon="chart-bar" href="#">Reporting</flux:navlist.item>
                    <flux:navlist.item icon="user-group" href="#">User Management</flux:navlist.item>
                </flux:navlist.group>
            @endif
        </flux:navlist>

        <flux:spacer />

        <flux:navlist variant="outline">
            <flux:navlist.item icon="folder-git-2" href="https://github.com/laravel/livewire-starter-kit"
                target="_blank">
                {{ __('Repository') }}
            </flux:navlist.item>

            <flux:navlist.item icon="book-open-text" href="https://laravel.com/docs/starter-kits#livewire"
                target="_blank">
                {{ __('Documentation') }}
            </flux:navlist.item>
        </flux:navlist>
    </flux:sidebar>

    {{ $slot }}

    @fluxScripts

    <x-toaster-hub/>
</body>

</html>
