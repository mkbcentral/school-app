<?php

namespace App\Http\Controllers\Application\Printings;

use App\Http\Controllers\Controller;
use App\Http\Livewire\Helpers\Inscription\GetInscriptionByDateWithPaymentStatusHelper;
use App\Http\Livewire\Helpers\Payment\PaymentByDateHelper;
use App\Http\Livewire\Helpers\Payment\PaymentByMonthHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class RapportInscriptionPaymentPrintingController extends Controller
{

    public function printRepportInscriptionPaymentByDate($date, $currency, $scolaryYearId){
        $inscriptionList= (new GetInscriptionByDateWithPaymentStatusHelper())
            ->getDateInscriptions($date, $scolaryYearId, 0, 0,$currency);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView(
            'livewire.application.printings.inscription.print-inscription-payment-by-date',
            compact(['inscriptionList','currency'])
        );
        return $pdf->stream();
    }
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
