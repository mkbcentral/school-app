<?php

namespace App\Http\Controllers\Application\Printings;

use App\Http\Controllers\Controller;
use App\Http\Livewire\Helpers\Inscription\GetAllInscriptionHelper;
use App\Http\Livewire\Helpers\Inscription\GetListInscriptionByClasseHelper;
use App\Models\Classe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ListInscriptionController extends Controller
{
    public function printListInscriptionByClasse($classeId){
        $inscriptions=GetAllInscriptionHelper::getListInscriptionByClasseForCurrentYear($classeId,'');
        $classe=Classe::find($classeId);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView(
            'livewire.application.printings.inscription.print-list-inscription-by-classse',
            compact(['inscriptions','classe'])
        );
        return $pdf->stream();
    }
}
