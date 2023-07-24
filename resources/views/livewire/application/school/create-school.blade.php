<div>
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
               <h5 class="text-dark"> <i class="fas fa-school"></i> CREATION ECOLE</h5>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="store">
                    <div class="input-group  @error('name') is-invalid border border-danger rounded @enderror">
                        <x-input type="text" class="" placeholder="Nom de votre école" wire:model.defer="name" />
                    </div>
                    @error('name')
                    <span class="error text-danger">{{ $message }}</span>
                    @enderror
                    <div class="input-group mt-4 @error('email') is-invalid border border-danger rounded @enderror">
                        <x-input type="email" class="" placeholder="Adresse mail" wire:model.defer="email" />
                    </div>
                    @error('email')
                    <span class="error text-danger mt-2">{{ $message }}</span>
                    @enderror
                    <div class="input-group mt-4 @error('phone') is-invalid border border-danger rounded @enderror">
                        <x-input type="text" class="" placeholder="N° Tél" wire:model.defer="phone" />
                    </div>
                    @error('phone')
                    <span class="error text-danger mt-2">{{ $message }}</span>
                    @enderror
                    <div class="row mt-4">
                        <div class="col-12">
                            <x-button type="submit" class=" btn-primary btn-block">
                                <span wire:loading wire:target="store"
                                      class="spinner-border spinner-border-sm"
                                      role="status" aria-hidden="true">
                                </span>
                               Créer...
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
</div>
