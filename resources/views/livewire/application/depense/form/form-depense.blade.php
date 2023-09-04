<div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="formDepenseModal" tabindex="-1" role="dialog" data-backdrop="static"
        data-keyboard="false" aria-labelledby="formDepenseModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formDepenseModalLabel">
                        NOUVELLE DEPENSE
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent='store'>
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <x-label value="{{ __('Description') }}" />
                                        <x-input class="" type='text' placeholder="Description"
                                            wire:model.defer='name' />
                                        @error('name')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <x-label value="{{ __('Source de la dépense') }}" />
                                                <x-select wire:model='depense_source_id'>
                                                    <option value="">Choisir...</option>
                                                    @foreach ($listDepenseSource as $source)
                                                        <option value="{{ $source->id }}">
                                                            {{ $source->name }}</option>
                                                    @endforeach
                                                </x-select>
                                                @error('depense_source_id')
                                                    <span class="error text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <x-label value="{{ __('Devise') }}" />
                                                <x-select wire:model='currency_id'>
                                                    <option value="">Choisir...</option>
                                                    @foreach ($listCurrency as $currency)
                                                        <option value="{{ $currency->id }}">
                                                            {{ $currency->currency }}
                                                        </option>
                                                    @endforeach
                                                </x-select>
                                                @error('currency_id')
                                                    <span class="error text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <x-label value="{{ __('Montant') }}" />
                                        <x-input class="" type='text' placeholder="Montant"
                                            wire:model.defer='amount' />
                                        @error('amount')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <x-button type="submit" class="btn btn-primary">Terminer</x-button>
                        <x-button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
