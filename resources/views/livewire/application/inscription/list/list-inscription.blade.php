<div>
    @livewire('application.inscription.forms.edit-inscription-form')
    @livewire('application.inscription.forms.edit-classe-and-inscription')
    <div class="card">
        <div class="card-body">
            <div class="tab-content">
                <div class="active tab-pane" id="inscription">
                    @can('view-total-amount')
                        <div class="d-flex justify-content-end">
                            <x-button wire:click.prevent="refreshList" type="button"  class="btn btn-warning"
                                      data-toggle="modal"
                                      data-target="#showListInscriptionPaymentByDateModal">
                                @livewire('application.payment.widget.sum-inscription-by-day-widget',
                                            [
                                                'date' => $date_to_search,
                                                'defaultScolaryYerId'=> $defaultScolaryYerId,
                                                'classeId' => $classe_id,
                                                'currency' => $defaultCureencyName
                                            ])
                            </x-button>
                            <x-button type="button" wire:click.prevent='loadData' class="btn btn-info ml-2">
                                <i class="fas fa-sync" aria-hidden="true"></i> Actualiser
                            </x-button>
                        </div>
                    @endcan
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
                                        {{ $classe->name . '/' . $classe->classeOption->name }}</option>
                                @endforeach
                            </x-select>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <x-label value="{{ __('Filtrer par date') }}" />
                                <x-input class="" type='date'
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
                                <div class="d-flex justify-content-between">
                                    <h4 class="text-uppercase text-bold">Inscriptions journalières</h4>
                                </div>
                            </div>
                            <table class="table table-stripped table-sm">
                                <thead class="thead-light">
                                    <tr class="text-uppercase">
                                        <th class="text-center">#</th>
                                        <th>Noms élève</th>
                                        <th class="text-center">Genre</th>
                                        <th class="text-center">Age</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($inscriptions as  $index=> $inscription)
                                        <tr>
                                            <td class="text-center">{{$index+1}}</td>
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
                                              @can('edit-student-infos')
                                                    <x-button wire:click.prevent='edit({{ $inscription->student }})'
                                                              class="btn-sm" type="button" data-toggle="modal"
                                                              data-target="#formEditInscriptionModal">
                                                        <i class="fas fa-edit text-primary"></i>
                                                    </x-button>
                                              @endcan

                                                @can('edit-classe-inscription')
                                                      <x-button wire:click.prevent='editInscription({{ $inscription }})'
                                                                class="btn-sm text-secondary" type="button" data-toggle="modal"
                                                                data-target="#editClasseAnInscription">
                                                          <i class="fa fa-cog" aria-hidden="true"></i>
                                                      </x-button>
                                                @endcan
                                                @can('valid-payment')
                                                    <x-button wire:click.prevent='valideInscriptionPayement({{ $inscription }})'
                                                              class="btn-sm text-secondary" type="button">
                                                        <i class="fas {{$inscription->is_paied?' fa-times-circle text-danger':'fa-check-double'}} " aria-hidden="true"></i>
                                                    </x-button>
                                                @endcan
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
