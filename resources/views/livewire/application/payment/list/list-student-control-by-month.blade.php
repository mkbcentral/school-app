<div class="card">
   <div class="card-header text-uppercase"><h3>CONTROL MENSUEL {{$typeCost->name}}</h3></div>
    <div class="card-body">
        <div class="d-flex">
            <div class="form-group ml-2">
                <x-label value="{{ __('Filtrer par filière') }}" />
                <x-select wire:model='classe_option_id'>
                    <option value="">Choisir...</option>
                    @foreach ($lisClasseOption as $option)
                        <option value="{{ $option->id }}">
                            {{ $option->name}}</option>
                    @endforeach
                </x-select>
            </div>
            <div class="form-group ml-2">
                <x-label value="{{ __('Filtrer par classe') }}" />
                <x-select wire:model='classe_id'>
                    <option value="">Choisir...</option>
                    @foreach ($classeList as $classe)
                        <option value="{{ $classe->id }}">
                            {{ $classe->name . '/' . $classe->classeOption->name }}</option>
                    @endforeach
                </x-select>
            </div>
        </div>

        @if($listStudent->isEmpty())
            <x-data-empty/>
        @else
            <table class="table table-stripped table-sm ">
                <thead class="thead-light">
                <tr class="text-uppercase">
                    <th>Noms élève</th>
                    @foreach($months as $month)
                        <th class="text-center">{{app_get_month_name($month)}}</th>
                    @endforeach
                </tr>
                </thead>
                <tbody>
                @foreach($listStudent as $inscription)
                    <tr>
                        <td>{{$inscription->student->name}}</td>
                        @foreach($months as $month)
                            <td class="text-center">
                                {{$inscription->getByCurrentYearPaymentCheckerStatus($index,$inscription->student->id,$month,$defaultScolaryYerId)}}
                            </td>
                        @endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
