<input name="{{ $name }}" type="checkbox" id="{{ $id }}" @if($value)value="{{ $value }}" @endif {{ $checked ? 'checked'
    : '' }}
    {{ $attributes->merge(['class' => 'h-4 w-4 text-primary-600 focus:ring-primary-500 border-secondary-300 rounded']) }} />
