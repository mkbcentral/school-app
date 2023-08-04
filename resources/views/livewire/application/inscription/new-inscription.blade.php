<div>
    <x-loading-indicator/>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> &#x1F5C3; GESTIONNAIRE DES INSCRIPTIONS</h1>
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
                        <div class="row">
                            <div class="col-md-4">
                                @livewire('application.inscription.forms.add-new-familly')
                            </div>
                            <div class="col-md-8">
                                @livewire('application.inscription.list.list-student-responsable',['index' => $selectedIndex])
                            </div>
                        </div>
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
