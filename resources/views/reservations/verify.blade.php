<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/dashboard">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        @if (session('error_message'))
            <x-alert :error_message="session('error_message')" />
        @endif
        <form method="POST" action="/reservations/verify">
            @csrf
            <!-- Reservation Code -->
            <div>
                <x-label for="reservation_code" :value="__('Reservation Code')" />

                <x-input id="reservation_code" class="block mt-1 w-full" name="reservation_code" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required />
            </div>


            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-3">
                    {{ __('Check in') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
