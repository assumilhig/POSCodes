<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-secondary-800 leading-tight">
            Access Codes
        </h2>
    </x-slot>

    <div class="py-12 space-y-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('_partials._alert')

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-secondary-200">
                    <div>
                        <h2 class="text-lg font-medium leading-6 text-gray-900">Import Access Code</h2>
                        <div class="mt-5">
                            <form action="{{ route('access_codes.store') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf

                                <div>
                                    <input type="file" name="access_code_file" id="access_code_file"
                                        class="bg-white py-2 px-4 border w-full border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" />
                                    <x-error field="access_code_file" />
                                </div>
                                <div class="mt-3 flex justify-end items-center">
                                    <button type="submit" class="btn btn-primary">Import</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-secondary-200">
                    <livewire:access-code-table />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
