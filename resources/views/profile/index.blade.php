<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-secondary-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('_partials._alert')

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-secondary-200">
                    <div class="mt-10 sm:mt-0">
                        <div class="md:grid md:grid-cols-3 md:gap-6">
                            <div class="md:col-span-1">
                                <div class="px-4 sm:px-0">
                                    <h3 class="text-lg font-medium leading-6 text-gray-900">Personal Information</h3>
                                    <p class="mt-1 text-sm text-gray-600">
                                        Use a permanent address where you can receive mail.
                                    </p>
                                </div>
                            </div>
                            <div class="mt-5 md:mt-0 md:col-span-2">
                                <form action="{{ route('profile.update') }}" method="POST">
                                    @csrf
                                    <div class="shadow overflow-hidden sm:rounded-md">
                                        <div class="px-4 py-5 bg-white sm:p-6">
                                            <div class="grid grid-cols-6 gap-6">
                                                <div class="col-span-6 sm:col-span-3">
                                                    <x-label for="last_name" />
                                                    <x-input name="last_name" id="last_name" type="text"
                                                        :value="auth()->user()->last_name" class="block mt-1 w-full"
                                                        required />
                                                    <x-error field="last_name" />
                                                </div>

                                                <div class="col-span-6 sm:col-span-3">
                                                    <x-label for="first_name" />
                                                    <x-input name="first_name" id="first_name" type="text"
                                                        :value="auth()->user()->first_name" class="block mt-1 w-full"
                                                        required />
                                                    <x-error field="first_name" />
                                                </div>

                                                <div class="col-span-6 sm:col-span-4">
                                                    <x-label for="email_address" />
                                                    <x-input name="email" id="email_address" type="email"
                                                        :value="auth()->user()->email" class="block mt-1 w-full"
                                                        required />
                                                    <x-error field="email" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="hidden sm:block" aria-hidden="true">
                        <div class="py-5">
                            <div class="border-t border-gray-200"></div>
                        </div>
                    </div>

                    <div class="mt-10 sm:mt-0">
                        <div class="md:grid md:grid-cols-3 md:gap-6">
                            <div class="md:col-span-1">
                                <div class="px-4 sm:px-0">
                                    <h3 class="text-lg font-medium leading-6 text-gray-900">Change Password</h3>
                                    <p class="mt-1 text-sm text-gray-600">
                                        Your new password must be different from previous used passwords.
                                    </p>
                                </div>
                            </div>
                            <div class="mt-5 md:mt-0 md:col-span-2">
                                <form action="{{ route('profile.changePassword') }}" method="POST">
                                    @csrf
                                    <div class="shadow overflow-hidden sm:rounded-md">
                                        <div class="px-4 py-5 bg-white sm:p-6">
                                            <div class="grid grid-cols-6 gap-6">
                                                <div class="col-span-6 sm:col-span-4">
                                                    <x-label for="current_password" />
                                                    <x-input name="current_password" id="current_password"
                                                        type="password" class="block mt-1 w-full" required />
                                                    <x-error field="current_password" />
                                                </div>

                                                <div class="col-span-6 sm:col-span-3">
                                                    <x-label for="new_password" />
                                                    <x-input name="password" id="new_password" type="password"
                                                        class="block mt-1 w-full" required />
                                                    <x-error field="password" />
                                                </div>

                                                <div class="col-span-6 sm:col-span-3">
                                                    <x-label for="confirm_password" />
                                                    <x-input name="password_confirmation" id="confirm_password"
                                                        type="password" class="block mt-1 w-full" required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                            <button type="submit" class="btn btn-primary">Change password</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
