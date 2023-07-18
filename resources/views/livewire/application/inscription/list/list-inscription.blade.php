<div>
    @livewire('application.inscription.forms.edit-inscription-form')
    @livewire('application.inscription.forms.edit-classe-and-inscription')
    <div class="card">
        <div class="card-body">
            <div class="tab-content">
                <div class="active tab-pane" id="inscription">
                    <div class="d-flex justify-content-end">
                        <x-button type="button" wire:click.prevent='loadData' class="btn btn-sm btn-primary">
                            <i class="fas fa-sync" aria-hidden="true"></i>
                        </x-button>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        @if ($selectedIndex ==0)
                        <div class="form-group ">
                            <x-label value="{{ __('Choisir une option') }}" />
                            <x-select wire:model='classe_option_id'>
                                <option value="">Choisir...</option>
                                @foreach ($classeOptionList as $classeOptionList)
                                    <option value="{{ $classeOptionList->id }}">
                                        {{ $classeOptionList->name }}</option>
                                @endforeach
                            </x-select>
                        </div>
                        @endif
                        <div class="form-group ">
                            <x-label value="{{ __('Filtrer par par classe') }}" />
                            <x-select wire:model='classe_id'>
                                <option value="">Choisir...</option>
                                @foreach ($classeList as $classe)
                                    <option value="{{ $classe->id }}">
                                        {{ $classe->name . '/' . $classe->option->name }}</option>
                                @endforeach
                            </x-select>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <x-label value="{{ __('Filtrer par date') }}" />
                                <x-input class="" type='date' placeholder="Lieu de naissance"
                                    wire:model='date_to_search' />
                            </div>
                        </div>
                    </div>
                    <div>
                        @if ($inscriptions->isEmpty())
                            <span class="text-success text-center p-4">
                                <h4><i class="fa fa-database" aria-hidden="true"></i>
                                    Aucune donnée trouvée !
                                </h4>
                            </span>
                        @else
                            <div>
                                <div>
                                    <h4 class="text-uppercase text-bold text-danger">Inscriptions journalières</h4>
                                </div>
                            </div>
                            <table class="table table-stripped table-sm mt-4">
                                <thead class="thead-light">
                                    <tr class="text-uppercase">
                                        <th>Noms élève</th>
                                        <th class="text-center">Genre</th>
                                        <th class="text-center">Age</th>
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
                                                {{ $inscription->student->getAge($inscription->student->date_of_birth) }}
                                            </td>
                                            <td class="text-center">
                                                <span class="badge badge-{{$inscription->getPaiementStatusColor($inscription)}}">{{$inscription->getPaiementStatus($inscription)}}</span>
                                            </td>
                                            <td class="text-center">
                                                <x-button wire:click.prevent='edit({{ $inscription->student }})'
                                                    class="btn-sm" type="button" data-toggle="modal"
                                                    data-target="#formEditInscriptionModal">
                                                    <i class="fas fa-edit text-primary"></i>
                                                </x-button>
                                                <x-button wire:click.prevent='editInscription({{ $inscription }})'
                                                    class="btn-sm text-secondary" type="button" data-toggle="modal"
                                                    data-target="#editClasseAnInscription">
                                                    <i class="fa fa-cog" aria-hidden="true"></i>
                                                </x-button>
                                                <x-button wire:click.prevent='valideInscriptionPayement({{ $inscription }})'
                                                          class="btn-sm text-secondary" type="button">
                                                    <i class="fas fa-check-double" aria-hidden="true"></i>
                                                </x-button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
            <!-- /.tab-content -->
        </div><!-- /.card-body -->
    </div>
</div>
