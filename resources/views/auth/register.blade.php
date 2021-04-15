<x-guest-layout>
    <div class="=container h-screen flex flex-row">
        <div class="w-1/3 min-h-screen bg-indigo-400 flex">
            <div class="m-auto flex flex-col items-center">
                <h2 class="text-center text-white font-bold text-3xl mb-14">
                    Experiment: <br>
                    Interactive Digital Narratives
                </h2>
                <img src="uva-white.png" alt="University of Amsterdam" class="max-w-xs">
            </div>
        </div>
        <div class="w-2/3 bg-gray-100 h-screen flex">
            <form method="POST" action="{{ route('register') }}" class="px-40 m-auto">
                @csrf

                <x-auth-validation-errors class="mb-4" :errors="$errors"/>

                <h1 class="text-3xl font-bold mb-14">
                    Register
                </h1>

                <h2 class="text-xl font-semibold mb-4">
                    Signup for part two of the experiment
                </h2>

                <p class="font-light mb-8">
                    Access the experiment by creating an account. This part of the experiment is seperate of the survey.
                    Only access the experiment when completed the first survey.
                </p>

                <!-- Name -->
                <div class="flex">
                    <div class="w-1/2 pr-10">
                        <x-input type="hidden" :value="$usertoken" name="user_token" id="user_token" />

                        <x-label for="first_name" :value="__('First Name')"/>

                        <x-input id="first_name" class="block mt-1 w-full" type="text" name="first_name"
                                 :value="$firstName" required
                                 autofocus/>
                    </div>

                    <div class="w-1/2 pl-10">
                        <x-label for="first_name" :value="__('Last Name')"/>

                        <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name"
                                 :value="$lastName" required
                                 autofocus/>
                    </div>
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-label for="email" :value="__('Email')"/>

                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                             required/>
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-label for="password" :value="__('Password')"/>

                    <x-input id="password" class="block mt-1 w-full"
                             type="password"
                             name="password"
                             required autocomplete="new-password"/>
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-label for="password_confirmation" :value="__('Confirm Password')"/>

                    <x-input id="password_confirmation" class="block mt-1 w-full"
                             type="password"
                             name="password_confirmation" required/>
                </div>

                <div class="flex flex-col items-end mt-4">
                    <x-button class="ml-4 mb-4 mt-8">
                        {{ __('Create an account') }}
                    </x-button>

                    <a class="font-bold text-sm text-gray-900" href="{{ route('login') }}">
                        {{ __('Already have an account?') }} <span class="text-blue-700">Log in</span>
                    </a>
                </div>
            </form>
        </div>
    </div>


    {{--    <x-auth-card>--}}
    {{--        <x-slot name="logo">--}}
    {{--            <a href="/">--}}
    {{--                <x-application-logo class="w-20 h-20 fill-current text-gray-500"/>--}}
    {{--            </a>--}}
    {{--        </x-slot>--}}

    {{--        <!-- Validation Errors -->--}}



    {{--    </x-auth-card>--}}
</x-guest-layout>
