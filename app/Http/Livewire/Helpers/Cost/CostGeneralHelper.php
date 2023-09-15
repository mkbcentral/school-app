<?php

namespace App\Http\Livewire\Helpers\Cost;

use App\Models\CostGeneral;
use Illuminate\Support\Collection;

class CostGeneralHelper
{
    /**
     * Recuprer la liste frais scolaire par type et par année scolaire
     * @param $type_other_cost_id
     * @param $defaultScolaryYerId
     * @return Collection
     */
    public function getListCostGeneral($type_other_cost_id,$defaultScolaryYerId):Collection{
        $listOtherCost=CostGeneral::join('type_other_costs','type_other_costs.id','=','cost_generals.type_other_cost_id')
            ->where('type_other_costs.id',$type_other_cost_id)
            ->where('type_other_costs.school_id',auth()->user()->school->id)
            ->where('type_other_costs.scolary_year_id',$defaultScolaryYerId)
            ->select('cost_generals.*')
            ->get();
        return $listOtherCost;
    }

    /**
     * Recuperer un frais par id
     * @param int $id
     * @return CostGeneral
     */
    public function getCostByTypeId(int $id):CostGeneral{
        return CostGeneral::whereTypeOtherCostId($id)->first();
    }

    public static function getCostById($id){
        return CostGeneral::find($id);
    }
}
