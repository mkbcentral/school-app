<?php

namespace App\Http\Livewire\Application\School;

use App\Models\Currency;
use Livewire\Component;

class CurrencyWidget extends Component
{
    public $defaulCurrency;
    public $currency_id;

    public function updatedCurrencyId($val){
        $this->emit('CurrancyFresh', $val);
    }

    public function mount(){
        $this->defaulCurrency=Currency::where('school_id',auth()->user()->school->id)
            ->where('id',1)
            ->first();
    }

    public function render()
    {
        $listCurrencies=Currency::where('school_id',auth()->user()->school->id)
            ->orderBy('currency','ASC')
            ->get();
        return view('livewire.application.school.currency-widget',['listCurrencies'=>$listCurrencies]);
    }
}
