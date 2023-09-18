<?php

namespace App\Http\Livewire\Application\Depense\List;

use App\Http\Livewire\Helpers\DateFormatHelper;
use App\Http\Livewire\Helpers\Depense\CategoryDepenseHelser;
use App\Http\Livewire\Helpers\Depense\DepenseHelper;
use App\Http\Livewire\Helpers\Depense\DepenseSourceHelper;
use App\Http\Livewire\Helpers\SchoolHelper;
use App\Models\Depense;
use Illuminate\Support\Collection;
use Livewire\Component;

class ListDepense extends Component
{
    public  array $months = [];
    public string $month, $date;
    public bool $isByDate = true;
    public ?Depense $depense;
    public bool $isEditing = false;
    public string $source = '',$category='',$currency = '';
    public ?Collection $currencyList;
    public ?Collection $listDepense;
    public ?Collection $listDepenseSource,$listCategoryDepense;
    public string $depenseId;
    protected $listeners = [
        'refreshListDepense' => '$refresh',
        'deleteDepenseListner'=>'delete'
    ];

    public function updatedCategory($val)
    {
        $this->category = $val;
    }
    public function updatedCurrency($val)
    {
        $this->currency = $val;
    }
    public function updatedSource($val)
    {
        $this->source = $val;
    }

    public function updatedDate($val)
    {
        $this->date=$val;
        $this->isByDate = true;
    }
    public function updatedMonth($val)
    {
        $this->month=$val;
        $this->isByDate = false;
        $this->emit('getMonthEmprunt', $val);
        $this->emit('getMonthDepense', $val);
    }

    public function new()
    {
        $this->isEditing = false;
        $this->emit('getDepenseCreateFormData', $this->isEditing);
    }
    public function show(Depense $depense, string $id)
    {
       $this->depense=$depense;
       $this->emit('getDepenseData',$depense);
    }

    public function edit(Depense $depense, string $id)
    {
        $this->isEditing = true;
        $this->emit('getDepenseEditFormData', $depense, $this->isEditing);
    }


    public function showDeleteDialog(string $id): void
    {
        $this->depenseId = $id;
        $this->dispatchBrowserEvent('delete-depense-dialog');
    }

    public function delete()
    {
        try {
            $depense=DepenseHelper::show($this->depenseId);
            DepenseHelper::delete($depense);
            $this->dispatchBrowserEvent('depense-dialog-deleted', ['message'=>"Action bien réalisée !"]);
        } catch (\Exception $ex) {
            $this->dispatchBrowserEvent('error',  $ex->getMessage());
        }
    }

    public function mount()
    {
        $this->month = date('m');
        $this->date = date('Y-m-d');
        $this->months = (new DateFormatHelper())->getMonthsForScolaryYear();
        $this->currencyList = SchoolHelper::getCurrencyList();
        $this->listDepenseSource = DepenseSourceHelper::get();
        $this->listCategoryDepense=CategoryDepenseHelser::get();
    }

    public function render()
    {
        if ($this->isByDate == true) {
            $this->listDepense = DepenseHelper::getDate($this->date, $this->currency, $this->source);
        } else {
            $this->listDepense = DepenseHelper::get($this->month, $this->currency, $this->source);
        }
        $this->emit('getMonthDepense', $this->month);
        return view('livewire.application.depense.list.list-depense',);
    }
}
