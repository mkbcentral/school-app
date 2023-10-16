<div>

   <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h1 class="m-0"><i class="fas fa-chart-pie"></i> Rapport financier par section</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Menu</a></li>
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item active">Rapport financier</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

    <div class="row">
        <div class="card col-md-2">
            <div class="card-header">
                <h4><i class="fas fa-list-ul"></i>Liste des filières</h4>
            </div>
            <div class="card-body">
                <div class="btn-group-vertical" role="group" aria-label="Vertical button group">
                    @foreach ($listClasseOption as $option)
                        <button wire:click.prevent="changeIndex({{ $option }})" type="button"
                            class="btn {{ $selectedIndex == $option->id ? 'btn-primary' : 'btn-link text-secondary' }}   text-left">
                            <i class="fas fa-arrow-alt-circle-right"></i> {{ $option->name }}
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="card col-md-8">
            @php $total=0 @endphp
            <div class="card-header text-uppercase">
                <h4><i class="fas fa-money-check"></i> Situation financière</h4>
            </div>
            <div class="card-body">
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
                <div class="d-flex  justify-content-center">
                    <div wire:loading  class="spinner-grow text-primary text-center"
                        role="status">
                        <span hidden>Loading...</span>
                    </div>
                </div>
                @if ($classeList->isEmpty())
                    <x-data-empty />
                @else
                    <table class="table table-bordered border-primary mt-2">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">#</th>
                                <th scope="col">CLASSE</th>
                                <th class="text-center" scope="col">NRE </th>
                                <th class="text-center" scope="col">PRIX </th>
                                <th class="text-right" scope="col">RECET. ATTENDU </th>
                                <th class="text-right" scope="col">RECET. REALISEE</th>
                                <th class="text-right" scope="col"> MANQ. A GAGNE</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach ($classeList as $index => $classe)
                                <tr>
                                    <th scope="row" class="text-center">{{ $index + 1 }}</th>
                                    <td>{{ $classe->name . '/' . $classe->classeOption->name }}</td>
                                    <td class="text-center">
                                        {{ $classe->getInscriptionsCountByClasseFroCurrentScolaryYear($classe->id) }}
                                    </td>
                                    <td class="text-center">
                                        {{  $classe->getPaymentByClasseForCurrentYear($classe->id,$selectedOtherCostIndex) }}
                                        {{$classe->getPaymentCurrencyByClasseForCurrentYear($classe->id,$selectedOtherCostIndex)}}
                                    </td>
                                    <td class="text-right">
                                        {{ app_format_number(
                                            $classe->getPaymentByClasseForCurrentYear($classe->id,$selectedOtherCostIndex) *
                                             $classe->getInscriptionsCountByClasseFroCurrentScolaryYear($classe->id)) }}
                                              {{$classe->getPaymentCurrencyByClasseForCurrentYear($classe->id,$selectedOtherCostIndex)}}
                                    </td>
                                    <td class="text-right">
                                        {{ app_format_number($classe->getAmountPaymentByClasseForCurrentYearByMonth($classe->id,$selectedOtherCostIndex,$month)) }}
                                        {{$classe->getPaymentCurrencyByClasseForCurrentYear($classe->id,$selectedOtherCostIndex)}}
                                    </td>
                                    <td class="text-right">
                                        {{ app_format_number(
                                            ($classe->getPaymentByClasseForCurrentYear($classe->id,$selectedOtherCostIndex) * $classe->getInscriptionsCountByClasseFroCurrentScolaryYear($classe->id))-
                                            $classe->getAmountPaymentByClasseForCurrentYearByMonth($classe->id,$selectedOtherCostIndex,$month)) }}
                                             {{$classe->getPaymentCurrencyByClasseForCurrentYear($classe->id,$selectedOtherCostIndex)}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

            </div>
        </div>
        <div class="col-md-2">
            <div class="card-header">
                <h4><i class="fas fa-list-ul"></i>Type frais</h4>
            </div>
            <div class="card-body">
                <div class="btn-group-vertical" role="group" aria-label="Vertical button group">
                    @foreach ($listTYpeCost as $cost)
                        <button wire:click.prevent="changeIndexTypeCost({{ $cost }})" type="button"
                            class="btn {{ $selectedOtherCostIndex == $cost->id ? 'btn-danger' : 'btn-link text-secondary' }}   text-left">
                            <i class="fas fa-arrow-alt-circle-left"></i> {{ $cost->name }}
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
