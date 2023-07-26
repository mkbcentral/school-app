<div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> &#x1F5C3; RAPPORT DES PAIEMENT DES FRAIS</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- /.col -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                @foreach ($listTypeCost as $type)
                                    <li class="nav-item">
                                        <a wire:click.prevent='changeIndex({{ $type }})'
                                           class="nav-link {{ $selectedIndex == $type->id ? 'active' : '' }} "
                                           href="#inscription" data-toggle="tab">
                                            &#x1F4C2; {{ $type->name }}
                                        </a>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                        <div class="d-flex  justify-content-center">
                            <div wire:loading wire:target="changeIndex" class="spinner-grow text-primary text-center" role="status">
                                <span hidden>Loading...</span>
                            </div>
                        </div>
                        @livewire('application.rapport.list.list-rapport-payment',['index' => $selectedIndex])
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
