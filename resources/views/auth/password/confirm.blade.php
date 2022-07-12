<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div>
                <a href="{{ route('index') }}">
                    <x-logo class="mx-auto h-12 w-auto fill-current text-primary-500" />
                </a>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-secondary-900">
                    Confirm Password
                </h2>
                <p class="mt-2 text-sm text-secondary-600">
                    This is a secure area of the application. Please confirm your password before continuing.
                </p>
            </div>
            <form class="mt-8 space-y-6" method="POST" action="{{ route('password.confirm') }}">
                @csrf
                <div class="space-y-4">
                    <x-label for="password" />
                    <x-input name="password" id="password" type="password" class="block mt-1 w-full" required
                        autocomplete="current-password" />
                </div>

                <div>
                    <button type="submit" class="btn btn-primary w-full">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
