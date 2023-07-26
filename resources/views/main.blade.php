<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{app_setting('app_name')?app_setting('app_name'):config('app.name') }}</title>
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset(app_setting('app_logo')?'storage/'.app_setting('app_logo'):'default-logo.jpg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="hold-transition py-4" style="background: url({{asset('my-bg.svg')}});background-size:cover;background-repeat: no-repeat">
    <div class="d-flex justify-content-center align-items-center">
        @livewire('application.navigation.application-link-menu')
    </div>
    @livewireScripts
</body>
</html>
