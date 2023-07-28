<?php

namespace App\Http\Livewire\Helpers\Payment;

use App\Http\Livewire\Helpers\SchoolHelper;
use App\Models\Paiment;
use App\Models\ScolaryYear;

class GetPaymentByTypeCostToCheck
{
    public static function getPaymentChecker($idType,$studentId,$month):?Paiment{
        $scolaryYear=(new SchoolHelper())->getOldScolaryYear();
        return Paiment::join('cost_generals','cost_generals.id','=','paiments.cost_general_id')
            ->join('type_other_costs','type_other_costs.id','=','cost_generals.type_other_cost_id')
            ->where('paiments.student_id',$studentId)
            ->where('paiments.school_id',auth()->user()->school->id)
            ->where('paiments.scolary_year_id',$scolaryYear->id)
            ->where('cost_generals.type_other_cost_id',$idType)
            ->where('paiments.mounth_name',$month)
            ->select('paiments.mounth_name')
            ->first();
    }

    public static function getCurrentYearPaymentChecker($idType,$studentId,$month):?Paiment{
        $scolaryYear=(new SchoolHelper())->getCurrectScolaryYear();
        return Paiment::join('cost_generals','cost_generals.id','=','paiments.cost_general_id')
            ->join('type_other_costs','type_other_costs.id','=','cost_generals.type_other_cost_id')
            ->where('paiments.student_id',$studentId)
            ->where('paiments.school_id',auth()->user()->school->id)
            ->where('paiments.scolary_year_id',$scolaryYear->id)
            ->where('cost_generals.type_other_cost_id',$idType)
            ->where('paiments.mounth_name',$month)
            ->select('paiments.mounth_name')
            ->with('scolaryyear')
            ->with('student')
            ->with('school')
            ->with('classe')
            ->first();
    }

    public static function getCurrentYearCostPaymentChecker($idType,$studentId,$month,$costId):?Paiment{
        $scolaryYear=(new SchoolHelper())->getCurrectScolaryYear();
        return Paiment::join('cost_generals','cost_generals.id','=','paiments.cost_general_id')
            ->join('type_other_costs','type_other_costs.id','=','cost_generals.type_other_cost_id')
            ->where('paiments.student_id',$studentId)
            ->where('paiments.school_id',auth()->user()->school->id)
            ->where('paiments.scolary_year_id',$scolaryYear->id)
            ->where('cost_generals.type_other_cost_id',$idType)
            ->where('paiments.mounth_name',$month)
            ->where('paiments.cost_general_id',$costId)
            ->select('paiments.mounth_name')
            ->with('scolaryyear')
            ->with('student')
            ->with('school')
            ->with('classe')
            ->first();
    }
}
