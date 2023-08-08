<div>
    <form wire:submit.prevent="store">
        <div class="card" >
            <div class="card-header"><h5><i class="fas fa-users"></i> CREATION NOUVELLE FAMILLE</h5></div>
            <div CLASS="card-body">
                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <x-label value="{{ __('Nom de la famille') }}" />
                              <x-input class="" type='text' placeholder="Nom de la famille"
                                       wire:model.defer='name_responsable' />
                              @error('name_responsable')
                              <span class="error text-danger">{{ $message }}</span>
                              @enderror
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <x-label value="{{ __('Téléphone') }}" />
                              <x-input class="" type='text' placeholder="Tél"
                                       wire:model.defer='phone' />
                              @error('phone')
                              <span class="error text-danger">{{ $message }}</span>
                              @enderror
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <x-label value="{{ __('Autre Tél') }}" />
                              <x-input class="" type='text' placeholder="Autre tél"
                                       wire:model.defer='other_phone' />
                              @error('other_phone')
                              <span class="error text-danger">{{ $message }}</span>
                              @enderror
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <x-label value="{{ __('Adresse email') }}" />
                              <x-input class="" type='text' placeholder="Nom de la section"
                                       wire:model.defer='email' />
                              @error('email')
                              <span class="error text-danger">{{ $message }}</span>
                              @enderror
                          </div>
                      </div>
                  </div>
            </div>
            <div class="modal-footer">
                <x-button type="submit" class="btn btn-primary">
                    <span wire:loading wire:target="store" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    <i class="fas fa-save"></i> Sauvegarder
                </x-button>
            </div>
        </div>
    </form>
</div>
