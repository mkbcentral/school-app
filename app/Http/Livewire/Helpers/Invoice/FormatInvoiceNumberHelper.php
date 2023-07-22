<?php

namespace App\Http\Livewire\Helpers\Invoice;

use App\Http\Livewire\Helpers\SchoolHelper;
use App\Models\ClasseOption;

class FormatInvoiceNumberHelper
{
    public function formatInscriptionInvoiceNumber($classeOptionId):string{
        $scolaryYear=(new SchoolHelper())->getCurrectScolaryYear();
        $classeOption=ClasseOption::find($classeOptionId);
        return substr(auth()->user()->school->name,0,2)
            .'-'.rand(1000,10000).'-'.
            substr($classeOption->name,0,1).'-'
            .substr($scolaryYear->name,-3).'-ISC';
    }

    public function formatPaymentInvoiceNumber($classeOptionId):string{
        $scolaryYear=(new SchoolHelper())->getCurrectScolaryYear();
        $classeOption=ClasseOption::find($classeOptionId);
        return substr(auth()->user()->school->name,0,2)
            .'-'.rand(1000,10000).'-'.
            substr($classeOption->name,0,1).'-'
            .substr($scolaryYear->name,-3).'-FR';
    }
}
