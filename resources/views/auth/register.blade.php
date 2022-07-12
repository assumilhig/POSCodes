<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div>
                <a href="{{ route('index') }}">
                    <x-logo class="mx-auto h-12 w-auto fill-current text-primary-500" />
                </a>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-secondary-900">
                    Create account to {{ config('app.name') }}
                </h2>
                <p class="mt-2 text-center text-sm text-secondary-600">
                    Have an account?
                    <a href="{{ route('login') }}" class="font-medium text-primary-600 hover:text-primary-500">
                        Sign in
                    </a>
                </p>
            </div>
            <form class="mt-8 space-y-6" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="space-y-4">
                    <div>
                        <x-label for="last_name" />
                        <x-input name="last_name" id="last_name" type="text" class="block mt-1 w-full" required
                            autofocus />
                        <x-error field="last_name" />
                    </div>
                    <div>
                        <x-label for="first_name" />
                        <x-input name="first_name" id="first_name" type="text" class="block mt-1 w-full" required />
                        <x-error field="first_name" />
                    </div>

                    <div>
                        <x-label for="email_address" />
                        <x-input name="email" id="email_address" type="email" class="block mt-1 w-full" required />
                        <x-error field="email" />
                    </div>

                    <div>
                        <x-label for="password" />
                        <x-input name="password" type="password" class="block mt-1 w-full" required
                            autocomplete="new-password" />
                    </div>

                    <div>
                        <x-label for="confirm_password" />
                        <x-input name="password_confirmation" id="confirm_password" type="password"
                            class="block mt-1 w-full" required autocomplete="new-password" />
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary w-full">Create an account</button>
                    </div>
            </form>
        </div>
    </div>
</x-guest-layout>
