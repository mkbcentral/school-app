<div>
    <div class="card p-2">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h5> SITUATION DE REGULARISATION</h5>
                <a href="http://">Imprimer</a>
            </div>
        </div>
        <div class="card-body">
            @if ($inscription->payments->isEmpty())
                <x-data-empty />
            @else
                <table class="table table-striped">
                    <thead class="thead-inverse">
                        <tr>
                            <th>#</th>
                            <th>Date paiement</th>
                            <th>Type frais</th>
                            <th>Mois</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inscription->payments as $index => $payment)
                            <tr>
                                <td scope="row">{{ $index + 1 }}</td>
                                <td>{{ $payment->created_at->format('d/m/Y') }}</td>
                                <td>{{ $payment->cost->name }}</td>
                                <td>{{ $payment->month_name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
