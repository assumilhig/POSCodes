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
                    Your new password must be different from previous used passwords.
                </p>
            </div>
            <form class="mt-8 space-y-6" method="POST" action="{{ route('password.update') }}">
                @csrf
                <div class="space-y-4">
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                    <input type="hidden" name="email" value="{{ $request->email }}">

                    <div>
                        <x-label for="password" />
                        <x-input name="password" id="password" type="password" class="block mt-1 w-full" required />
                    </div>

                    <div>
                        <x-label for="confirm_password" />
                        <x-input name="password_confirmation" id="confirm_password" type="password"
                            class="block mt-1 w-full" required />
                    </div>
                </div>

                <div>
                    <button type="submit" class="btn btn-primary w-full">Reset Password</button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
