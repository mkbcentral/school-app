<div>
    @foreach (Auth::user()->subAppLinks as $menu)
    <x-nav-link class="nav-link" href="{{ route($menu->link) }}" :active="request()->routeIs($menu->link)">
        <i class="fa {{ $menu->icon }}"></i>
        <p>{{ $menu->name }}</p>
    </x-nav-link>
@endforeach
        <x-nav-link class="nav-link" href="{{route('settings.app.links')}}" :active="request()->routeIs('settings.app.links')">
            <i class="fas fa-cog"></i>
            <p>Paramètres de menu</p>
        </x-nav-link>
</div>
