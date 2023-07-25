<?php

namespace App\Http\Livewire\Application\School;

use App\Http\Livewire\Helpers\SchoolHelper;
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
        $this->defaulCurrency=(new SchoolHelper())->getCurrentCurrency();
    }

    public function render()
    {
        $listCurrencies=Currency::where('school_id',auth()->user()->school->id)
            ->orderBy('currency','ASC')
            ->get();
        return view('livewire.application.school.currency-widget',['listCurrencies'=>$listCurrencies]);
    }
}
