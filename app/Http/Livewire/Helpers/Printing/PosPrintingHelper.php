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
    public function printInscription(Inscription $inscription){
        $setting = AppSetting::first();
        try {
            $connector = new WindowsPrintConnector("smb://local");
            $printer = new Printer($connector);
            $logo = EscposImage::load("logo.jpg", false);

            $printer->setJustification(Printer::JUSTIFY_CENTER);
            //$printer -> graphics($logo);
            $printer->selectPrintMode(Printer::MODE_FONT_A);
            $printer->text("COMPLEX SCOLAIRE AQUILA\n");
            $printer->text("Golf Plateau \n");
            $printer->text("Q.MUKUNTO C/ANNEXE\n");
            $printer->text("-----------------------------------------------\n");
            $printer->setJustification(Printer::JUSTIFY_LEFT);
            $printer->text("Récu N°:" . $inscription->number_paiment . "\n");
            $printer->text("Nom élève:" . $inscription->student->name . "\n");
            $printer->text("Classe:" . $inscription->getStudentClasseName($inscription) . "\n");
            $printer->text("Motif: Paiment frais " . $inscription->cost->name . "\n");
            $printer->text("Date:" . $inscription->created_at->format('d-m-Y') . "\n");
            $printer->text("-----------------------------------------------\n");
            /* Information for the receipt */
            $items = array(
                new item($inscription->cost->name, number_format($inscription->cost->amount * 2000, 1, ',', ' ')),
            );
            $total = new item('Total', number_format($inscription->cost->amount * 2000, 1, ',', ' '), true);
            $date = date('d/m/Y');
            /* Title of receipt */
            $printer->setEmphasis(true);
            $printer->text("DETAIL PIAMENT\n");
            $printer->setEmphasis(false);

            /* Items */
            $printer->setJustification(Printer::JUSTIFY_LEFT);
            $printer->setEmphasis(true);
            $printer->text(new item('', 'CDF'));
            $printer->setEmphasis(false);
            foreach ($items as $item) {
                $printer->text($item);
            }
            $printer->setEmphasis(true);
            $printer->setEmphasis(false);
            $printer->feed();

            /* Tax and total */
            $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
            $printer->text($total);
            $printer->selectPrintMode();

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

    public function printPayment(Paiment $payment){

    }
}
