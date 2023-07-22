<?php

namespace App\Http\Livewire\Helpers\Printing;

use App\Models\AppSetting;
use App\Models\Inscription;
use App\Models\Paiment;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;

class PosPrintingHelper
{
    public function printInscription(Inscription $inscription,$currency='USD'){
        $setting = AppSetting::first();
        try {
            $connector = new WindowsPrintConnector("EPSON-PRINTER");
            $printer = new Printer($connector);

            $printer->setJustification(Printer::JUSTIFY_CENTER);
            //$printer -> graphics($logo);
            $printer->selectPrintMode(Printer::MODE_FONT_A);
            $printer->text("COMPLEX SCOLAIRE AQUILA\n");
            $printer->text("Golf Plateau \n");
            $printer->text("Q.MUKUNTO C/ANNEXE\n");
            $printer->text("------------------------------------------------\n");
            $printer->setJustification(Printer::JUSTIFY_LEFT);
            $printer->text("Récu N°:" . $inscription->number_paiment . "\n");
            $printer->text("Nom élève:" . $inscription->student->name . "\n");
            $printer->text("Classe:" . $inscription->getStudentClasseName($inscription) . "\n");
            $printer->text("Motif: Paiment frais " . $inscription->cost->name . "\n");
            $printer->text("Date:" . $inscription->created_at->format('d-m-Y') . "\n");
            $printer->text("------------------------------------------------\n");
            /* Information for the receipt */
            $amount=($currency=='USD'?$inscription->cost->amount:$inscription->cost->amount*$inscription->rate->rate);
            $items = array(
                new item($inscription->cost->name,app_format_number($amount).' '.$currency),
            );
            $total = new item('Total', app_format_number($amount).' '.$currency, true);
            $date = date('d/m/Y');
            /* Title of receipt */
            $printer->setEmphasis(true);
            $printer->text("DETAIL PIAMENT\n");
            $printer->setEmphasis(false);
            foreach ($items as $item) {
                $printer->text($item);
            }
            $printer->text("------------------------------------------------\n");
            /* Information for the receipt */
            $printer->setEmphasis(true);
            $printer->setEmphasis(false);
            $printer->feed();

            /* Tax and total */
            $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
            $printer->text($total);
            $printer->selectPrintMode();
            $printer->text("------------------------------------------------\n");
            /* Information for the receipt */
            /* Footer */
            $printer->feed(2);
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->text("Merci pour votre confiance\n");
            $printer->text("L'education de votre enfant est notre priorité\n");
            $printer->feed(2);
            $printer->text($date . "\n");
            $printer->text("\n");
            $printer->cut();
            $printer->close();
        } catch (\Exception $th) {
            dd($th->getMessage());
        }
    }

    public function printPayment(Paiment $payment,$currency='USD'){
        try {
            $connector = new WindowsPrintConnector("EPSON-PRINTER");
            $printer = new Printer($connector);

            $printer->setJustification(Printer::JUSTIFY_CENTER);
            //$printer -> graphics($logo);
            $printer->selectPrintMode(Printer::MODE_FONT_A);
            $printer->text("COMPLEX SCOLAIRE AQUILA\n");
            $printer->text("Golf Plateau \n");
            $printer->text("Q.MUKUNTO C/ANNEXE\n");
            $printer->text("------------------------------------------------\n");
            $printer->setJustification(Printer::JUSTIFY_LEFT);
            $printer->text("Récu N°:" . $payment->number_paiement . "\n");
            $printer->text("Nom élève:" . $payment->student->name . "\n");
            $printer->text("Classe:" . $payment->student->inscription->getStudentClasseName($payment->student->inscription) . "\n");
            $printer->text("Motif: Paiment frais ".$payment->cost->name . "\n");
            $printer->text("Date:" . $payment->created_at->format('d-m-Y') . "\n");
            $printer->text("------------------------------------------------\n");
            /* Information for the receipt */
            $amount=($currency=='USD'?$payment->cost->amount:$payment->cost->amount*$payment->rate->rate);
            $items = array(
                new item($payment->cost->name,app_format_number($amount).' '.$currency),
            );
            $total = new item('Total', app_format_number($amount).' '.$currency, true);
            $date = date('d/m/Y');
            /* Title of receipt */
            $printer->setEmphasis(true);
            $printer->text("DETAIL PIAMENT\n");
            $printer->setEmphasis(false);
            foreach ($items as $item) {
                $printer->text($item);
            }
            $printer->text("------------------------------------------------\n");
            /* Information for the receipt */
            $printer->setEmphasis(true);
            $printer->setEmphasis(false);
            $printer->feed();

            /* Tax and total */
            $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
            $printer->text($total);
            $printer->selectPrintMode();
            $printer->text("------------------------------------------------\n");
            /* Information for the receipt */
            /* Footer */
            $printer->feed(2);
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->text("Merci pour votre confiance\n");
            $printer->text("L'education de votre enfant est notre priorité\n");
            $printer->feed(2);
            $printer->text($date . "\n");
            $printer->text("\n");
            $printer->cut();
            $printer->close();
        } catch (\Exception $th) {
            dd($th->getMessage());
        }
    }
}
