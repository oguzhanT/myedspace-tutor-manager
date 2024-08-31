<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Include your CSS files here -->
    <link rel="stylesheet" href="{{ asset('css/myedspace-theme.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body>
<header>

    <nav class="bg-gray-100 p-4">
        <div class="container mx-auto flex justify-between items-center">

            <a href="{{ route('tutors') }}" class="text-white">
                <img src="{{ asset('images/logo.svg') }}" alt="Logo" class="h-10 m-5">
            </a>
        </div>

    </nav>
</header>

<main class="py-4 bg-gray-100">
    @yield('content')
</main>

<footer>
    <div class="container mx-auto py-4 text-left text-gray-500">

       <div class="float-left">
            <h3> Copyright © Myedspace Limited 2024.</h3>
            <p> Registered company in England and Wales (number: 13805946).</p>
            <p>
       </div>
        <div class="flex space-x-4 mt-4 float-right">
            <a href="https://facebook.com" target="_blank">
                <img src="{{ asset('images/facebook.svg') }}" alt="Facebook" class="h-6">
            </a>
            <a href="https://twitter.com" target="_blank">
                <img src="{{ asset('images/twitter.svg') }}" alt="Twitter" class="h-6">
            </a>
            <a href="https://instagram.com" target="_blank">
                <img src="{{ asset('images/instagram.svg') }}" alt="Instagram" class="h-6">
            </a>
        </div>
    </div>
</footer>

@livewireScripts
</body>
</html>
