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

            <form method="POST" action="{{ route('password.update') }}" class="px-40 m-auto">
                @csrf

                <x-auth-validation-errors class="mb-4" :errors="$errors"/>

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div>
                    <x-label for="email" :value="__('Email')"/>

                    <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                             :value="old('email', $request->email)" required autofocus/>
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-label for="password" :value="__('Password')"/>

                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required/>
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-label for="password_confirmation" :value="__('Confirm Password')"/>

                    <x-input id="password_confirmation" class="block mt-1 w-full"
                             type="password"
                             name="password_confirmation" required/>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-button>
                        {{ __('Reset Password') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
