@foreach (['success', 'warning', 'error'] as $type)
    <x-alert :type="$type" class="mb-3">
        @if ($type === 'warning')
            <div class="w-full py-2 px-4 bg-warning-50 rounded-md" x-data="{}">
                <div class="flex items-center justify-between container mx-auto">
                    <div class="flex items-center space-x-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-warning-400" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                        </svg>

                        <span class="font-medium text-sm text-warning-700">
                            {{ $component->message() }}
                        </span>
                    </div>
                    <button type="button" class="text-xl" data-dismiss="alert" aria-hidden="true"
                        @click="$root.remove()">
                        &times;
                    </button>
                </div>
            </div>
        @elseif ($type === 'error')
            <div class="w-full py-2 px-4 bg-danger-50 rounded-md" x-data="{}">
                <div class="flex items-center justify-between container mx-auto">
                    <div class="flex items-center space-x-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-danger-400" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="font-medium text-sm text-danger-700">
                            {{ $component->message() }}
                        </span>
                    </div>
                    <button type="button" class="text-xl" data-dismiss="alert" aria-hidden="true"
                        @click="$root.remove()">
                        &times;
                    </button>
                </div>
            </div>
        @else
            <div class="w-full py-2 px-4 bg-success-100 rounded-md" x-data="{}">
                <div class="flex items-center justify-between container mx-auto">
                    <div class="flex items-center space-x-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-success-500" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="font-medium text-sm text-success-600">
                            {{ $component->message() }}
                        </span>
                    </div>
                    <button type="button" class="text-xl" data-dismiss="alert" aria-hidden="true"
                        @click="$root.remove()">
                        &times;
                    </button>
                </div>
            </div>
        @endif
    </x-alert>
@endforeach
