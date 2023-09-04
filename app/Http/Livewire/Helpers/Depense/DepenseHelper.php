<?php

namespace App\Http\Livewire\Helpers\Depense;

use App\Models\Depense;
use App\Models\DepenseSource;
use Illuminate\Support\Collection;

class DepenseHelper
{
    public function get(string $month): Collection
    {
        return Depense::whereMonth('created_at', $month)
            ->orderBy('created_at', 'DESC')
            ->with(['currency', 'depenseSource'])
            ->get();
    }
    public function getDate(string $date): Collection
    {
        return Depense::whereDate('created_at', $date)
            ->orderBy('created_at', 'DESC')
            ->with(['currency', 'depenseSource'])
            ->get();
    }
    public static function create(array $inputs)
    {
        Depense::create($inputs);
    }
    public static function show(string $id): Depense
    {
        return Depense::find($id);
    }
    public static function update(Depense $depense, array $inputs)
    {
        $depense->update($inputs);
    }
    public static function delete(Depense $depense)
    {
        $depense->delete();
    }
}
