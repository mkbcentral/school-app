<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'MASOMO') }}</title>
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('logo.jpg') }}">
    @if(config('app.env' !='local'))
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    @endif
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="hold-transition py-4 bg-info">
    <div class="d-flex justify-content-center align-items-center">
        @livewire('application.navigation.application-link-menu')
    </div>
    @livewireScripts
</body>

</html>
