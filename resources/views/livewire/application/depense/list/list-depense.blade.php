<div>
    @livewire('application.depense.list-retour-caisse')
    <x-button type="button" wire:click.prevent='new' class="btn-danger" data-toggle="modal"
        data-target="#formDepenseModal">
        <i class="fa fa-plus-circle" aria-hidden="true"></i> Nouvelle dépense
    </x-button>
    <div class="d-flex justify-content-between mt-4 align-items-center">
        <div class="form-group d-flex align-items-center">
            <h4 class="mr-1">Filtrer/Date</h4>
            <x-input class="" type='date' placeholder="Date depense" wire:model='date' />
        </div>
        <div  class="d-flex align-items-center">
            <h4 class="mr-1">Filtrer/Mois</h4>
            <select class="form-control" wire:model='month' id="">
                @foreach ($months as $m)
                    <option value="{{ $m }}">{{ app_get_month_name($m) }}
                    </option>
                @endforeach
            </select>

        </div>

    </div>
    <div class="d-flex justify-content-center">
        <span wire:loading class="spinner-border" role="status" aria-hidden="true"></span>
    </div>
    <h4 class="text-success">({{ $listDepense->count() }} {{ Str::plural('Depense', $listDepense->count()) }})</h4>
    <div class="d-flex align-items-center">
        <h4 class="mr-1">Filtrer</h4>
        <div class="d-flex align-items-center">
            <div class="form-group d-flex align-items-center mr-2">
                <select wire:model='source' id="" class="form-control">
                    <option value="">Tous</option>
                    <option value="">Source</option>
                    @foreach ($listDepenseSource as $source)
                        <option value="{{ $source->name }}">{{ $source->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group d-flex align-items-center mr-2 w-25">
                <select wire:model='category' id="" class="form-control">
                    <option value="">Tous</option>
                    <option value="">Catégorie...</option>
                    @foreach ($listCategoryDepense as $category)
                        <option value="{{ $category->name }}">{{ $category->name }}</option>
                    @endforeach

                </select>
            </div>
            <div class="form-group d-flex align-items-center">
                <select wire:model='currency' id="" class="form-control">
                    <option value="">Tous</option>
                    <option value="">Dévise</option>
                    @foreach ($currencyList as $currency)
                        <option value="{{ $currency->currency }}">{{ $currency->currency }}</option>
                    @endforeach

                </select>
            </div>
        </div>
    </div>
    <table class="table mt-2">
        <thead>
            <tr>
                <th>#</th>
                <th>Date</th>
                <th>Descriprion</th>
                <th>Source</th>
                <th>
                    <div class="d-flex align-items-center ">
                        <span class="mr-2">Categorie</span>

                    </div>
                </th>
                <th>
                    <div class="d-flex align-items-center ">
                        <span class="mr-2">Montant</span>

                    </div>
                </th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if ($listDepense->isEmpty())
                <tr>
                    <td colspan="6" class="text-center text-success">
                        <i class="fa fa-database" aria-hidden="true"></i>
                        Aucune donnée trouvée !
                    </td>
                </tr>
            @else
                @foreach ($listDepense as $index => $depense)
                    <tr>
                        <td scope="row">{{ $index + 1 }}</td>
                        <td>{{ $depense->created_at->format('d/m/Y') }}</td>
                        <td>{{ $depense->name }}</td>
                        <td>{{ $depense->source }}</td>
                        <td>{{ $depense->category }}</td>
                        <td>{{ $depense->currency_name }} {{ app_format_number($depense->amount) }} </td>
                        <td>
                            <x-button wire:click.prevent='edit({{ $depense }},{{ $depense->id }})'
                                class="text-primary" data-toggle="modal"
                                data-target="#formDepenseModal"
                                type="button">
                                <span wire:loading wire:target="edit({{ $depense }},{{ $depense->id }})"
                                    class="spinner-border spinner-border-sm"
                                     role="status" aria-hidden="true"></span>
                                <i class="fa fa-edit" aria-hidden="true"></i>
                            </x-button>
                            <x-button wire:click.prevent='show({{ $depense }},{{ $depense->id }})'
                                class="text-primary" data-toggle="modal"
                                data-target="#listRetourCaisseModal"
                                type="button">
                                <span wire:loading wire:target="edit({{ $depense }},{{ $depense->id }})"
                                    class="spinner-border spinner-border-sm"
                                     role="status" aria-hidden="true"></span>
                                <i class="fa fa-user-plus" aria-hidden="true"></i>
                            </x-button>
                            <x-button wire:click.prevent='showDeleteDialog({{ $depense->id }})'
                                class="text-danger" type="button">
                                <span wire:loading wire:target="delete({{ $depense->id }})"
                                    class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </x-button>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
