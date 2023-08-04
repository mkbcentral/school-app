<div class="row">
    @if($listReceipt->isEmpty())
        <span class="text-success text-center p-4">
    <h4><i class="fa fa-database" aria-hidden="true"></i><br>
        Aucune opération pour aujourd'hui !
    </h4>
</span>
    @else
        @foreach($listReceipt as $receipt)
            <div class="col-md-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{$receipt->amount}} {{$defaultCureencyName}}</h3>
                        <p>{{$receipt->name}}</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <a href="#" class="small-box-footer">({{$receipt->number}}) {{Str::plural('payment',$receipt->number)}}</a>
                </div>
            </div>
        @endforeach
    @endif
</div>
