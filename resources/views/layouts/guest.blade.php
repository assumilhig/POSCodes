<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('_partials._head')

<body>
    <div>
        {{ $slot }}
    </div>
</body>

</html>
