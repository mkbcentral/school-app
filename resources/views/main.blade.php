<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'MASOMO') }}</title>
    @if (config('app.env') == 'production')
        <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('public/logo.jpg') }}">
        <link rel="stylesheet" href="{{ asset('public/build/assets/app.6ccd8cd5.css') }}">
        <link rel="stylesheet" href="{{ asset('public/build/assets/app.eb801204.css') }}">
        <script src="{{ asset('public/build/assets/app.0a5db875.js') }}"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.1/css/all.min.css"
            integrity="sha512-3M00D/rn8n+2ZVXBO9Hib0GKNpkm8MSUU/e2VNthDyBYxKWG+BftNYYcuEjXlyrSO637tidzMBXfE7sQm0INUg=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
    @else
        <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('logo.jpg') }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    @livewireStyles
</head>

<body class="hold-transition py-4 bg-info">
    <div class="d-flex justify-content-center align-items-center">
        @livewire('application.navigation.application-link-menu')
    </div>
    @livewireScripts
</body>

</html>
