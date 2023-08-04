<div>
    <h4 class="text-info text-uppercase text-bold"><i class="fas fa-user-plus"></i> Création compte</h4>
    <form wire:submit.prevent="registerUser" CLASS="mt-4">
        <div class="row">
            <div class="col-md-6 form-group">
                <label>Votre de famille</label>
                <div class="input-group @error('name') is-invalid border border-danger rounded @enderror">
                    <x-input style="height: 45px"
                             type="text"
                             class="form-control"
                             placeholder="Votre nom"
                             wire:model.defer="email" />
                </div>
                @error('name')
                <span class="error text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="row col-md-6 form-group">
                <label>Nom d'utilisateur</label>
                <div class="input-group @error('username') is-invalid border border-danger rounded @enderror">
                    <x-input style="height: 45px"
                             type="text"
                             class="form-control"
                             placeholder="Nom d'ulisateur"
                             wire:model.defer="username" />
                </div>
                @error('username')
                <span class="error text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 form-group">
                <label>Adresse mail</label>
                <div class="input-group @error('email') is-invalid border border-danger rounded @enderror">
                    <x-input style="height: 45px"
                             type="email"
                             class="form-control"
                             placeholder="Adresse mail"
                             wire:model.defer="email" />
                </div>
                @error('email')
                <span class="error text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="row col-md-6 form-group">
                <label>N° Téléphone</label>
                <div class="input-group @error('phone') is-invalid border border-danger rounded @enderror">
                    <x-input style="height: 45px"
                             type="text"
                             class="form-control"
                             placeholder="N° Tél"
                             wire:model.defer="phone" />
                </div>
                @error('phone')
                <span class="error text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 form-group">
                <label>Mot de passe</label>
                <div class="input-group @error('password') is-invalid border border-danger rounded @enderror">
                    <x-input style="height: 45px"
                             type="password"
                             class="form-control"
                             placeholder="Mot de passe"
                             wire:model.defer="password" />
                </div>
                @error('password')
                <span class="error text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="row col-md-6 form-group">
                <label>Confimer votre mot passe</label>
                <div class="input-group @error('password_confirmation') is-invalid border border-danger rounded @enderror">
                    <x-input style="height: 45px"
                             type="password"
                             class="form-control"
                             placeholder="Confirmer le mot de passe"
                             wire:model.defer="password_confirmation" />
                </div>
                @error('password_confirmation')
                <span class="error text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="d-flex justify-content-between">
            <div class="d-flex justify-content-end align-items-center">
                <span class="pr-2">Avez-vous un compte ? </span>
                <a href="{{route('login')}}" class="text-bold">Se connecter</a>
            </div>
            <x-button type="submit" class="btn-block w-25" style="background: #3088B1;color: white">
                <div wire:loading wire:target='loginUser' class="spinner-border spinner-border-sm text-white"
                     role="status"></div>
                Créer un compte
            </x-button>
            <!-- /.col -->
        </div>
    </form>
</div>
