<?php

namespace App\Http\Livewire\Application\Depense;

use App\Http\Livewire\Helpers\DateFormatHelper;
use App\Http\Livewire\Helpers\Depense\EmpruntHelper;
use App\Http\Livewire\Helpers\SchoolHelper;
use App\Models\Currency;
use App\Models\Emprunt;
use Illuminate\Support\Collection;
use Livewire\Component;

class ListEmprunt extends Component
{

    public $amount, $currency_id, $created_at;
    public Emprunt $emprunt;
    public bool $isEditing = false;
    public Collection $listCurrency;
    public  array $months = [];
    public string $month;
    public $totalByCurrency;

    public function updatedMonth($val)
    {
        $this->month = $val;
    }

    public function store()
    {
        $inputs = $this->validate(['amount' => ['required', 'numeric'], 'currency_id' => ['required', 'numeric']]);
        EmpruntHelper::create($inputs);
        $this->dispatchBrowserEvent('added', ['message' => "Emprunt bien ajouté !"]);
        $this->amount = '';
    }
    public function edit(Emprunt $emprunt, string $id)
    {
        $this->emprunt = $emprunt;
        $this->amount = $emprunt->amount;
        $this->created_at = $emprunt->created_at->format('Y-m-d');
        $this->currency_id = $emprunt->currency_id;
        $this->isEditing = true;
    }

    public function update()
    {
        $inputs = $this->validate([
            'amount' => ['required', 'numeric'],
            'currency_id' => ['required', 'numeric'],
            'created_at'=>['date','required']
        ]);
        EmpruntHelper::update($this->emprunt, $inputs);
        $this->dispatchBrowserEvent('updated', ['message' => "Emprunt bien modifié !"]);
        $this->amount = '';
        $this->currency_id = '';
        $this->isEditing = false;
    }
    public function delete(string $id)
    {
        $emprunt = EmpruntHelper::show($id);
        EmpruntHelper::delete($emprunt);
        $this->dispatchBrowserEvent('error', ['message' => "Emprunt bien rétiré !"]);
    }

    public function mount()
    {
        $this->listCurrency = Currency::all();
        $this->month = date('m');
        $this->months = (new DateFormatHelper())->getMonthsForScolaryYear();
    }
    public function render()
    {
        $this->totalByCurrency = EmpruntHelper::getAmountEmpruntGroupingByCurrency($this->month);
        return view('livewire.application.depense.list-emprunt', ['listEmprunt' => EmpruntHelper::get($this->month)]);
    }
}
