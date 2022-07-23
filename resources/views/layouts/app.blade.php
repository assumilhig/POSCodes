<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('_partials._head')

<body>
    <div class="min-h-screen">
        <nav x-data="{ open: false }" class="bg-white border-b border-secondary-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="flex-shrink-0 flex items-center">
                            <a href="{{ route('home') }}">
                                <x-logo class="block h-10 w-auto fill-current text-primary-600" />
                            </a>
                        </div>

                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            @foreach ($sharedNavigations as $navigation)
                                @if (!$navigation['with_dropdown'])
                                    @foreach ($navigation['content'] as $content)
                                        <x-nav.link :href="$content['href']" :active="$content['active']">
                                            {{ $content['name'] }}
                                        </x-nav.link>
                                    @endforeach
                                @else
                                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                                        <x-dropdown :align="$navigation['align']" width="48">
                                            <x-slot name="trigger">
                                                <button
                                                    class="flex items-center text-sm font-medium text-secondary-500 hover:text-secondary-700 hover:border-secondary-300 focus:outline-none focus:text-secondary-700 focus:border-secondary-300 transition duration-150 ease-in-out">
                                                    <div>{{ $navigation['parent_name'] }}</div>
                                                    <div class="ml-1">
                                                        <svg class="fill-current h-4 w-4"
                                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd"
                                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    </div>
                                                </button>
                                            </x-slot>
                                            <x-slot name="content">
                                                @foreach ($navigation['content'] as $content)
                                                    <a class="dropdown link" href="{{ $content['href'] }}">
                                                        {{ $content['name'] }}
                                                    </a>
                                                @endforeach
                                            </x-slot>
                                        </x-dropdown>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="flex items-center text-sm font-medium text-secondary-500 hover:text-secondary-700 hover:border-secondary-300 focus:outline-none focus:text-secondary-700 focus:border-secondary-300 transition duration-150 ease-in-out">
                                    <div>{{ Auth::user()->name }}</div>

                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                @foreach ($sharedProfileNavigations as $profile)
                                    <a class="dropdown link" href="{{ $profile['href'] }}">
                                        {{ $profile['name'] }}
                                    </a>
                                @endforeach
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a class="dropdown link" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();this.closest('form').submit();">
                                        Log Out
                                    </a>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>

                    <div class="-mr-2 flex items-center sm:hidden">
                        <button @click="open = ! open"
                            class="inline-flex items-center justify-center p-2 rounded-md text-secondary-400 hover:text-secondary-500 hover:bg-secondary-100 focus:outline-none focus:bg-secondary-100 focus:text-secondary-500 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
                <div class="pt-2 pb-3 space-y-1">
                    @foreach ($sharedNavigations as $navigation)
                        @if ($navigation['with_dropdown'])
                            <div class="pt-4 pb-1 border-t border-secondary-200">
                                <div class="px-2">
                                    <div class="font-medium text-sm text-secondary-500">
                                        {{ $navigation['parent_name'] }}
                                    </div>
                                </div>
                            </div>
                        @endif
                        @foreach ($navigation['content'] as $content)
                            <x-nav.responsive :href="$content['href']" :active="$content['active']">
                                {{ $content['name'] }}
                            </x-nav.responsive>
                        @endforeach
                    @endforeach
                </div>

                <!-- Responsive Settings Options -->
                <div class="pt-4 pb-1 border-t border-secondary-200">
                    <div class="px-4">
                        <div class="font-medium text-base text-secondary-800">{{ auth()->user()->name }}</div>
                        <div class="font-medium text-sm text-secondary-500">{{ auth()->user()->email }}</div>
                    </div>

                    <div class="mt-3 space-y-1">
                        @foreach ($sharedProfileNavigations as $profile)
                            <x-nav.responsive :href="$profile['href']">
                                {{ $profile['name'] }}
                            </x-nav.responsive>
                        @endforeach
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-nav.responsive :href="route('logout')"
                                onclick="event.preventDefault();this.closest('form').submit();">
                                Log Out
                            </x-nav.responsive>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Heading -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
</body>

</html>
