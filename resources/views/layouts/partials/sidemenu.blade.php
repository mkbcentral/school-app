<aside class="main-sidebar sidebar-dark-primary  elevation-4">
    <a href="/" class="brand-link">
        <img src="{{ auth()->user()? asset('storage/'.auth()->user()?->school->logo):asset('storage/'.app_setting('app_logo')) }}" alt="Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light text-upercase">
            {{auth()->user()?auth()->user()->school->name:app_setting('app_name') }}
        </span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @livewire('application.navigation.application-link-menu-sub')
            </ul>
        </nav>
    </div>
</aside>
