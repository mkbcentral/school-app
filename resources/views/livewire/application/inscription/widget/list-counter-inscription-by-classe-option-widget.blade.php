<div>
    <div class="card">
        <div class="card-header border-transparent">
            <h3 class="card-title"><i class="fas fa-chart-area"></i> Evolution par filière</h3>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table m-0">
                    <thead>
                    <tr>
                        <th>FILLIERES</th>
                        <th class="text-right">NOMBRE</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($inscriptionList as $inscription)
                            <tr class="{{$inscription->number <2?'text-danger':'text-primary'}}">
                                <td class="text-uppercase">{{$inscription->name}}</a></td>
                                <td class="text-right">
                                    <i class="fas {{$inscription->number <2?'fa-arrow-down':'fa-arrow-up'}} "></i>
                                    {{$inscription->number}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
