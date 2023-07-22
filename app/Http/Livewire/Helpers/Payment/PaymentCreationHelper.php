<?php

namespace App\Http\Livewire\Helpers\Payment;

use App\Http\Livewire\Helpers\Invoice\FormatInvoiceNumberHelper;
use App\Http\Livewire\Helpers\SchoolHelper;
use App\Models\Paiment;

 class  PaymentCreationHelper
{
    public static function create($month,$defaultScolaryYerId,$cost_other_id,$tudent_id,$classe_id,$classeOptionId):Paiment{
        $rate=(new SchoolHelper())->getCurrentRate();

       $payment= Paiment::create([
            'number_paiement'=>(new FormatInvoiceNumberHelper())->formatPaymentInvoiceNumber($classeOptionId),
            'mounth_name'=>$month,
            'scolary_year_id'=>$defaultScolaryYerId,
            'cost_general_id'=>$cost_other_id,
            'student_id'=>$tudent_id,
            'classe_id'=>$classe_id,
            'user_id'=>auth()->user()->id,
            'rate_id'=>$rate->id,
            'school_id'=>auth()->user()->school->id
        ]);
       return $payment;
    }
}
