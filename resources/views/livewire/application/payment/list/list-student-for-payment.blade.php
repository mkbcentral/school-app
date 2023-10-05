<div>
    @livewire('application.payment.form.add-new-payment')
    <div class="card">
        <div>
            <div class="p-2">
                <h4 class="text-uppercase text-bold">LISTE DES ELEVES</h4>
                <div class="w-75">
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <input wire:model.debounce.500ms='keySearch' type="text"
                                   class="form-control" placeholder="Recheche ici...">
                            <div class="input-group-append">
                                <div class="btn btn-primary">
                                    <i class="fas fa-search"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if ($listInscription->isEmpty())
                <span class="text-success text-center p-4">
                    <h4><i class="fa fa-database" aria-hidden="true"></i>
                        Aucune donnée trouvée !
                    </h4>
                </span>
            @else
                <div class="p-2">
                    <table class="table table-stripped table-sm">
                        <thead class="bg-primary">
                        <tr class="text-uppercase">
                            <th>Noms élève</th>
                            <th class="text-center">Genre</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                       @foreach ($listInscription as $inscription)
                        <tr>
                            <td>{{ $inscription?->student->name }}{{$inscription->getStudentClasseName($inscription)}}
                            </td>
                            <td class="text-center">{{ $inscription->student->gender }}
                            </td>
                            <td class="text-center">
                                <x-button wire:click.prevent='show({{ $inscription->student }})'
                                          class="btn-sm btn-info" type="button" data-toggle="modal"
                                          data-target="#newPayment">
                                    Payer
                                </x-button>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $listInscription->links('livewire::bootstrap') }}
                </div>
            @endif
        </div>
    </div>
</div>
