<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div>
                <a href="{{ route('index') }}">
                    <x-logo class="mx-auto h-12 w-auto fill-current text-primary-500" />
                </a>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-secondary-900">
                    Reset Password
                </h2>
                <p class="mt-2 text-sm text-secondary-600">
                    Forgot your password? No problem. Just let us know your email address and we will email you a
                    password reset link that will allow you to choose a new
                    one.
                </p>

            </div>
            <form class="mt-8 space-y-6" method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="space-y-4">
                    @if (request()->session()->has('status'))
                        <div class="font-medium text-sm text-success-600">
                            {{ request()->session()->get('status') }}
                        </div>
                    @endif

                    <div>
                        <x-label for="email_address" />
                        <x-input name="email" id="email_address" type="email" class="block mt-1 w-full" required />
                        <x-error field="email" />
                    </div>
                </div>

                <div>
                    <button type="submit" class="btn btn-primary w-full">Email Password Reset Link</button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
