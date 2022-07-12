@error($field, $bag)
<div {{ $attributes->merge(['class' => 'mt-1 text-sm text-danger-600 font-medium']) }}>
    @if ($slot->isEmpty())
    {{ $message }}
    @else
    {{ $slot }}
    @endif
</div>
@enderror
