<div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="sendNewSmsModal" tabindex="-1" role="dialog"
        aria-labelledby="sendNewSmsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sendNewSmsModalLabel">
                        Envoyoi SMS
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent='update'>
                    <div class="modal-body">
                        @if ($studentResponsable)
                            <div class="card">
                                <div class="card-header">
                                    <h4>Destinataire</h4>
                                </div>
                                <div class="card p-2">
                                    <h6><span class="text-bold text-info">Nom: </span>
                                         <i class="fa fa-user" aria-hidden="true"></i>  {{ $studentResponsable->name_responsable }}
                                    </h6>
                                    <h6><span class="text-bold text-info">Classe:</span>
                                      <i class="fa fa-phone" aria-hidden="true"></i>  +243 {{ $studentResponsable->phone }}
                                    </h6>
                                </div>
                            </div>
                            <div class="form-group">
                                <x-label value="{{ __('Message') }}" />
                                <textarea wire:model.defer='body' id="" class="form-control" cols="15" rows="5">
                                </textarea>
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <x-button type="submit" class="btn btn-primary">Sauvegarder</x-button>
                        <x-button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
