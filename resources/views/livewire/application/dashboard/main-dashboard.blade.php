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
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="form-group d-flex justify-content-between align-items-center">
                                <label><i class="fas fa-calendar-day"></i> Stiuation opétions journalières</label>
                                <x-input  class="form-control w-25" type='date' placeholder="Lieu de naissance"
                                         wire:model='day' />
                            </div>
                        </div>
                        <div class="card-body">
                            @can('view-total-amount')
                                @livewire('application.receipts.cost-other-payment-receipts-by-date')
                            @endcan
                            @can('view-depense-emprunt')
                                @livewire('application.depense.widget.amount-emprunt-by-currency-widget')
                            @endcan
                           @can('edit-student-infos')
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="small-box bg-info">
                                                <div class="inner">
                                                    <h3>@livewire('application.inscription.widget.new-inscription-by-date-counter-widget')</h3>
                                                    <p>Nouvelle inscription</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fas fa-user-plus"></i>
                                                </div>
                                                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
                                                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            @livewire('application.inscription.widget.list-counter-inscription-by-classe-option-widget')
                                        </div>
                                    </div>
                           @endcan
                        </div>
                    </div>
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
        </div>
    </div>
</div>
