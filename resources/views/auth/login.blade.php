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
                <img class="" src="{{asset('logo.svg')}}" alt="Logo">
            </div>
            <div class="card-body">
                <x-validation-errors class="mb-4" />
                <form method="POST" action="{{ route('login') }}" autocomplete="off">
                    @csrf
                    <div>
                        <label>Adresse mail</label>
                        <div class="input-group mb-3 @error('email') is-invalid border border-danger rounded @enderror">
                            <x-input style="height: 45px" type="email"
                                     class="form-control"
                                     placeholder="Adresse mail" name="email" />
                        </div>
                    </div>
                    <div>
                        <label>Mot de passe</label>
                        <div class="input-group mb-3 @error('password') is-invalid border border-danger rounded @enderror">
                            <x-input style="height: 45px" type="password"
                                     placeholder="Adresse mail"
                                     placeholder="Mot de passe"
                                     class="form-control bg-white"
                                     name="password" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <x-button type="submit" class="btn-block" style="background: #3088B1;color: white">
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
