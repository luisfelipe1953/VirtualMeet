<x-guest-layout>
    <x-jet-authentication-card>

        <x-slot name="logo">
            <div class="sm:flex sm:justify-end sm:container container-md mx-auto">
                <a class="btn-crear block sm:inline sm:mt-14 mt-0" href="/">
                    <i class="fa-solid fa-arrow-left"></i>
                    Volver
                </a>
            </div>

        </x-slot>

        @if (session('success'))
        <div class="alerta-exito">
            {{ session('success') }}
        </div>
        @endif
        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
        @endif

        <form method="POST" class="m-0" action="{{ route('login') }}">
            @csrf
            <h1 class="text-center text-2xl">Iniciar Session</h1>
            <p class="my-4">Iniciar session en VirtualMeet</p>
            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center space-x-28 mt-4">
                @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
                @endif

                <x-jet-button class="ml-4">
                    {{ __('Log in') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>