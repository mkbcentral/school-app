<?php

namespace App\Http\Livewire\Helpers\Cost;

use App\Http\Livewire\Helpers\SchoolHelper;
use App\Models\CostInscription;
use Illuminate\Support\Collection;


class CostInscriptionHelper
{
    /**
     * Récuprer la liste des frais pour l'année en cours
     * @return Collection
     */
    public function getListCostInscription():Collection {
        $scolaryYear=(new SchoolHelper())->getCurrectScolaryYear();
        return CostInscription::where('school_id', auth()->user()->school->id)
            ->whereScolaryYearId($scolaryYear->id)
            ->orderBy('created_at', 'DESC')->get();
    }
}
