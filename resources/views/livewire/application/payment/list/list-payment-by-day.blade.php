<div>
    <div class="card">
        <div class="card-body">
            <div  class="bg-warning d-flex justify-content-end p-2">
                @livewire('application.payment.widget.sum-payment-total-by-date', ['date' => $date_to_search, 'defaultScolaryYerId' => $defaultScolaryYerId, 'currency' => $defaultCureencyName])
            </div>
            <div class="d-flex justify-content-between">

                <div class="col-md-4">
                    <div class="d-flex justify-content-between">
                        <div class="form-group">
                            <x-label value="{{ __('Filtrer par date') }}" />
                            <x-input class="" type='date' placeholder="Lieu de naissance"
                                wire:model='date_to_search' />
                        </div>
                    </div>
                </div>
            </div>
            @livewire('application.payment.form.edit-payment-infos')
            @php
                $total = 0;
            @endphp
            <div>
                @if ($listPayments->isEmpty())
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
                                <th class="text-center">Type</th>
                                <th class="text-center">Montant</th>
                                <th class="text-center">Mois</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($listPayments as $payment)
                                <tr>
                                    <td>{{ $payment->student->name }} {{ $payment->getStudentClasseName($payment) }}
                                    </td>

                                    <td class="text-center">{{ $payment->cost->name }}
                                    </td>
                                    <td class="text-center">
                                        {{ app_format_number($payment->amount) }} {{ $defaultCureencyName }}
                                    </td>
                                    <td class="text-center">
                                        {{ app_get_month_name($payment->month_name) }}
                                    </td>
                                    <td class="text-center">
                                        <x-button wire:click.prevent='edit({{ $payment }})'
                                            class="btn-sm text-secondary" type="button" data-toggle="modal"
                                            data-target="#editPayment">
                                            <i class="fa fa-cog" aria-hidden="true"></i>
                                        </x-button>
                                        <x-button wire:click.prevent='printBill({{ $payment }})'
                                            class="btn-sm text-secondary" type="button">
                                            <i class="fas {{ $payment->is_paid ? ' fa-times-circle text-danger' : 'fa-check-double' }} "
                                                aria-hidden="true"></i>
                                        </x-button>
                                        @if ($payment->is_paid)
                                            <a href="{{ route('receipt.payment', [$payment, $defaultCureencyName]) }}"
                                                target="_blank"><i class="fas fa-print"></i></a>
                                        @endif
                                    </td>
                                </tr>
                                @php
                                    $total += $payment->amount;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                @endif
                <div class="d-flex justify-content-center mt-2">
                    <span wire:loading
        class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                </div>
                
            </div>
        </div>
    </div>
</div>
