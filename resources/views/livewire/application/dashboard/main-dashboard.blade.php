<div>
    <div class="card mt-2">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"><i class="fas fa-chart-pie"></i> Situation des inscriptions journalières</h1>
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
            <div class="d-flex justify-content">
                <div class="col-md-4">
                    <div class="form-group">
                        <x-label value="{{ __('Filtrer par date') }}" />
                        <x-input class="" type='date' placeholder="Lieu de naissance"
                                 wire:model='day' />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
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
                <div class="col-md-3">
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
                <div class="col-lg-6">
                    @livewire('application.inscription.widget.list-counter-inscription-by-classe-option-widget')
                </div>
            </div>
        </div>
    </div>
</div>
