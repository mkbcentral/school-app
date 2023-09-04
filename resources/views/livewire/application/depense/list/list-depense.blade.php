<div>
    <div class="d-flex justify-content-between mt-4">
        <div class="form-group">
            <x-input class="" type='date' placeholder="Description"
                                            wire:model.defer='date' />
        </div>
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
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Date</th>
                <th>Descriprion</th>
                <th>Source</th>
                <th>Montant</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($listDepense as $index => $depense)
                <tr>
                    <td scope="row">{{ $index+1 }}</td>
                    <td>{{ $depense->created_at->format('d/m/Y') }}</td>
                    <td>{{ $depense->name }}</td>
                    <td></td>
                    <td>{{ $depense->amount }}</td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
