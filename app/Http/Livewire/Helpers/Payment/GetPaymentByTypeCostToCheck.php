<?php

namespace App\Http\Livewire\Helpers\Payment;

use App\Http\Livewire\Helpers\SchoolHelper;
use App\Models\Payment;

class GetPaymentByTypeCostToCheck
{
    public static function getPaymentChecker($idType,$inscriptionId,$month):?Payment{
        $scolaryYear=(new SchoolHelper())->getOldScolaryYear();
        return Payment::join('cost_generals','cost_generals.id','=','payments.cost_general_id')
            ->join('inscriptions','inscriptions.id','payments.inscription_id')
            ->where('payments.inscription_id',$inscriptionId)
            ->where('inscriptions.school_id',auth()->user()->school->id)
            ->where('inscriptions.scolary_year_id',$scolaryYear->id)
            ->where('cost_generals.type_other_cost_id',$idType)
            ->where('payments.month_name',$month)
            ->select('payments.month_name')
            ->first();
    }

    public static function getCurrentYearPaymentChecker($idType,$inscriptionId,$month):?Payment{
        $scolaryYear=(new SchoolHelper())->getCurrectScolaryYear();
        return Payment::join('cost_generals','cost_generals.id','=','payments.cost_general_id')
            ->join('type_other_costs','type_other_costs.id','=','cost_generals.type_other_cost_id')
            ->join('inscriptions','inscriptions.id','payments.inscription_id')
            ->where('payments.inscription_id',$inscriptionId)
            ->where('inscriptions.school_id',auth()->user()->school->id)
            ->where('inscriptions.scolary_year_id',$scolaryYear->id)
            ->where('type_other_costs.id',$idType)
            ->where('payments.month_name',$month)
            ->select('payments.month_name')
            ->with('inscription')
            ->first();
    }

    public static function getCurrentYearCostPaymentChecker($idType,$inscriptionId,$month,$costId):?Payment{
        $scolaryYear=(new SchoolHelper())->getCurrectScolaryYear();
        return Payment::join('cost_generals','cost_generals.id','=','payments.cost_general_id')
            ->join('type_other_costs','type_other_costs.id','=','cost_generals.type_other_cost_id')
            ->join('inscriptions','inscriptions.id','payments.inscription_id')
            ->where('payments.inscription_id',$inscriptionId)
            ->where('payments.school_id',auth()->user()->school->id)
            ->where('inscriptions.scolary_year_id',$scolaryYear->id)
            ->where('cost_generals.type_other_cost_id',$idType)
            ->where('payments.month_name',$month)
            ->where('payments.cost_general_id',$costId)
            ->select('payments.month_name')
            ->with('inscription')
            ->with('student')
            ->with('school')
            ->with('classe')
            ->first();
    }
}
