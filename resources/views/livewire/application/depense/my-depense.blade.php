<div class="card mt-4 p-2">
    @livewire('application.depense.list-depense-source')
    @livewire('application.depense.list-emprunt')
    @livewire('application.depense.form.form-depense')
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div><i class="fa fa-list" aria-hidden="true"></i>LISTE DEPENSES</div>
                    </div>
                </div>
                <div class="card-body">
                    @livewire('application.depense.list.list-depense')
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <img class="card-img-top" src="holder.js/100x180/" alt="">
                <div class="card-body">
                    <x-button type="button" class="btn-primary w-100" data-toggle="modal"
                        data-target="#listSourceDepenseModal">
                        <i class="fas fa-coins    "></i> Source dépennse
                    </x-button>
                    <x-button type="button" class="btn-info  w-100 mt-2" data-toggle="modal"
                        data-target="#listEmpruntModal">
                        <i class="fas fa-hand-holding-usd    "></i>Nos Emprunts
                    </x-button>
                </div>
            </div>
            @livewire('application.depense.widget.amount-depense-by-currency-widget')
            @livewire('application.depense.widget.amount-emprunt-by-currency-widget')
        </div>
    </div>
</div>
