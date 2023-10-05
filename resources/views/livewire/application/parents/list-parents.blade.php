<div>
    @livewire('application.messaging.forms.send-new-sms-form')
    @include('livewire.application.inscription.modals.edit-familly-modal')
    @include('livewire.application.inscription.modals.list-student-in-familly-modal')
    <div>
        <div>
            <div class="mb-2">
                <h4 class="text-uppercase text-bold">LISTE DES FAMILLES</h4>
            </div>
            <div class="d-flex justify-content-between mb-2">
                <x-search-input />
                <x-button class="btn-success btn-sm" type="button" wire:click.prevent="sendBulkSMS">
                    <span wire:loading wire:target="sendBulkSMS" class="spinner-border spinner-border-sm" role="status"
                        aria-hidden="true"></span>
                    <i class="fab fa-telegram" aria-hidden="true"></i> Envoyer SMS
                </x-button>
            </div>
        </div>
        @if ($listResponsible->isEmpty())
            <span class="text-success text-center p-4">
                <h4><i class="fa fa-database" aria-hidden="true"></i>
                    Aucune donnée trouvée !
                </h4>
            </span>
        @else
            <table class="table table-stripped table-sm">
                <thead class="thead-light">
                    <tr class="text-uppercase">
                        <th class="text-center">#</th>
                        <th>NOM FAMILLE</th>
                        <th class="text-right">TELEPHONE</th>
                        <th class="text-center">NBRE ENFANT</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listResponsible as $index => $responsable)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $responsable->name_responsable }}</td>
                            <td class="text-right">{{ $responsable->phone }}</td>
                            <td class="text-center">{{ $responsable->students->count() }}</td>
                            <td class="text-center">
                                <x-button class="btn-primary btn-sm" type="button"
                                    wire:click.prevent="show({{ $responsable }})" data-toggle="modal"
                                    data-target="#lisStudentInFamillyModal">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </x-button>
                                <x-button class="btn-success btn-sm" type="button"
                                    wire:click.prevent="showFromSoSendSms({{ $responsable }})" data-toggle="modal"
                                    data-target="#sendNewSmsModal">
                                    <i class="fab fa-telegram" aria-hidden="true"></i>
                                </x-button>
                                <x-button class="btn-info btn-sm" type="button"
                                    wire:click.prevent="show({{ $responsable }})" data-toggle="modal"
                                    data-target="#editFamillyModal">
                                    <i class="fas fa-edit    "></i>
                                </x-button>
                                <x-button class="btn-danger btn-sm" type="button"
                                    wire:click.prevent="delete({{ $responsable->id }})">
                                    <span wire:loading wire:target="delete({{ $responsable->id }})"
                                        class="spinner-border spinner-border-sm" role="status"
                                        aria-hidden="true"></span>
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </x-button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $listResponsible->links('livewire::bootstrap') }}
        @endif
    </div>
</div>
