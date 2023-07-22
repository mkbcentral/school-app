<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{auth()->user()?auth()->user()->school->name:app_setting('app_name') }}</title>
    <link rel="icon" type="image/png" sizes="96x96" href="{{ auth()->user()? asset('storage/'.auth()->user()?->school->logo):asset('storage/'.app_setting('app_logo')) }}">
    <link rel="stylesheet" href="{{ asset('chargement.css') }}">
    @if(config('app.env' !='local'))
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.1/css/all.min.css"
              integrity="sha512-3M00D/rn8n+2ZVXBO9Hib0GKNpkm8MSUU/e2VNthDyBYxKWG+BftNYYcuEjXlyrSO637tidzMBXfE7sQm0INUg=="
              crossorigin="anonymous" referrerpolicy="no-referrer" />
    @endif
    <script src="{{ asset('moment/moment.min.js') }}"></script>
    @stack('css')
    @vite(['resources/css/app.css', 'resources/js/app.js','resources/css/table.css'])
    @livewireStyles
</head>
<body class="hold-transition sidebar-mini {{theme_setting('is_dark_mode')?'dark-mode':''}}  {{theme_setting('is_sidebar_collapse')?'sidebar-collapse':''}}">
    <div class="wrapper">
        @include('layouts.partials.navbar')
        @include('layouts.partials.sidemenu')
        <div class="content-wrapper card">
            <div class="content">
                <div class="card">
                    <div class="card-body">
                        @livewire('application.school.switch-theme-widget')
                        {{$slot}}
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.partials.footer')
    </div>
    @stack('js')
    @livewireScripts
</body>

</html>
