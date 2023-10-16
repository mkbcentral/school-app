<div>
    <div class="card mt-2">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h1 class="m-0"><i class="fas fa-chart-pie"></i> Dashboard</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Menu</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            @can('edit-student-infos')  
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group d-flex justify-content-between align-items-center">
                            <label><i class="fas fa-calendar-day"></i> Stiuation opérations journalières</label>
                            <x-input class="form-control w-25" type='date' placeholder="Lieu de naissance"
                                wire:model='day' />
                        </div>
                        <div class="d-flex justify-content-center align-items-center">
                            <span wire:loading class="spinner-border" role="status" aria-hidden="true"></span>
                        </div>
                        <div class="row mt-2" wire:loading.class='d-none'>
                            <div class="col-md-6">
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <h3>@livewire('application.inscription.widget.new-inscription-by-date-counter-widget')</h3>
                                        <p>Nouvelle inscription</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-user-plus"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">More info <i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="small-box bg-primary">
                                    <div class="inner">
                                        <h3>@livewire('application.inscription.widget.old-student-inscription-counter-widget')</h3>
                                        <p>Réinscription</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">More info <i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                       <div wire:loading.class='d-none'>
                        @livewire('application.inscription.widget.list-counter-inscription-by-classe-option-widget')
                       </div>
                    </div>
                    <div class="col-md-6"'>
                        @livewire('application.inscription.list.widget.list-classe-by-option-with-student-counter-widget')
                    </div>
                </div>
            @endcan

            @can('view-total-amount')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group d-flex justify-content-between align-items-center">
                            <h4><i class="fas fa-calendar-day"></i> Recettes journalières</h4>
                            <x-input class="form-control w-25" type='date' placeholder="Lieu de naissance"
                                wire:model='day' />
                        </div>
                        <div class="card-body">
                            @livewire('application.receipts.cost-other-payment-receipts-by-date')
                        </div>
                        @can('view-depense-emprunt')
                            @livewire('application.depense.widget.amount-emprunt-by-currency-widget')
                        @endcan
                    </div>
                    <div class="col-md-6">
                        @can('view-total-amount')
                            @livewire('application.receipts.cost-other-payment-receipts-by-month')
                        @endcan
                        @can('view-depense-emprunt')
                            @livewire('application.depense.widget.amount-depense-by-currency-widget')
                        @endcan
                    </div>
                </div>

            @endcan
        </div>
    </div>
</div>
