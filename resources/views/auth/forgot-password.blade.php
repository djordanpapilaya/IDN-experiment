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
            <form method="POST" action="{{ route('password.email') }}" class="px-40 m-auto">
            @csrf

            <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')"/>

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors"/>


                <h1 class="text-3xl font-bold mb-14">
                    Forgot password
                </h1>

                <p class="font-light mb-8">
                    Forgot your password? No problem. Just let us know your email address and we will email you a
                    password
                    reset link that will allow you to choose a new one.
                </p>

                <!-- Email Address -->
                <div>
                    <x-label for="email" :value="__('Email')"/>

                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                             required
                             autofocus/>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-button>
                        {{ __('Email Password Reset Link') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
