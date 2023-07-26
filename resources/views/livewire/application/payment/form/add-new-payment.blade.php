<div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="newPayment" tabindex="-1" role="dialog"
         aria-labelledby="newPaymentLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newPaymentLabel">
                       <i class="fas fa-plus-circle"></i> PASSE UN NOUVEAU PAIEMENT
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
                                <h6><span class="text-bold text-info">Classe: {{$student->inscription->getStudentClasseName($student->inscription)}}</span></h6>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <x-label value="{{ __('Type frais') }}" />
                                                <x-select wire:model='type_other_cost_id'>
                                                    <option value="">Choisir...</option>
                                                    @foreach ($listTypeCost as $type)
                                                        <option value="{{ $type->id }}">{{ $type->name }}
                                                        </option>
                                                    @endforeach
                                                </x-select>
                                            </div>
                                            @error('type_other_cost_id')
                                            <span class="error text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <x-label value="{{ __('Frais') }}" />
                                                <x-select wire:model.defer='cost_other_id'>
                                                    <option value="">Choisir...</option>
                                                    @foreach ($listOtherCost as $cost)
                                                        <option value="{{ $cost->id }}">{{ $cost->name }}</option>
                                                    @endforeach
                                                </x-select>
                                            </div>
                                            @error('cost_other_id')
                                            <span class="error text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <x-label value="{{ __('Mois') }}" />
                                                <x-select wire:model.defer='month'>
                                                    <option value="">Choisir...</option>
                                                    @foreach ($months as $month)
                                                        <option value="{{ $month }}">{{ app_get_month_name($month) }}</option>
                                                    @endforeach
                                                </x-select>
                                            </div>
                                            @error('month')
                                            <span class="error text-danger">{{ $message }}</span>
                                            @enderror
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
