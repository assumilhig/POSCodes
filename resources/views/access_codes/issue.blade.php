<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-secondary-800 leading-tight">
            {{ __('Issue Access Codes') }}
        </h2>
    </x-slot>

    <div class="py-16">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            @include('_partials._alert')

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-secondary-200">
                    <div class="space-y-8">
                        <div class="space-y-5">
                            <h3 class="text-center text-3xl font-extrabold text-secondary-900">
                                {{ request()->session()->get('type') ?? 'Access Type' }}
                            </h3>
                            <div class="bg-secondary-700 text-secondary-300 p-5">
                                <p class="text-center text-xl font-medium font-mono tracking-wider">
                                    {{ request()->session()->get('code') ?? 'XXXXXXXXX' }}
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center justify-center space-x-5">
                            @forelse  ($access_types as $access_type)
                                <form method="POST"
                                    action="{{ route('access_codes.issue', ['type' => $access_type]) }}">
                                    @csrf
                                    <button type="submit"
                                        class="btn {{ $loop->odd ? 'btn-primary' : 'btn-secondary' }}">Request
                                        {{ $access_type }} Code</button>
                                </form>
                            @empty
                                <div class="mt-2 flex items-center text-sm text-center text-gray-500">
                                    {{ trans('messages.pos_codes.no_available') }}
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
