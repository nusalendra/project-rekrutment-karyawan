<x-authentication-layout>
    <h1 class="text-3xl text-slate-800 dark:text-slate-100 font-bold mb-6">{{ __('Pendaftaran Akun') }}</h1>
    <!-- Form -->
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="space-y-4">
            <div>
                <x-jet-label for="name">{{ __('Nama Lengkap') }} <span
                        class="text-rose-500">*</span></x-jet-label>
                <x-jet-input id="name" type="text" name="name" :value="old('name')" required
                    autofocus autocomplete="name" />
            </div>

            <div>
                <x-jet-label for="email">{{ __('Email') }} <span class="text-rose-500">*</span></x-jet-label>
                <x-jet-input id="email" type="email" name="email" :value="old('email')" required />
            </div>

            <div>
                <x-jet-label for="password">{{ __('Password') }} <span class="text-rose-500">*</span></x-jet-label>
                <x-jet-input id="password" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div>
                <x-jet-label for="password_confirmation">{{ __('Konfirmasi Password') }} <span
                        class="text-rose-500">*</span></x-jet-label>
                <x-jet-input id="password_confirmation" type="password" name="password_confirmation" required
                    autocomplete="new-password" />
            </div>
        </div>
        <div class="flex items-center justify-between mt-6">
            <x-jet-button>
                {{ __('Sign Up') }}
            </x-jet-button>
        </div>
    </form>
    <x-jet-validation-errors class="mt-4" />
    <!-- Footer -->
    <div class="pt-5 mt-6 border-t border-slate-200">
        <div class="text-sm">
            {{ __('Have an account?') }} <a class="font-medium text-indigo-500 hover:text-indigo-600"
                href="{{ route('login') }}">{{ __('Sign In') }}</a>
        </div>
    </div>
</x-authentication-layout>
