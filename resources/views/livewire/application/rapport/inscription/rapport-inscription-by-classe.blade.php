<div>
    <nav aria-label="breadcrumb" class="mt-4 d-flex justify-content-end">
        <ol class="breadcrumb bg-dark">
            <li class="breadcrumb-item"><a href="/">Menu</a></li>
            <li class="breadcrumb-item"><a href="{{route('dashboard.main')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Situation financière</li>
        </ol>
    </nav>

    <div class="row">
        <div class="card col-md-3">
            <div class="card-header"><h4><i class="fas fa-list-ul"></i>Liste des filières</h4></div>
            <div class="card-body">
                <div class="btn-group-vertical" role="group" aria-label="Vertical button group">
                    @foreach($listClasseOption as $option)
                        <button wire:click.prevent="changeIndex({{$option}})"
                                type="button" class="btn {{$selectedIndex==$option->id?'btn-primary':'btn-link text-secondary'}}   text-left">
                            <i class="fas fa-arrow-alt-circle-right"></i> {{$option->name}}
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="card col-md-6">
            @php $total=0 @endphp
            <div class="card-header text-uppercase"><h4><i class="fas fa-money-check"></i> Situation financière par classe</h4></div>
            <div class="card-body">
                <div class="d-flex  justify-content-center">
                    <div wire:loading wire:target="changeIndex" class="spinner-grow text-primary text-center" role="status">
                        <span hidden>Loading...</span>
                    </div>
                </div>

                <table class="table table-bordered border-primary mt-2">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col">CLASSE</th>
                        <th class="text-center" scope="col">NRE ELEVE</th>
                        <th class="text-right" scope="col">MONTANT</th>
                    </tr>
                    </thead>
                    <tbody class="table-group-divider">
                    @foreach($inscriptions as $index=>$inscription)
                        <tr>
                            <th scope="row" class="text-center">{{$index+1}}</th>
                            <td>{{$inscription->name}}/{{$selectedClasseOption->name}}</td>
                            <td class="text-center">{{$inscription->number}}</td>
                            <td class="text-right">{{app_format_number($inscription->amount)}} {{$defaultCureencyName}}</td>
                        </tr>
                        @php $total+= $inscription->amount @endphp
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <h3><span class="text-bold">Total</span>: {{app_format_number($total)}} {{$defaultCureencyName}}</h3>
            </div>
        </div>
    </div>

</div>
