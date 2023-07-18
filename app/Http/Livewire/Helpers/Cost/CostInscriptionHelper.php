<?php

namespace App\Http\Livewire\Helpers\Cost;

use App\Models\CostInscription;
use Illuminate\Support\Collection;


class CostInscriptionHelper
{
    public function getListCostInscription():Collection {
        $costInscriptionList= CostInscription::where('school_id', auth()->user()->school->id)
            ->orderBy('created_at', 'DESC')->get();
        return $costInscriptionList;
    }
}
