<?php

namespace App\Http\Livewire\Application\Inscription\Forms;

use App\Http\Livewire\Helpers\Cost\CostInscriptionHelper;
use App\Http\Livewire\Helpers\DateFormatHelper;
use App\Http\Livewire\Helpers\Inscription\CreateInscriptionHelper;
use App\Http\Livewire\Helpers\SchoolHelper;
use App\Models\Classe;
use App\Models\ClasseOption;
use App\Models\CostInscription;
use App\Models\Inscription;
use App\Models\ScolaryYear;
use App\Models\Student;
use App\Models\TypeOtherCost;
use Livewire\Component;

class AddNewReinscription extends Component
{
    protected $listeners = ['studentReinscription' => 'getStudent'];
    public  $student = null;
    public $classe_id, $cost_inscription_id, $classe_option_id;
    public $costInscriptionList = [], $listClasseOption = [];
    public $defaultScolaryYear,$months=[];
    public $listTypeCost=[];

    public function updatedClasseOptionId($val)
    {
        $this->classe_option_id = $val;
    }
    public function getStudent(Student $student)
    {
        $this->student = null;
        $this->student = $student;
    }

    public function store()
    {
        $this->validateForm();
        $inscription = Inscription::where('student_id', $this->student->id)
            ->where('classe_id', $this->classe_id)
            ->where('scolary_year_id', $this->defaultScolaryYear->id)
            ->first();
        if ($inscription) {
            $this->dispatchBrowserEvent('error', ['message' => "Cet élève est déjà inscrit !"]);
        } else {
            (new CreateInscriptionHelper())
                ->create(
                    $this->defaultScolaryYear->id,
                    $this->cost_inscription_id,
                    $this->student->id,
                    $this->classe_id,
                );
            $this->emit('refreshListInscription');
            $this->dispatchBrowserEvent('added', ['message' => "Reinscription bien sauvegargée !"]);
        }
    }

    public function validateForm(){
        $this->validate([
            'classe_option_id' => ['required', 'numeric'],
            'cost_inscription_id' => ['required', 'numeric'],
            'classe_id' => ['required', 'numeric'],
        ]);
    }

    public function mount()
    {
        $this->costInscriptionList =(new CostInscriptionHelper())->getListCostInscription();
        $this->listClasseOption = (new SchoolHelper())->getListClasseOption();
        $this->defaultScolaryYear = (new SchoolHelper())->getCurrectScolaryYear();

        $this->listTypeCost=TypeOtherCost::where('active',true)
            ->whereIn('id',[1,2])
            ->get();
        $this->months=(new DateFormatHelper())->getMonthsForYear();
    }

    public function render()
    {
        $classeList = (new SchoolHelper())->getListClasseByOption($this->classe_option_id);
        return view('livewire.application.inscription.forms.add-new-reinscription', ['classeList' => $classeList]);
    }
}
