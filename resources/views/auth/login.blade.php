<x-guest-layout>
    <div class="=container h-screen flex flex-row">
        <div class="w-2/4 min-h-screen bg-indigo-400 flex">
            <div class="m-auto flex flex-col items-center">
                <h2 class="text-center text-white font-bold text-3xl mb-14">
                    Experiment: <br>
                    Interactive Digital Narratives
                </h2>
                <img src="uva-white.png" alt="University of Amsterdam" class="max-w-xs">
            </div>
        </div>
        <div class="w-2/4 bg-gray-100 h-screen flex">

            <form method="POST" action="{{ route('login') }}" class="px-40 m-auto">
            @csrf

            <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')"/>

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors"/>

                <h1 class="text-3xl font-bold mb-14">
                    Login
                </h1>

                <h2 class="text-xl font-semibold mb-4">
                    Login to your account
                </h2>

                <p class="font-light mb-8">
                    Re-access the experiment by login to your account. This part of the experiment is seperate of the
                    survey.
                </p>

                <!-- Email Address -->
                <div>
                    <x-label for="email" :value="__('Email')"/>

                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                             required autofocus/>
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-label for="password" :value="__('Password')"/>

                    <x-input id="password" class="block mt-1 w-full"
                             type="password"
                             name="password"
                             required autocomplete="current-password"/>
                </div>

                <!-- Remember Me -->
                <div class="block mt-4 flex flex-row justify-between">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox"
                               class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                               name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-blue-700"
                           href="{{ route('password.request') }}">
                            {{ __('Reset password') }}
                        </a>
                    @endif
                </div>

                <div class="flex flex-col items-end mt-4 block w-full">
                    <x-button class="mb-4 mt-8 block w-full text-center">
                        {{ __('Sign in') }}
                    </x-button>

                    <a class="font-bold text-sm text-gray-900 w-full text-center" href="{{ route('register') }}">
                        {{ __('completed survey 1 and not an account yet?') }} <span
                                class="text-blue-700">Sign up here</span>
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
