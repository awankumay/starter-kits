<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;

new class extends Component {

    use WithFileUploads;

    public string $name = '';
    public string $email = '';
    public $avatar;

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
        $this->avatar = Auth::user()->avatar ?? 'personal.jpg';
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($user->id)
            ],

            'avatar' => ['nullable', 'image', 'max:1024'], // max 1MB
        ]);

        // Hapus avatar dari $validated agar tidak di-fill ke user
        unset($validated['avatar']);

        // Proses upload avatar jika ada file baru
        if ($this->avatar && is_object($this->avatar)) {
            $avatarPath = $this->avatar->store('uploads/avatars', 'public');
            $user->avatar = $avatarPath; // hanya simpan path relatif, misal: uploads/avatars/xxxx.jpg
        }

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->dispatch('profile-updated', name: $user->name);
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function resendVerificationNotification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }
}; ?>

<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Profile')" :subheading="__('Update your name and email address')">
        <div class="flex flex-col min-w-[150px] min-h-[150px]">
            <div class="bg-white rounded-lg flex flex-col items-center justify-center"
                style="width:150px; height:150px;">
                <img
                    src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('personal.jpg') }}"
                    alt="Avatar"
                    class="object-cover rounded-full"
                    style="width:140px; height:140px;"
                    onerror="this.onerror=null;this.src='{{ asset('personal.jpg') }}';">
            </div>
            <div class="mt-4 w-full flex flex-col items-center">
                <flux:input type="file" wire:model="avatar" />
                @error('avatar')
                <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <form wire:submit="updateProfileInformation" class="my-6 w-full space-y-6">
            <flux:input wire:model="name" :label="__('Name')" type="text" required autofocus autocomplete="name" />

            <div>
                <flux:input wire:model="email" :label="__('Email')" type="email" required autocomplete="email" />

                @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail &&!
                auth()->user()->hasVerifiedEmail())
                <div>
                    <flux:text class="mt-4">
                        {{ __('Your email address is unverified.') }}

                        <flux:link class="text-sm cursor-pointer" wire:click.prevent="resendVerificationNotification">
                            {{ __('Click here to re-send the verification email.') }}
                        </flux:link>
                    </flux:text>

                    @if (session('status') === 'verification-link-sent')
                    <flux:text class="mt-2 font-medium !dark:text-green-400 !text-green-600">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </flux:text>
                    @endif
                </div>
                @endif
            </div>

            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit" class="w-full">{{ __('Save') }}</flux:button>
                </div>

                <x-action-message class="me-3" on="profile-updated">
                    {{ __('Saved.') }}
                </x-action-message>
            </div>
        </form>
        {{-- Removed Delete User! --}}
        {{-- <livewire:settings.delete-user-form /> --}}
    </x-settings.layout>
</section>
