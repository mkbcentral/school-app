<div>
    @livewire('application.tarification.form.form-tarification')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> <i class="fa fa-folder" aria-hidden="true"></i>TARIFICATION</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center ">
                            <i class="fa fa-list mr-1" aria-hidden="true"></i>
                            <h4> LISTE DES TARIFS</h4>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <x-button type="button" wire:click.prevent='new' class="btn-primary" data-toggle="modal"
                                data-target="#formTarifModal">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i> Nouveau tarif
                            </x-button>
                            <x-search-input/>
                            </div>
                            <table class="table table-striped">
                                <thead class="thead-inverse">
                                    <tr>
                                        <th>#</th>
                                        <th>Nom frais</th>
                                        <th>Type</th>
                                        <th>Option</th>
                                        <th>Montant</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($lisCostGeneral->isEmpty())
                                    @else
                                        @foreach ($lisCostGeneral as $index => $costGeneral)
                                            <tr class="text-uppercase">
                                                <td scope="row">{{ $index + 1 }}</td>
                                                <td>{{ $costGeneral->name }}</td>
                                                <td>{{ $costGeneral->type }}</td>
                                                <td>{{ $costGeneral->option }}</td>
                                                <td>{{ $costGeneral->amount }} {{ $costGeneral->currency_name }}</td>
                                                <td>
                                                    <x-button
                                                        wire:click.prevent='edit({{ $costGeneral }},{{ $costGeneral->id }})'
                                                        class="btn-sm text-primary" data-toggle="modal"
                                                        data-target="#formTarifModal" type="button">
                                                        <span wire:loading
                                                            wire:target="edit({{ $costGeneral }},{{ $costGeneral->id }})"
                                                            class="spinner-border spinner-border-sm" role="status"
                                                            aria-hidden="true"></span>
                                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                                    </x-button>
                                                    <x-button
                                                        wire:click.prevent='showDeleteDialog({{ $costGeneral->id }})'
                                                        class="btn-sm text-danger" type="button">
                                                        <span wire:loading wire:target="delete({{ $costGeneral->id }})"
                                                            class="spinner-border spinner-border-sm" role="status"
                                                            aria-hidden="true"></span>
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                    </x-button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
