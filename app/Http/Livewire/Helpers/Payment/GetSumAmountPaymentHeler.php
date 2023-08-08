<?php

namespace App\Http\Livewire\Helpers\Payment;

use App\Models\Payment;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class GetSumAmountPaymentHeler
{
    public static  function getSumAmountPaymentByDate($date,$scolaryYearId, $currency = 'USD'): float
    {
        return Payment::join('cost_generals', 'cost_generals.id', '=', 'payments.cost_general_id')
            ->join(
                'type_other_costs',
                'type_other_costs.id',
                '=',
                'cost_generals.type_other_cost_id'
            )
            ->join('students','students.id','=','payments.student_id')
            ->join('rates', 'rates.id', '=', 'payments.rate_id')
            ->where('payments.scolary_year_id', $scolaryYearId)
            ->whereDate('payments.created_at', $date)
            ->where('students.school_id', auth()->user()->school->id)
            ->where('payments.is_paid',true)
            ->with('cost')
            ->with('student')
            ->sum(
                $currency == 'USD' ?
                    DB::raw("cost_generals.amount") :
                    DB::raw('cost_generals.amount*rates.rate)')
            );
    }
}
