<?php

namespace App\Http\Livewire\Helpers\Payment;

use App\Http\Livewire\Helpers\SchoolHelper;
use App\Models\Paiment;
use App\Models\ScolaryYear;

class GetPaymentByTypeCostToCheck
{
    public static function getPaymentChecker($idType,$studentId,$month):?Paiment{
        $scolaryYear=(new SchoolHelper())->getLastScolaryTear();
        return Paiment::join('cost_generals','cost_generals.id','=','paiments.cost_general_id')
            ->join('type_other_costs','type_other_costs.id','=','cost_generals.type_other_cost_id')
            ->where('paiments.student_id',$studentId)
            ->where('paiments.school_id',auth()->user()->school->id)
            ->where('paiments.scolary_year_id',$scolaryYear->id)
            ->where('cost_generals.type_other_cost_id',$idType)
            ->where('paiments.mounth_name',$month)
            ->select('paiments.*')
            ->first();
    }
}
