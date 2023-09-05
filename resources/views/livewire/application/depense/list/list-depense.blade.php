<div>

    <x-button type="button" wire:click.prevent='new' class="btn-danger" data-toggle="modal"
        data-target="#formDepenseModal">
        <i class="fa fa-plus-circle" aria-hidden="true"></i> Nouvelle dépense
    </x-button>
    <div class="d-flex justify-content-between mt-4">
        <div class="form-group">
            <x-input class="" type='date' placeholder="Date depense" wire:model='date' />
        </div>
        <select class="form-control w-25" wire:model='month' id="">
            @foreach ($months as $m)
            <option value="{{ $m }}">{{ app_get_month_name($m) }}
            </option>
            @endforeach
        </select>
    </div>
    <div class="d-flex justify-content-center">
        <span wire:loading class="spinner-border" role="status" aria-hidden="true"></span>
    </div>
    <div>
        <h4 class="text-success">({{ $listDepense->count() }} {{ Str::plural('Depense', $listDepense->count()) }})</h4>
    </div>
    <table class="table mt-2">
        <thead>
            <tr>
                <th>#</th>
                <th>Date</th>
                <th>Descriprion</th>
                <th>
                    <div class="d-flex align-items-center ">
                        <span class="mr-2">Source</span>
                        <select wire:model='source' id="">
                            <option value="">Source</option>
                            @foreach ($listDepenseSource as $source)
                            <option value="{{ $source->name }}">{{$source->name}}</option>
                            @endforeach
                            <option value="">Tous</option>
                        </select>
                    </div>
                </th>
                <th>
                    <div class="d-flex align-items-center ">
                        <span class="mr-2">Montant</span>
                        <select wire:model='currency' id="">
                            <option value="">Dévise</option>
                            @foreach ($currencyList as $currency)
                            <option value="{{ $currency->currency }}">{{$currency->currency}}</option>
                            @endforeach
                            <option value="">Tous</option>
                        </select>
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
                <td scope="row">{{ $index+1 }}</td>
                <td>{{ $depense->created_at->format('d/m/Y') }}</td>
                <td>{{ $depense->name }}</td>
                <td>{{$depense->source}}</td>
                <td>{{$depense->currency_name}} {{ app_format_number($depense->amount) }} </td>
                <td>
                    <x-button wire:click.prevent='edit({{ $depense }},{{ $depense->id }})' class="btn-sm text-primary"
                        data-toggle="modal" data-target="#formDepenseModal" type="button">
                        <span wire:loading wire:target="edit({{ $depense }},{{ $depense->id }})"
                            class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        <i class="fa fa-edit" aria-hidden="true"></i>
                    </x-button>
                    <x-button wire:click.prevent='showDeleteDialog({{ $depense->id }})' class="btn-sm text-danger" type="button">
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

    <script type="module">
        //Confirmation dialog for delete role
        window.addEventListener('delete-depense-dialog', event => {
            Swal.fire({
                    title: 'Voulez-vous vraimant ',
                    text: "supprimer ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emit('deleteDepenseListner');
                    }
            })
        })
        window.addEventListener('depense-dialog-deleted', event => {
                Swal.fire(
                    'Oprétion !',
                    event.detail.message,
                    'success'
                );
        });

    </script>
</div>
