<div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="showListInscriptionPaymentByDateModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
         aria-labelledby="showListInscriptionPaymentByDateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showListInscriptionPaymentByDateModalLabel">LISTE PAIEMENT INSCRIPTIONS JOURNALIERES</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-end">
                        <div class="col-md-4">
                            <div class="form-group">
                                <x-label value="{{ __('Filtrer par date') }}" />
                                <x-input class="" type='date' placeholder="Lieu de naissance"
                                         wire:model='date_to_search' />
                            </div>
                        </div>
                    </div>
                    @php
                        $total=0;
                    @endphp
                    <div>
                        <div wire:loading wire:target="updatedDateToSearch">
                            Processing Payment...
                        </div>
                        @if ($inscriptions->isEmpty())
                            <span class="text-success text-center p-4">
                                <h4><i class="fa fa-database" aria-hidden="true"></i>
                                    Aucune donnée trouvée !
                                </h4>
                            </span>
                        @else
                            <table class="table table-stripped table-sm">
                                <thead class="thead-light">
                                <tr class="text-uppercase">
                                    <th>Noms élève</th>
                                    <th class="text-center">Genre</th>
                                    <th class="text-center">Montant</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($inscriptions as $inscription)
                                    <tr>
                                        <td>{{ $inscription->student->name . '/' . $inscription->classe->name . ' ' . $inscription->classe->classeOption->name }}
                                        </td>

                                        <td class="text-center">{{ $inscription->student->gender }}
                                        </td>
                                        <td class="text-center">
                                            {{ $inscription->amount }} {{$defaultCureencyName}}
                                        </td>
                                        <td class="text-center">
                                            <span class="badge badge-{{$inscription->getPaiementStatusColor($inscription)}}">{{$inscription->getPaiementStatus($inscription)}}</span>
                                        </td>
                                        <td class="text-center">
                                            <x-button wire:click.prevent='printBill({{ $inscription }})'
                                                      class="btn-sm text-info" type="button">
                                                <i class="fas fa-print" aria-hidden="true"></i>
                                            </x-button>
                                        </td>
                                    </tr>
                                    @php
                                        $total+=$inscription->amount;
                                    @endphp
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <h3 class="text-uppercase text-primary">Total: {{$total}} {{$defaultCureencyName}}</h3>
                </div>
            </div>
        </div>
    </div>
</div>
