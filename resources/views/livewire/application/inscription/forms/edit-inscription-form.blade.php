<div>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="formEditInscriptionModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
        aria-labelledby="formEditInscriptionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                @if ($student)
                    <div class="modal-header">
                        <h5 class="modal-title" id="formEditInscriptionModalLabel">MISE A JOUR FICHE</h5>
                        <button wire:click.prevent='resetFrom' type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span class="text-danger" aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form wire:submit.prevent='update'>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <x-label value="{{ __('Nom complet élève') }}" />
                                        <x-input class="" type='text' placeholder="Nom de la section"
                                            wire:model.defer='name' />
                                        @error('name')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <x-label value="{{ __('Date de naissance/'.$age) }}" />
                                        <x-input class="" type='date'
                                                 wire:model.defer='date_of_birth' />
                                        @error('date_of_birth')
                                        <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <x-label value="{{ __('Genre/Sexe') }}" />
                                        <x-select wire:model.defer='gender'>
                                            <option value="">Choisir...</option>
                                            @foreach ($genderList as $gender)
                                                <option value="{{ $gender->slug }}">{{ $gender->name }}</option>
                                            @endforeach
                                        </x-select>
                                    </div>
                                    @error('gender')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <x-label value="{{ __('Lieu de naissance') }}" />
                                        <x-input class="" type='text' placeholder="Lieu de naissance"
                                            wire:model.defer='place_of_birth' />
                                        @error('place_of_birth')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <x-label value="{{ __('Nom du responsable') }}" />
                                        <x-input class="" type='text' placeholder="Nom du responsable"
                                            wire:model.defer='name_responsable' />
                                        @error('name_responsable')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <x-label value="{{ __('Téléphone') }}" />
                                        <x-input class="" type='text' placeholder="Tél"
                                            wire:model.defer='phone' />
                                        @error('phone')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
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
                            <x-button type="submit" class="btn btn-primary">Sauvegarder</x-button>
                            <x-button wire:click.prevent='resetFrom' type="button" class="btn btn-danger" data-dismiss="modal">Annuler</x-button>
                        </div>
                    </form>
                @else
                    <span class="text-center" wire:loading>Chargement en cours...</span>
                @endif
            </div>
        </div>
    </div>

</div>
