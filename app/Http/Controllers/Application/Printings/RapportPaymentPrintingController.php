<?php

namespace App\Http\Controllers\Application\Printings;

use App\Http\Controllers\Controller;
use App\Http\Livewire\Helpers\Payment\PaymentByDateHelper;
use App\Http\Livewire\Helpers\Payment\PaymentByMonthHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class RapportPaymentPrintingController extends Controller
{
    public function printRapport($month,$idSColaryYear,$idCost,$type,$classeId,$currency)
    {
        $listPayments=PaymentByMonthHelper::getMonthPayments(
            $month,
            $idSColaryYear,
            $idCost,
            $type,
            $classeId,
            '',
            $currency
        );
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView(
            'livewire.application.printings.payment.print-rapport-payment-view',
            compact(['listPayments','currency'])
        );
        return $pdf->stream();
    }
}
