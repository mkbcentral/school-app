<div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="newReinscription" tabindex="-1" role="dialog"
        aria-labelledby="newReinscriptionLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="newReinscriptionLabel">
                        PASSE UNE NOUVELLE REINSCRIPTION
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent='store'>
                    <div class="modal-body">
                        @if ($student)
                            <div class="card p-2">
                                <h6><span class="text-bold text-info">Nom:</span>{{ $student->name }}</h6>
                                <h6><span class="text-bold text-info">Classe:</span></h6>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <x-label value="{{ __('Type option') }}" />
                                                        <x-select wire:model='classe_option_id'>
                                                            <option value="">Choisir...</option>
                                                            @foreach ($listClasseOption as $classOption)
                                                                <option value="{{ $classOption->id }}">{{ $classOption->name }}
                                                                </option>
                                                            @endforeach
                                                        </x-select>
                                                    </div>
                                                    @error('classe_option_id')
                                                    <span class="error text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <x-label value="{{ __('Type inscription') }}" />
                                                        <x-select wire:model.defer='cost_inscription_id'>
                                                            <option value="">Choisir...</option>
                                                            @foreach ($costInscriptionList as $cost)
                                                                <option value="{{ $cost->id }}">{{ $cost->name }}</option>
                                                            @endforeach
                                                        </x-select>
                                                    </div>
                                                    @error('cost_inscription_id')
                                                    <span class="error text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <x-label value="{{ __('Classe') }}" />
                                                        <x-select wire:model.defer='classe_id'>
                                                            <option value="">Choisir...</option>
                                                            @foreach ($classeList as $classe)
                                                                <option value="{{ $classe->id }}">
                                                                    {{ $classe->name . '/' . $classe->option->name }}</option>
                                                            @endforeach
                                                        </x-select>
                                                    </div>
                                                    @error('classe_id')
                                                    <span class="error text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Frais</th>
                                                @foreach($months as $month)
                                                    <th>{{$month}}</th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($listTypeCost as $type)
                                                <tr>
                                                    <td>{{$type->name}}</td>
                                                    @foreach($months as $m)
                                                        <td class="{{$type->getBgColor($m)}}">{{$type->getPayment($type->id,$student->id,$m)}}</td>
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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
