<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
<div class="font-sans text-gray-900">
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
                    Finish
                </h1>

                <h2 class="text-xl font-semibold mb-4">
                    Proceed to the questionnaire
                </h2>

                <p class="font-light mb-8">
                    Please go now back to the questionnaire with the link you used before.
                </p>
            </form>
        </div>
    </div>
</div>
</body>
</html>
