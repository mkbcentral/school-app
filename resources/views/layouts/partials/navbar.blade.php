<nav class="main-header navbar navbar-expand {{theme_setting('is_dark_mode')?'navbar-dark':'navbar-white'}} navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item mr-4">
            <div class="d-flex  align-items-center ">
               <span class="mr-2 text-bold text-danger">Devise</span>
                @livewire('application.school.currency-widget')
                <span class="mr-2 text-bold pl-4 text-bold text-primary">Année scolaire</span>
            @livewire('application.school.scolary-year-widget')
            </div>
        </li>
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">

                @if ( config('app.env')=='production')
                    <img src="{{ asset('public/defautl-user.jpg') }}"
                            class="user-image img-circle elevation-2" alt="User Image">
                @else
                    <img src="{{ asset('defautl-user.jpg') }}"
                        class="user-image img-circle elevation-2" alt="User Image">

                @endif
                <span class="d-none d-md-inline">{{Auth::user()->name}}<span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <!-- User image -->
              <li class="user-header bg-primary">
                    @if (config('app.env')=='production')
                        <img src="{{ asset('public/defautl-user.jpg') }}"
                        class="img-circle elevation-2" alt="User Image">
                    @else
                        <img src="{{ asset('defautl-user.jpg') }}"
                        class="img-circle elevation-2" alt="User Image">
                    @endif
                <p>
                  <small>{{Auth::user()->name}}</small>
                </p>
              </li>

              <!-- Menu Footer-->
              <li class="user-footer">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                        <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        this.closest('form').submit();" class="btn btn-default btn-flat float-right">Déconnexion</a>
                </form>

              </li>
            </ul>
          </li>
    </ul>
</nav>
