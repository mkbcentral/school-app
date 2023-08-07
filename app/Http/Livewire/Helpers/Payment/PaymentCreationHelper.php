<?php

namespace App\Http\Livewire\Helpers\Payment;

use App\Http\Livewire\Helpers\Invoice\FormatInvoiceNumberHelper;
use App\Http\Livewire\Helpers\SchoolHelper;
use App\Models\Paiment;
use App\Models\Payment;

class  PaymentCreationHelper
{
    public static function create($month,$cost_other_id,$classeOptionId,$inscriptionId,$studentId,$scolaryId,$classeId):Payment{
        $rate=(new SchoolHelper())->getCurrentRate();
        return Payment::create([
             'number_payment'=>(new FormatInvoiceNumberHelper())->formatPaymentInvoiceNumber($classeOptionId),
             'month_name'=>$month,
             'cost_general_id'=>$cost_other_id,
             'classe_id'=>$classeId,
             'scolary_year_id'=>$scolaryId,
             'inscription_id'=>$inscriptionId,
             'student_id'=>$studentId,
             'school_id'=>auth()->user()->school->id,
             'user_id'=>auth()->user()->id,
             'rate_id'=>$rate->id,
         ]);
    }
}
