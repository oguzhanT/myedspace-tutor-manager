<x-filament::page>
    <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-32 h-32 mb-6">

        <h2 class="text-3xl font-bold mb-6">Welcome to MyEdSpace</h2>

        <form method="POST" action="{{ route('login') }}" class="w-full max-w-sm">
            @csrf

            <!-- Your custom input fields, styling, etc. -->
            <input  name="email" type="email" placeholder="Email" required />
            <input name="password" type="password" placeholder="Password" required />

            <!-- Add custom buttons or links here -->
            <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded mt-4">
                Login
            </button>
        </form>

        <a href="{{ route('login') }}" class="mt-4 inline-block text-blue-500">
            Login with Social Account
        </a>
    </div>
</x-filament::page>
