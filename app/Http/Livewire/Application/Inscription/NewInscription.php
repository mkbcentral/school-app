<?php

namespace App\Http\Livewire\Application\Inscription;

use App\Models\ClasseOption;
use Livewire\Component;

class NewInscription extends Component
{
    public $selectedIndex = 0;
    public $costs = [];
    public  $optionList;

    public function shwoFormCreate()
    {
        $this->emit('selectedClasseOption', $this->selectedIndex);
    }
    public function mount()
    {
        $defualtOption = ClasseOption::first();
        $this->selectedIndex = $defualtOption->id;
        $this->optionList = ClasseOption::orderBy('name', 'ASC')->get();
    }
    public function changeIndex(ClasseOption $option)
    {
        $this->selectedIndex = $option->id;
        $this->emit('selectedClasseOption', $this->selectedIndex);;
    }

    public function render()
    {
        return view('livewire.application.inscription.new-inscription');
    }
}
