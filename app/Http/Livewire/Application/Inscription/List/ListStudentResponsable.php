<?php

namespace App\Http\Livewire\Application\Inscription\List;

use App\Models\StudentResponsable;
use Livewire\Component;

class ListStudentResponsable extends Component
{
    protected $listeners = [
        'selectedClasseOption' => 'getOptionSelected',
        'refreshListResponsible'=>'$refresh'
    ];

    public  int $selectedIndex=0;
    public string $keyToSearch='';
    public function mount(int $index): void
    {
        $this->selectedIndex=$index;
    }
    public  function getOptionSelected($index): void
    {
        $this->selectedIndex=$index;
    }

    public function getResponsable(StudentResponsable $responsable): void
    {
        $this->emit('selectRresposableId',$responsable);
    }
    public function render()
    {
        return view('livewire.application.inscription.list.list-student-responsable',
            [
                'listResponsible'=>StudentResponsable::where('school_id',
                    auth()->user()->school->id)
                    ->where('name_responsable','like','%'.$this->keyToSearch.'%')
                    ->orderBy('created_at','DESC')
                    ->get()
            ]
        );
    }
}