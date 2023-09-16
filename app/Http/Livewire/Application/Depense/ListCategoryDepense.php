<?php

namespace App\Http\Livewire\Application\Depense;

use App\Http\Livewire\Helpers\Depense\CategoryDepenseHelser;
use App\Models\CategoryDepense;
use Livewire\Component;

class ListCategoryDepense extends Component
{
    public $name;
    public CategoryDepense $categoryDepense;
    public bool $isEditing = false;
    public function store()
    {
        $inputs = $this->validate(['name' => ['required', 'string']]);
        CategoryDepenseHelser::create($inputs);
        $this->dispatchBrowserEvent('added', ['message' => "Catégorie dépense bien ajoutée !"]);
        $this->name = '';
    }
    public function edit(CategoryDepense $categoryDepense, string $id)
    {
        $this->categoryDepense = $categoryDepense;
        $this->name = $categoryDepense->name;
        $this->isEditing = true;
    }

    public function update()
    {
        $inputs = $this->validate(['name' => ['required', 'string']]);
        CategoryDepenseHelser::update($this->categoryDepense, $inputs);
        $this->dispatchBrowserEvent('updated', ['message' => "Catégorie dépense bien modifiée !"]);
        $this->name = '';
        $this->isEditing = false;
    }
    public function delete(string $id)
    {
        $categoryDepense = CategoryDepenseHelser::show($id);
        CategoryDepenseHelser::delete($categoryDepense);
        $this->dispatchBrowserEvent('error', ['message' => "Catégorie bien rétirée !"]);
    }
    public function render()
    {
        return view('livewire.application.depense.list-category-depense', ['listCategoryDepense' => CategoryDepenseHelser::get()]);
    }
}
