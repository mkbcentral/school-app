<div>
   <div CLASS="card">
       <div class="card-body">
           <div class="d-flex justify-content-end">
               <div class="col-md-4">
                   <div class="form-group">
                       <x-label value="{{ __('Filtrer par date') }}" />
                       <x-input class="" type='date' placeholder="Lieu de naissance"
                                wire:model='date_to_search' />
                   </div>
               </div>
           </div>
           @livewire('application.payment.form.edit-payment-infos')
           @php
               $total=0;
           @endphp
           <div>
               <div wire:loading wire:target="updatedDateToSearch">
                   Processing Payment...
               </div>
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
                           <th class="text-center">Actions</th>
                       </tr>
                       </thead>
                       <tbody>
                       @foreach ($listPayments as $payment)
                           <tr>
                               <td>{{ $payment->student->name}} {{ $payment->getStudentClasseName($payment)}}
                               </td>

                               <td class="text-center">{{ $payment->cost->name }}
                               </td>
                               <td class="text-center">
                                   {{$payment->amount}} {{$defaultCureencyName}}
                               </td>
                               <td class="text-center">
                                   <x-button wire:click.prevent='edit({{ $payment }})'
                                             class="btn-sm text-secondary" type="button" data-toggle="modal"
                                             data-target="#editPayment">
                                       <i class="fa fa-cog" aria-hidden="true"></i>
                                   </x-button>

                               </td>
                           </tr>
                           @php
                               $total+=0;
                           @endphp
                       @endforeach
                       </tbody>
                   </table>
               @endif
           </div>
       </div>
   </div>
</div>
