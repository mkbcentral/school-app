<div class="card mt-4 p-2">
    @livewire('application.depense.list-depense-source')
    @livewire('application.depense.list-emprunt')
    @livewire('application.depense.form.form-depense')

    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div><i class="fa fa-list" aria-hidden="true"></i>LISTE DEPENSES</div>
                        <x-button type="button" class="btn-danger" data-toggle="modal" data-target="#formDepenseModal">
                          <i class="fa fa-plus-circle" aria-hidden="true"></i>  Nouvelle dépense
                        </x-button>
                    </div>
                </div>
                <div class="card-body">
                    @livewire('application.depense.list.list-depense')
                </div>
            </div>
        </div>
        <div class="col-md-2">
           <div class="card">
            <img class="card-img-top" src="holder.js/100x180/" alt="">
            <div class="card-body">
                <x-button type="button" class="btn-primary w-100" data-toggle="modal" data-target="#listSourceDepenseModal">
                    Source dépennse
                </x-button>
                <x-button type="button" class="btn-info  w-100 mt-2" data-toggle="modal" data-target="#listEmpruntModal">
                    Emprunts
                </x-button>
            </div>
           </div>
        </div>
    </div>
</div>
