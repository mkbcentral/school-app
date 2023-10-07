<?php

namespace App\Http\Livewire\Application\Tarification;

use App\Http\Livewire\Helpers\Cost\TypeCostHelper;
use App\Http\Livewire\Helpers\SchoolHelper;
use App\Models\Currency;
use App\Models\TypeOtherCost;
use Exception;
use Livewire\Component;

class TypeCostTarification extends Component
{
    public $listCurrecies=[];
    public $name,$currency_id;
    public $isEditing=false;

    public $typeCost;
    public function mount(){
        $this->listCurrecies=Currency::all();
    }

    public function edit(string $id){
      $this->typeCost =TypeOtherCost::find($id);
      $this->name=$this->typeCost->name;
      $this->currency_id=$this->typeCost->currency_id;
      $this->isEditing=true;
    }

    public function store(){
        $this->validate([
            'name'=>['required','string'],
            'currency_id'=>['required','numeric']
        ]);
        $scolaryYear=(new SchoolHelper())->getCurrectScolaryYear();
        try {
            TypeOtherCost::create([
                'name'=>$this->name,
                'school_id'=>auth()->user()->school_id,
                'active'=>true,
                'scolary_year_id'=>$scolaryYear->id,
                'currency_id'=>$this->currency_id,
            ]);
            $this->dispatchBrowserEvent('added',['message'=>'Action bien effectuée']);
        } catch (Exception $ex) {
            $this->dispatchBrowserEvent('added',['message'=>$ex->getMessage()]);
        }
    }
    public function update(){
        $this->validate([
            'name'=>['required','string'],
            'currency_id'=>['required','numeric']
        ]);
        try {
           $this->typeCost->name=$this->name;
           $this->typeCost->currency_id=$this->currency_id;
           $this->typeCost->update();
           $this->dispatchBrowserEvent('updated',['message'=>'Action bien effectuée']);
           $this->isEditing=false;
           $this->name='';
           $this->currency_id='';
        } catch (Exception $ex) {
            $this->dispatchBrowserEvent('added',['message'=>$ex->getMessage()]);
        }
    }
    public function render()
    {
        $scolaryYear=(new SchoolHelper())->getCurrectScolaryYear();
        return view('livewire.application.tarification.type-cost-tarification',[
            'listTypeCost' => ((new TypeCostHelper()))->getListTypeCost($scolaryYear->id)
        ]);
    }
}
