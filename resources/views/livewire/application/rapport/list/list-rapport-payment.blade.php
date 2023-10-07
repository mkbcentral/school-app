<div>
    @livewire('application.payment.form.edit-payment-infos')
    <div class="card">
        <div class="card-body">
            <div class="tab-content">
                <div class="active tab-pane" id="inscription">
                    <div class="d-flex justify-content-end">
                        <div class="bg-warning mr-2 p-2">
                            @foreach ($amountPayments as $payment)
                                <h3>Total: {{ app_format_number($payment->amount) }} {{ $payment->currency }}</h3>
                            @endforeach
                        </div>
                        <x-button type="button" wire:click.prevent='loadData' class="btn btn-primary">
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
                                        <option value="{{ $m }}">
                                            {{ app_get_month_name($m) }}</option>
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
                                            {{ $classe->name . '/' . $classe->classeOption->name }}</option>
                                    @endforeach
                                </x-select>
                            </div>
                        </div>

                    </div>
                    <div>
                        <div class="d-flex justify-content-between align-items-center">
                            <x-search-input />
                        </div>
                        <div class="d-flex justify-content-center align-items-center">
                            <span wire:loading
                                class="spinner-border spinner-border-sm" role="status"
                                aria-hidden="true"></span>
                        </div>
                        @if ($listPayments->isEmpty())
                            <x-data-empty />
                        @else
                            <table class="table table-stripped table-sm mt-2">
                                <thead class="thead-light">
                                    <tr class="text-uppercase">
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Noms élève</th>
                                        <th class="text-center">sms status</th>
                                        <th class="text-right">Type frais</th>
                                        <th class="text-right">Montant</th>
                                        <th class="text-right">Mois</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($listPayments as $index => $payment)
                                        <tr>
                                            <td>{{$index+1}}</td>
                                            <td>{{ $payment->created_at->format('d/m/Y') }}</td>
                                            <td>{{ $payment->student->name }}
                                                /{{ $payment->getStudentClasseNameForCurrentYear($payment->student->id) }}
                                            </td>
                                            <td class="text-center">
                                                <span class="{{$payment->has_sms?'text-success':'text-danger'}}">
                                                    {{$payment->has_sms?'Envoyé':'Non envoyé'}}
                                                    
                                                </span>
                                                {{$payment?->student?->studentResponsable?->phone}}
                                            </td>
                                            <td class="text-right">{{ $payment->cost->name }}</td>
                                            <td class="text-right">{{ app_format_number($payment->amount) }}
                                                {{ $payment->cost->currency->currency }}</td>
                                            <td class="text-center">
                                                {{ app_get_month_name($payment->month_name) }}
                                            </td>
                                            <td class="text-center">
                                                <x-button class="btn-success btn-sm" type="button"
                                                    wire:click.prevent="sendPaymentSMS({{$payment->id }})">
                                                    
                                                    <i class="fab fa-telegram" aria-hidden="true"></i>
                                                </x-button>
                                                <x-button wire:click.prevent='edit({{ $payment }})'
                                                    class="btn-sm text-secondary" type="button" data-toggle="modal"
                                                    data-target="#editPayment">
                                                    <i class="fa fa-cog" aria-hidden="true"></i>
                                                </x-button>
                                                <x-button class="btn-danger btn-sm" type="button"
                                                    wire:click.prevent="delete({{ $payment->id }})">
                                                    <span wire:loading wire:target="delete({{ $payment->id }})"
                                                        class="spinner-border spinner-border-sm" role="status"
                                                        aria-hidden="true"></span>
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
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
