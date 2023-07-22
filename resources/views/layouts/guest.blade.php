<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{auth()->user()?auth()->user()->school->name:app_setting('app_name') }}</title>
        <link rel="icon" type="image/png" sizes="96x96" href="{{ auth()->user()? asset('storage/'.auth()->user()?->school->logo):asset('storage/'.app_setting('app_logo')) }}">
        @if(config('app.env' !='local'))
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.1/css/all.min.css"
                  integrity="sha512-3M00D/rn8n+2ZVXBO9Hib0GKNpkm8MSUU/e2VNthDyBYxKWG+BftNYYcuEjXlyrSO637tidzMBXfE7sQm0INUg=="
                  crossorigin="anonymous" referrerpolicy="no-referrer" />
        @endif
        @stack('css')
        @vite(['resources/css/app.css','resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="hold-transition login-page" style="background: #0c84ff">
        {{ $slot }}
    </body>
</html>
