<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div>
                <a href="{{ route('index') }}">
                    <x-logo class="mx-auto h-12 w-auto fill-current text-primary-500" />
                </a>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-secondary-900">
                    Sign in to {{ config('app.name') }}
                </h2>
                <p class="mt-2 text-center text-sm text-secondary-600">
                    Or don't have an account yet?
                    <a href="{{ route('register') }}" class="font-medium text-primary-600 hover:text-primary-500">
                        Sign up
                    </a>
                </p>
            </div>
            <form class="mt-8 space-y-6" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="space-y-4">
                    @if (request()->session()->has('status'))
                        <div class="font-medium text-sm text-success-600">
                            {{ request()->session()->get('status') }}
                        </div>
                    @endif

                    <div>
                        <x-label for="email_address" />
                        <x-input name="email" id="email_address" type="email" class="block mt-1 w-full" required
                            autofocus />
                        <x-error field="email" />
                    </div>

                    <div>
                        <x-label for="password" />
                        <x-input name="password" id="password" type="password" class="block mt-1 w-full" required
                            autocomplete="current-password" />
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <x-checkbox id="remember_me" name="remember" />
                        <x-label for="remember_me" class="ml-2" />
                    </div>

                    <div class="text-sm">
                        <a href="{{ route('password.request') }}"
                            class="font-medium text-primary-600 hover:text-primary-500">
                            Forgot your password?
                        </a>
                    </div>
                </div>

                <div>
                    <button type="submit" class="btn btn-primary w-full">Sign in</button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
