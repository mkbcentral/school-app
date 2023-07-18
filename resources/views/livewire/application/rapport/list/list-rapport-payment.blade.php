<div>
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
                        <div class="d-flex align-items-center">
                            <div class="form-group mr-2">
                                <x-label value="{{ __('Choisir un le mois') }}" />
                                <x-select wire:model='month'>
                                    <option value="">Choisir...</option>
                                    @foreach ($months as $m)
                                        <option value="{{$m}}">
                                            {{ $m }}</option>
                                    @endforeach
                                </x-select>
                            </div>
                            <div class="form-group">
                                <x-label value="{{ __('Filtrer par date') }}" />
                                <x-input class="" type='date' placeholder="Lieu de naissance"
                                         wire:model='date_to_search' />
                            </div>
                        </div>
                        <div class="d-flex justify-content-end align-items-center">
                            <div class="form-group ">
                                <x-label value="{{ __('Choisor frais') }}" />
                                <x-select wire:model='cost_id'>
                                    <option value="">Choisir...</option>
                                    @foreach ($listCost as $cost)
                                        <option value="{{ $cost->id }}">
                                            {{ $cost->name }}</option>
                                    @endforeach
                                </x-select>
                            </div>
                            <div class="form-group ml-2">
                                <x-label value="{{ __('Filtrer par par classe') }}" />
                                <x-select wire:model='classe_id'>
                                    <option value="">Choisir...</option>
                                    @foreach ($classeList as $classe)
                                        <option value="{{ $classe->id }}">
                                            {{ $classe->name . '/' . $classe->option->name }}</option>
                                    @endforeach
                                </x-select>
                            </div>
                        </div>

                    </div>
                    <div>
                        <div class="d-flex justify-content-between align-items-center">
                            <x-search-input/>
                            <a href="{{route('print.rapport.payments',
                                    [$month,$defaultScolaryYerId,$cost_id,$index,$classe_id,$defaultCureencyName])}}"
                               target="_blank"><i class="fas fa-print"></i> Imprimer</a>
                        </div>
                        @if($listPayments->isEmpty())
                            <x-data-empty/>
                        @else
                        <table class="table table-stripped table-sm ">
                            <thead class="thead-light">
                            <tr class="text-uppercase">
                                <th>Date</th>
                                <th>Noms élève</th>
                                <th class="text-right">Type frais</th>
                                <th class="text-right">Montant</th>
                                <th class="text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                               @foreach($listPayments as $payment)
                                   <tr>
                                       <td>{{$payment->created_at->format('d/m/y')}}</td>
                                       <td>{{$payment->student->name}}</td>
                                       <td class="text-right">{{$payment->cost->name}}</td>
                                       <td class="text-right">{{$payment->amount}} {{$defaultCureencyName}}</td>
                                       <td>

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
