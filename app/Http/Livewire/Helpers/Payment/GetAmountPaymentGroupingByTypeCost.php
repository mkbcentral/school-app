<?php

namespace App\Http\Livewire\Helpers\Payment;

use App\Http\Livewire\Helpers\SchoolHelper;
use App\Models\Paiment;
use App\Models\Payment;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class GetAmountPaymentGroupingByTypeCost
{
    public static  function getAmountPaymentByMonth($month,$scolaryYearId, $currency='USD'):Collection{
        return Payment::join('cost_generals','cost_generals.id','=','payments.cost_general_id')
            ->join('type_other_costs','type_other_costs.id',
                '=','cost_generals.type_other_cost_id')
            ->join('rates','rates.id','=','payments.rate_id')
            ->join('inscriptions','inscriptions.id','payments.inscription_id')
            ->where('inscriptions.scolary_year_id',$scolaryYearId)
            ->where('payments.month_name',$month)
            ->where('inscriptions.school_id',auth()->user()->school->id)
            ->with('Cost')
            ->with('student')
            ->with('student.classe')
            ->select('type_other_costs.name',$currency=='USD'?
                DB::raw("SUM(cost_generals.amount) as amount"):
                DB::raw('SUM(cost_generals.amount*rates.rate)as amount'))
            ->groupBy('type_other_costs.name')
            ->get();
    }

    public static  function getAmountPaymentByDate($date,$scolaryYearId, $currency='USD'):Collection{
        return Payment::join('cost_generals','cost_generals.id','=','payments.cost_general_id')
            ->join('type_other_costs','type_other_costs.id',
                '=','cost_generals.type_other_cost_id')
            ->join('rates','rates.id','=','payments.rate_id')
            ->join('inscriptions','inscriptions.id','payments.inscription_id')
            ->where('inscriptions.scolary_year_id',$scolaryYearId)
            ->whereDate('payments.created_at',$date)
            ->where('inscriptions.school_id',auth()->user()->school->id)
            ->with('Cost')
            ->with('student')
            ->with('student.classe')
            ->select('type_other_costs.name',
                DB::raw("COUNT(payments.id) as number"),
                $currency=='USD'?
                DB::raw("SUM(cost_generals.amount) as amount"):
                DB::raw('SUM(cost_generals.amount*rates.rate)as amount'))
            ->groupBy('type_other_costs.name')
            ->get();
    }
}
