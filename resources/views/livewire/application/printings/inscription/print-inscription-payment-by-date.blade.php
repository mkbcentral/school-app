<x-pinting-layout>
    @php
        $total=0;;
    @endphp
    <div>
        <table sty>
            <thead style="background: rgb(67, 67, 67);color: rgb(222, 221, 221)">
            <tr>
                <th >N°</th>
                <th >DATE</th>
                <th >NOMS ELEVE</th>
                <th>MONTANT</th>
            </tr>
            </thead>
            <tbody>
            @foreach($inscriptionList as $index => $payment)
                <tr >
                    <td class="bg-danger">{{$index+1}}</td>
                    <td>{{$payment->created_at->format('d/m/Y')}}</td>
                    <td>{{$payment->student->name}}</td>
                    <td>{{$payment->amount}} {{$currency}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div style="text-align: right;font-size: 18px;margin-top: 10px;">
            <span style="font-weight: bold">Total: </span><span>{{ number_format($total,1,',',' ') }} Fc</span>
            <div style="margin-top: 8px">
                <span style="">Fiat à Lubumbashi,Le {{date('d/m/Y')}}</span>
            </div>
        </div>
    </div>

</x-pinting-layout>
