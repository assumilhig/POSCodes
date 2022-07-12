<input
    {{ $attributes->merge(['class' => 'mt-2 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-secondary-300 rounded-md']) }}
    name="{{ $name }}" type="{{ $type }}" id="{{ $id }}" @if($value)value="{{ $value }}" @endif />
