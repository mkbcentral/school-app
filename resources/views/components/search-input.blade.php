<div class="d-flex align-items-center">
    <div class="card-tools">
        <div class="input-group input-group-sm">
            <input wire:model.debounce.500ms='keyToSearch' type="text"
                   class="form-control" placeholder="Recheche ici...">
            <div class="input-group-append">
                <div class="btn btn-primary">
                    <i class="fas fa-search"></i>
                </div>
            </div>
        </div>
    </div>
</div>
