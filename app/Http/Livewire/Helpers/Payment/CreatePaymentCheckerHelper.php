<?php

namespace App\Http\Livewire\Helpers\Payment;

use App\Models\Paiment;
use App\Models\Payment;

class CreatePaymentCheckerHelper
{
    public static function checkIfPaymentExistBeforCreate($student_id,$month,$type_other_cost,$defaultScolaryYerId):bool{
        $status=false;
        $payment= Payment::where('student_id',$student_id)
            ->join('inscriptions','inscriptions.id','payments.inscription_id')
            ->where('month_name',$month)
            ->where('cost_general_id',$type_other_cost)
            ->where('inscriptions.school_id',auth()->user()->school->id)
            ->where('inscriptions.scolary_year_id',$defaultScolaryYerId)
            ->first();
       if ($payment){
           $status=true;
       }else{
           $status=false;
       }
       return $status;
    }
}
