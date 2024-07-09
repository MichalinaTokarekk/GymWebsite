<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            
            <div>
                {{ __('Imię') }}
                <x-label for="imie" value="{{ __('Imię') }}" />
                <x-input id="imie" class="block mt-1 w-full" type="text" name="imie" :value="old('imie')" required autofocus />
            </div>
            
            <div class="mt-4">
                {{ __('Nazwisko') }}
                <x-label for="nazwisko" value="{{ __('Nazwisko') }}" />
                <x-input id="nazwisko" class="block mt-1 w-full" type="text" name="nazwisko" :value="old('nazwisko')" required />
            </div>
            <div class="mt-4">
                {{ __('translation.profile.email.name') }}
                <x-label for="email" value="{{ __('translation.account.email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                {{ __('translation.profile.password') }}
                <x-label for="password" value="{{ __('translation.password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                {{ __('translation.account.password_confirm') }}
                <x-label for="password_confirmation" value="{{ __('translation.account.password_confirm') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('translation.account.already_registered') }}
                </a>

                {{-- <x-button class="ml-4">
                    {{ __('translation.account.register') }}
                </x-button> --}}

                <button class="ml-4 bg-blue-300 padding=10px border-radius: 10px;">
                    {{ __('translation.account.register') }}
                </button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>