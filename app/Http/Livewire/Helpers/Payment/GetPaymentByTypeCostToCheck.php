<?php

namespace App\Http\Livewire\Helpers\Payment;

use App\Http\Livewire\Helpers\SchoolHelper;
use App\Models\Payment;

class GetPaymentByTypeCostToCheck
{
    public static function getPaymentChecker($idType,$student_id,$month):?Payment{
        $scolaryYear=(new SchoolHelper())->getOldScolaryYear();
        return Payment::join('cost_generals','cost_generals.id','=','payments.cost_general_id')
        ->join('students','students.id','=','payments.student_id')
            ->where('payments.student_id',$student_id)
            ->where('students.school_id',auth()->user()->school->id)
            ->where('payments.scolary_year_id',$scolaryYear->id)
            ->where('cost_generals.type_other_cost_id',$idType)
            ->where('payments.month_name',$month)
            ->first();
    }

    public static function getCurrentYearPaymentChecker($idType,$student_id,$month):?Payment{
        $scolaryYear=(new SchoolHelper())->getCurrectScolaryYear();
        return Payment::join('cost_generals','cost_generals.id','=','payments.cost_general_id')
            ->join('type_other_costs','type_other_costs.id','=','cost_generals.type_other_cost_id')
            ->where('payments.student_id',134)
            ->where('inscriptions.school_id',auth()->user()->school->id)
            ->where('payments.scolary_year_id',$scolaryYear->id)
            ->where('type_other_costs.id',$idType)
            ->where('payments.month_name',$month)
            ->with('inscription')
            ->first();
    }

    public static function getCurrentYearCostPaymentChecker($idType,$student_id,$month,$costId):?Payment{
        $scolaryYear=(new SchoolHelper())->getCurrectScolaryYear();
        return Payment::join('cost_generals','cost_generals.id','=','payments.cost_general_id')
            ->join('type_other_costs','type_other_costs.id','=','cost_generals.type_other_cost_id')
            ->where('payments.student_id',$student_id)
            ->where('payments.school_id',auth()->user()->school->id)
            ->where('payments.scolary_year_id',$scolaryYear->id)
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
