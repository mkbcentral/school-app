<x-guest-layout>
    <div class="login-box">
        <!-- /.login-logo -->
        @if (session('status'))
            <div class="alert alert-danger" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="#" class="h1"><b></b>{{auth()->user()?'C.S'.$setting->app_name:app_setting('app_name') }}</a>
            </div>
            <div class="card-body">
                <x-validation-errors class="mb-4" />
                <div class="text-center">
                    <img class="img-circle" src="{{ auth()->user()? asset('storage/'.auth()->user()?->school->logo):asset('storage/'.app_setting('app_logo')) }}" alt="Logo" width="70px">
                </div>
                <form method="POST" action="{{ route('login') }}" autocomplete="off">
                    @csrf
                    <div class="input-group mb-3 @error('email') is-invalid border border-danger rounded @enderror">
                        <x-input type="email" class="" placeholder="Adresse mail" name="email" />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope text-primary"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3 @error('password') is-invalid border border-danger rounded @enderror">
                        <x-input type="password" placeholder="Adresse mail" placeholder="Mot de passe" class=""
                            name="password" />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock text-primary"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <x-button type="submit" class=" btn-primary btn-block">
                                Se connecter
                            </x-button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</x-guest-layout>
