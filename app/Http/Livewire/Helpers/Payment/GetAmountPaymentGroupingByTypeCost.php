<?php

namespace App\Http\Livewire\Helpers\Payment;

use App\Http\Livewire\Helpers\SchoolHelper;
use App\Models\Paiment;
use App\Models\Payment;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class GetAmountPaymentGroupingByTypeCost
{
    /**
     * Recuperer la liste des totaux de payments mensuels grouper par type de frais (TypeOtherConst)
     * @param $month
     * @param $scolaryYearId
     * @param $currency
     * @return Collection
     */
    public static  function getAmountPaymentByMonth($month, $scolaryYearId): Collection
    {
        return Payment::join('cost_generals', 'cost_generals.id', '=', 'payments.cost_general_id')
            ->join(
                'type_other_costs',
                'type_other_costs.id',
                '=',
                'cost_generals.type_other_cost_id'
            )
            ->join('students', 'students.id', '=', 'payments.student_id')
            ->join('rates', 'rates.id', '=', 'payments.rate_id')
            ->where('payments.scolary_year_id', $scolaryYearId)
            ->where('payments.month_name', $month)
            ->where('students.school_id', auth()->user()->school->id)
            ->where('payments.is_paid', true)
            ->with('cost')
            ->with('student')
            ->with('classe')
            ->with('classe.optionClasse')
            ->select(
                'type_other_costs.name',
                DB::raw("SUM(cost_generals.amount) as amount")
            )
            ->groupBy('type_other_costs.name')
            ->get();
    }

    /**
     * Recuperer la liste des totaux de payments journlières grouper par type de frais (TypeOtherConst)
     * @param $date
     * @param $scolaryYearId
     * @param $currency
     * @return Collection
     */
    public static  function getAmountPaymentByDate($date, $scolaryYearId): Collection
    {
        return Payment::join('cost_generals', 'cost_generals.id', '=', 'payments.cost_general_id')
            ->join(
                'type_other_costs',
                'type_other_costs.id',
                '=',
                'cost_generals.type_other_cost_id'
            )
            ->join('students', 'students.id', '=', 'payments.student_id')
            ->join('rates', 'rates.id', '=', 'payments.rate_id')
            //->join('currencies', 'currencies.id', '=', 'cost_generals.currency_id')
            ->where('payments.scolary_year_id', $scolaryYearId)
            ->whereDate('payments.created_at', $date)
            ->where('students.school_id', auth()->user()->school->id)
            ->where('payments.is_paid', true)
            ->with('cost')
            ->with('student')
            ->select(
                'type_other_costs.name',
                //'currencies.currency',
                DB::raw("COUNT(payments.id) as number"),
                DB::raw("SUM(cost_generals.amount) as amount")
            )
            ->groupBy('type_other_costs.name')
            ->get();
    }
}
