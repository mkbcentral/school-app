<?php

namespace App\Http\Livewire\Application\Depense\Form;

use App\Http\Livewire\Helpers\Depense\DepenseHelper;
use App\Models\Currency;
use App\Models\DepenseSource;
use Illuminate\Support\Collection;
use Livewire\Component;

class FormDepense extends Component
{
    public $name,$amount=0,$currency_id,$depense_source_id;
    public Collection $listCurrency,$listDepenseSource;

    public function mount(){
        $this->listCurrency=Currency::all();
        $this->listDepenseSource=DepenseSource::all();
    }

    public function store(){
        $inputs=$this->validate([
            'name'=>['required','string'],
            'amount'=>['required','numeric'],
            'currency_id'=>['required','numeric'],
            'depense_source_id'=>['required','string'],
        ]);
        DepenseHelper::create($inputs);
        $this->dispatchBrowserEvent('updated', ['message' => "Emprunt bien modifié !"]);
        $this->name='';
        $this->amount='';
        $this->currency_id='';
        $this->depense_source_id='';
    }

    public function render()
    {
        return view('livewire.application.depense.form.form-depense');
    }
}
