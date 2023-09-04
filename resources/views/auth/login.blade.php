<x-authentication-layout>
    <h1 class="text-3xl text-slate-800 font-bold mb-6">{{ __('Login') }}</h1>
    <!-- Form -->
    <form method="POST" action="/login">
        @csrf
        @foreach ($user as $item)
            <input type="hidden" name="user_id" value="{{ $item->id }}">
        @endforeach
        <div class="space-y-4">
            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" type="email" name="email" :value="old('email')" required autofocus
                    autocomplete="email" />
            </div>
            <div>
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" type="password" name="password" required autocomplete="current-password" />
            </div>
        </div>
        <div class="flex items-center justify-between mt-6">
            {{-- @if (Route::has('password.request'))
                <div class="mr-1">
                    <a class="text-sm underline hover:no-underline" href="{{ route('password.request') }}">
                        {{ __('Forgot Password?') }}
                    </a>
                </div>
            @endif --}}
            <x-jet-button class=" px-3 py-1.5 rounded-md">
                {{ __('Masuk') }}
            </x-jet-button>
        </div>
    </form>
    <x-jet-validation-errors class="mt-4" />
    <!-- Footer -->
    <div class="pt-5 mt-6 border-t border-slate-200">
        <div class="text-sm text-black">
            {{ __('Belum Memiliki Akun ?') }} <a class="font-medium text-indigo-700 hover:text-indigo-900"
                href="{{ route('register') }}">{{ __('Daftar') }}</a>
        </div>
        <!-- Warning -->
        <div class="mt-3">
            @if (session()->has('loginError'))
                <div class="bg-red-700 text-white font-bold text-center px-3 py-2 rounded">
                    {{ session('loginError') }}
                </div>
            @endif
        </div>
    </div>
</x-authentication-layout>
