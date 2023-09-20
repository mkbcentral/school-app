<div>
    <x-loading-indicator/>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> &#x1F5C3; NOUVELLE REINSCIRPION</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- Main content -->
    @livewire('application.inscription.forms.add-new-reinscription')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- /.col -->
                <div class="col-md-5">
                    <div class="card">
                        <div>
                            <div class="">
                                <h4 class="text-uppercase text-bold">LISTE DES ELEVES</h4>
                                <x-search-input/>
                            </div>
                            @if ($studentList->isEmpty())
                               <x-data-empty/>
                            @else
                                <div class="p-2">
                                    <table class="table table-stripped table-sm">
                                        <thead class="bg-primary">
                                            <tr class="text-uppercase">
                                                <th>Noms élève</th>
                                                <th class="text-center">Genre</th>
                                                <th class="text-center">Age</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class=">
                                            @foreach ($studentList as $student)
                                                <tr ">
                                                    <td>{{ $student->name }}
                                                    </td>

                                                    <td class="text-center">{{ $student->gender }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $student->getAge($student->date_of_birth) }}
                                                    </td>
                                                    <td class="text-center">
                                                        <x-button wire:click.prevent='show({{ $student }})'
                                                            class="btn-sm" type="button" data-toggle="modal"
                                                            data-target="#newReinscription">
                                                            <i class="fas fa-user-plus text-primary"></i>
                                                        </x-button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            @endif
                        </div>
                    </div>
                    <!-- /.card -->
                    {{$studentList->links('vendor.livewire.bootstrap')}}
                </div>
                <!-- /.col -->
                <div class="col-md-7">
                    @livewire('application.inscription.forms.add-new-familly')
                    @livewire('application.inscription.list.list-inscription',['index'=>0])
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
