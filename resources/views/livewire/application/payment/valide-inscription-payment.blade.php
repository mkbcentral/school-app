<div>
    <x-loading-indicator/>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-danger"> &#x1F5C3; GESTIONNAIRE DES INSCRIPTIONS</h1>
                </div>
            </div>
        </div>
    </div>
    @livewire('application.payment.list.list-payment-inscription-valided-by-date')
    <div class="d-flex justify-content-end pb-2">
        <x-button type="button"  class="btn btn-sm btn-primary"
                  data-toggle="modal"
                  data-target="#showListInscriptionPaymentByDateModal">
            Voir le paiement
        </x-button>
    </div>
   @livewire('application.inscription.list.list-inscription',['index'=>0])

</div>
