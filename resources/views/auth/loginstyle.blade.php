<x-guest-layout>
    {{-- <x-jet-authentication-card>--}}
    {{--<x-slot name="logo">
        <x-jet-authentication-card-logo />
    </x-slot>--}}

    <x-jet-validation-errors class="mb-4" />

    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-jet-label for="email" value="{{ __('strings.email') }}" />
            <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
        </div>

        <div class="mt-4">
            <x-jet-label for="password" value="{{ __('strings.password') }}" />
            <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
        </div>

        <div class="block mt-4">
            <label for="remember_me" class="flex items-center">
                <x-jet-checkbox id="remember_me" name="remember" />
                <span class="ml-2 text-sm text-gray-600">{{ __('strings.remember_me') }}</span>
            </label>
        </div>
        <button class="btn btn-dark block mt-1 w-full">
            {{ __('strings.login') }}
        </button>
        <br>
        @if (Route::has('password.request'))
            <a class="text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                {{ __('strings.forgot_your_password') }}
            </a>
        @endif

        {{--@if (Route::has('register'))
            <p>Don't have an account?  <a href="{{ route('register') }}" class="underline">Register</a></p>
        @endif--}}

        {{--<div class="row">
            <div class="col">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>
            <div class="col text-right">
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                @endif
            </div>
        </div>--}}



        {{--<div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-jet-button class="ml-4">
                {{ __('Log in') }}
            </x-jet-button>
        </div>--}}
    </form>
    {{--</x-jet-authentication-card>--}}
</x-guest-layout>
