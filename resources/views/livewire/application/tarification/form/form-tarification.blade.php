<div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="formTarifModal" tabindex="-1" role="dialog" data-backdrop="static"
        data-keyboard="false" aria-labelledby="formTarifModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formTarifModalLabel">
                        {{ $isEditing == false ? 'NOUVEAU TARIF' : 'EDITION TARIF' }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="d-flex justify-content-center">
                    <span wire:loading class="spinner-border" role="status" aria-hidden="true"></span>
                </div>
                <form
                    @if ($isEditing == false) wire:submit.prevent='store'
                     @else wire:submit.prevent='update' @endif>
                    <div class="modal-body  wire:loading.class='d-none'">
                        <div class="card-body">
                            <div class="form-group">
                                <x-label value="{{ __('Nom frais') }}" />
                                <x-input class="" type='text' placeholder="Nom frais"
                                    wire:model.defer='name' />
                                @error('name')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <x-label value="{{ __('Montant') }}" />
                                <x-input class="" type='text' placeholder="Montant"
                                    wire:model.defer='amount' />
                                @error('amount')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <x-label value="{{ __('Devise') }}" />
                                        <x-select wire:model.defer='currency_id'>
                                            <option value="">Choisir...</option>
                                            @foreach ($listCurrency as $currency)
                                                <option value="{{ $currency->id }}">
                                                    {{ $currency->currency }}</option>
                                            @endforeach
                                        </x-select>
                                        @error('currency_id')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <x-label value="{{ __('Type frais') }}" />
                                        <x-select wire:model.defer='type_other_cost_id'>
                                            <option value="">Choisir...</option>
                                            @foreach ($listOtherTYpeCost as $otherCost)
                                                <option value="{{ $otherCost->id }}">
                                                    {{ $otherCost->name }}</option>
                                            @endforeach
                                        </x-select>
                                        @error('type_other_cost_id')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <x-label value="{{ __('Option ') }}" />
                                <x-select wire:model.defer='classe_option_id'>
                                    <option value="">Choisir...</option>
                                    @foreach ($listClasseOption as $option)
                                        <option value="{{ $option->id }}">
                                            {{ $option->name }}</option>
                                    @endforeach
                                </x-select>
                                @error('classe_option_id')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <x-button type="submit" class="btn btn-primary">
                            {{ $isEditing == false ? 'Sauvegarder' : 'Modifier' }}
                        </x-button>
                        <x-button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
