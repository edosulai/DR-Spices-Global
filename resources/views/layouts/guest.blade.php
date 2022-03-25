<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('storage/images/favicon.png') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700">

    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    @livewireStyles

    <script src="{{ mix('js/head.js') }}"></script>
</head>

<body>
    {{ $slot }}

    <script src="{{ mix('js/app.js') }}" defer></script>

    @livewireScripts
</body>

</html>