<div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="listEmpruntModal" tabindex="-1" role="dialog" data-backdrop="static"
        data-keyboard="false" aria-labelledby="listEmpruntModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="listEmpruntModalLabel">
                        NOS EMPRUNTS
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    LISTE DES EMPRUNTS
                                </div>
                                <div class="card-body">

                                    <div class="d-flex justify-content-between ">
                                        <h4 class="bg-secondary p-2 rounded">Total:
                                            @foreach ($totalByCurrency as $total)
                                                <span class="text-info">{{ $total->currency }}:
                                                    </span><span>{{ app_format_number($total->total) }}</span>
                                            @endforeach
                                        </h4>
                                        <select class="form-control w-25" wire:model='month' id="">
                                            @foreach ($months as $m)
                                                <option value="{{ $m }}">{{ app_get_month_name($m) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <span wire:loading
                                        class="spinner-border spinner-border-sm"
                                        role="status" aria-hidden="true"></span>
                                    </div>
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Date</th>
                                                <th>Code</th>
                                                <th>Monent</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($listEmprunt->isEmpty())
                                                <tr>
                                                    <td colspan="5" class="text-center text-success">
                                                        <i class="fa fa-database" aria-hidden="true"></i>
                                                        Aucune donnée trouvée !
                                                    </td>
                                                </tr>
                                            @else
                                                @foreach ($listEmprunt as $index => $emprunt)
                                                    <tr>
                                                        <td scope="row">{{ $index + 1 }}</td>
                                                        <td>{{ $emprunt->created_at->format('d/m/Y') }}</td>
                                                        <td>{{ $emprunt->code }}</td>
                                                        <td>{{ $emprunt->amount }}</td>
                                                        <td class="text-center">
                                                            <x-button
                                                                wire:click.prevent='edit({{ $emprunt }},{{ $emprunt->id }})'
                                                                class="btn-sm text-primary" type="button">
                                                                <span wire:loading
                                                                    wire:target="edit({{ $emprunt }},{{ $emprunt->id }})"
                                                                    class="spinner-border spinner-border-sm"
                                                                    role="status" aria-hidden="true"></span>
                                                                <i class="fa fa-edit" aria-hidden="true"></i>
                                                            </x-button>
                                                            <x-button wire:click.prevent='delete({{ $emprunt->id }})'
                                                                class="btn-sm text-danger" type="button">
                                                                <span wire:loading
                                                                    wire:target="delete({{ $emprunt->id }})"
                                                                    class="spinner-border spinner-border-sm"
                                                                    role="status" aria-hidden="true"></span>
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
                        <div class="col-md-4">
                            <form
                                @if ($isEditing == false) wire:submit.prevent='store'
                                @else
                                wire:submit.prevent='update' @endif>
                                <div class="card">
                                    <div class="card-header">
                                        <i class="fas {{ $isEditing == false ? 'fa-plus-circle' : 'fa-edit' }}"></i>
                                        {{ $isEditing == false ? 'NOUVEAU EMPRUNT' : 'MODIFICATION EMPRUNT' }}
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <x-label value="{{ __('Montant') }}" />
                                            <x-input class="" type='text' placeholder="Montant"
                                                wire:model.defer='amount' />
                                            @error('amount')
                                                <span class="error text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="">Dévise</label>
                                            <select class="form-control" wire:model.defer='currency_id' id="">
                                                <option>Choisir la dévise</option>
                                                @foreach ($listCurrency as $currency)
                                                    <option value="{{ $currency->id }}">{{ $currency->currency }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('currency_id')
                                                <span class="error text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        @if($isEditing == true)
                                        <div class="form-group">
                                            <x-label value="{{ __('Date emprunt') }}" />
                                            <x-input class="" type='date' placeholder="Date emprunt"
                                                wire:model.defer='created_at' />
                                            @error('created_at')
                                                <span class="error text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        @endif
                                    </div>
                                    <div class="card-footer text-muted">
                                        <x-button type="submit" class="btn btn-primary">
                                            <span wire:loading wire:target="store"
                                                class="spinner-border spinner-border-sm" role="status"
                                                aria-hidden="true"></span>
                                            <i class="fas {{ $isEditing == false ? 'fa-save' : 'fa-edit' }}"></i>
                                            {{ $isEditing == false ? 'Sauvegarder' : 'Modifier' }}
                                        </x-button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
