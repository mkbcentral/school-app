<?php

namespace App\Http\Livewire\Application\Depense\Form;

use App\Http\Livewire\Helpers\Depense\DepenseHelper;
use App\Models\Currency;
use App\Models\Depense;
use App\Models\DepenseSource;
use Illuminate\Support\Collection;
use Livewire\Component;

class FormDepense extends Component
{
    public $name, $amount = 0, $currency_id, $depense_source_id;
    public Collection $listCurrency, $listDepenseSource;
    public ?Depense $depense;
    public bool $isEditing;

    protected $listeners = [
        'getDepenseCreateFormData' => 'getFormCreateData',
        'getDepenseEditFormData' => 'getFormEditData'
    ];

    public function getFormCreateData(bool $isEditing = false)
    {
        $this->isEditing = $isEditing;
        $this->name = '';
        $this->amount = '';
        $this->currency_id = '';
        $this->depense_source_id = '';
    }
    public function getFormEditData(?Depense $depense, bool $isEditing = false)
    {
        $this->depense = $depense;
        $this->isEditing = $isEditing;
        $this->amount = $depense->amount;
        $this->name = $depense->name;
        $this->currency_id = $depense->currency_id;
        $this->depense_source_id = $depense->depense_source_id;
    }

    public function mount()
    {
        $this->listCurrency = Currency::all();
        $this->listDepenseSource = DepenseSource::all();
    }

    public function store()
    {
        $inputs = $this->validate([
            'name' => ['required', 'string'],
            'amount' => ['required', 'numeric'],
            'currency_id' => ['required', 'numeric'],
            'depense_source_id' => ['required', 'numeric'],
        ]);
        DepenseHelper::create($inputs);
        $this->emit('refreshListDepense');
        $this->dispatchBrowserEvent('added', ['message' => "Dépense bien créée !"]);
        $this->resetForm();
    }

    public function update(){
        $inputs = $this->validate([
            'name' => ['required', 'string'],
            'amount' => ['required', 'numeric'],
            'currency_id' => ['required', 'numeric'],
            'depense_source_id' => ['required', 'numeric'],
        ]);
        DepenseHelper::update($this->depense,$inputs);
        $this->emit('refreshListDepense');
        $this->dispatchBrowserEvent('updated', ['message' => "Dépense bien modifiée !"]);
        $this->resetForm();
    }

    public function resetForm(){
        $this->name = '';
        $this->amount = '';
        $this->currency_id = '';
        $this->depense_source_id = '';
    }


    public function render()
    {
        return view('livewire.application.depense.form.form-depense');
    }
}
