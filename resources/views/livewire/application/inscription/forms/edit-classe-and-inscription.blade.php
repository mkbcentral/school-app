<div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="editClasseAnInscription" tabindex="-1" role="dialog"
        aria-labelledby="showStudentInfosLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showStudentInfosLabel">
                        MODIFICATION CLASSE OU INSCRIPTION
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent='update'>
                    <div class="modal-body">
                        @if ($inscription)
                            <div class="card p-2">
                                <h6><span class="text-bold text-info">Nom:</span>{{$inscription->student->name}}</h6>
                                <h6><span class="text-bold text-info">Classe:</span>{{$inscription->classe->name}}</h6>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <x-label value="{{ __('Classe') }}" />
                                                <x-select wire:model.defer='classe_id'>
                                                    <option value="">Choisir...</option>
                                                    @foreach ($classeList as $classe)
                                                        <option value="{{ $classe->id }}">
                                                            {{ $classe->name . '/' . $classe->classeOption->name }}</option>
                                                    @endforeach
                                                </x-select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <x-label value="{{ __('Type inscription') }}" />
                                                <x-select wire:model.defer='cost_inscription_id '>
                                                    <option value="">Choisir...</option>
                                                    @foreach ($costInscriptionList as $cost)
                                                        <option value="{{ $cost->id }}">{{ $cost->name }}</option>
                                                    @endforeach
                                                </x-select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <x-label value="{{ __('Date de paiment') }}" />
                                                <x-input class="" type='date' placeholder="Date de paiement"
                                                    wire:model.defer='created_at' />
                                                @error('created_at')
                                                    <span class="error text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <x-button type="submit" class="btn btn-primary">Sauvegarder</x-button>
                        <x-button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
