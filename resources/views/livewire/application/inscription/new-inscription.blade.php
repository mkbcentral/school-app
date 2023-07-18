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
    @livewire('application.inscription.forms.create-new-inscription-form')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- /.col -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                @foreach ($optionList as $option)
                                    <li class="nav-item">
                                        <a wire:click.prevent='changeIndex({{ $option }})'
                                            class="nav-link {{ $selectedIndex == $option->id ? 'active' : '' }} "
                                            href="#inscription" data-toggle="tab">
                                            &#x1F4C2; {{ $option->name }}
                                        </a>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                        <div class="d-flex justify-content-end align-items-center p-2">
                            <x-button class="btn-primary mt-4" wire:click.prevent='shwoFormCreate' type="button"
                                data-toggle="modal" data-target="#formInscriptionModal">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                Nouvelle inscription
                            </x-button>
                        </div>
                        @livewire('application.inscription.list.list-inscription', ['index' => $selectedIndex])
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
