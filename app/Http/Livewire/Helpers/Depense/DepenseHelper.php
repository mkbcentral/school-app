<?php

namespace App\Http\Livewire\Helpers\Depense;

use App\Models\Depense;
use App\Models\DepenseSource;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class DepenseHelper
{
    /**
     * Get list despense by month
     * @param string $month
     * @return Collection
     */
    public static function get(string $month, $curreny = "", $source = ""): Collection
    {
        return Depense::whereMonth('depenses.created_at', $month)
            ->join('currencies', 'currencies.id', 'depenses.currency_id')
            ->join('depense_sources', 'depense_sources.id', 'depenses.depense_source_id')
            ->orderBy('depenses.created_at', 'DESC')
            ->select(
                'depenses.*',
                DB::raw('currencies.currency as currency_name'),
                DB::raw('depense_sources.name as source')
            )
            ->with(['currency', 'depenseSource'])
            ->where('currencies.currency', 'LIKE', '%' . $curreny . '%')
            ->where('depense_sources.name', 'LIKE', '%' . $source . '%')
            ->get();
    }
    /**
     * Get list despense by date
     * @param string $date
     * @param string $curreny
     * @param string $source
     * @return Collection
     */
    public static function getDate(string $date, string $curreny = '', $source = ""): Collection
    {
        return Depense::whereDate('depenses.created_at', $date)
            ->join('currencies', 'currencies.id', 'depenses.currency_id')
            ->join('depense_sources', 'depense_sources.id', 'depenses.depense_source_id')
            ->orderBy('depenses.created_at', 'DESC')
            ->select(
                'depenses.*',
                DB::raw('currencies.currency as currency_name'),
                DB::raw('depense_sources.name as source')
            )
            ->with(['currency', 'depenseSource'])
            ->where('currencies.currency', 'LIKE', '%' . $curreny . '%')
            ->where('depense_sources.name', 'LIKE', '%' . $source . '%')
            ->get();
    }

    public static function getAmountGoupingByCurrency(string $month):Collection{
        return Depense::whereMonth('depenses.created_at', $month)
        ->join('currencies', 'currencies.id', 'depenses.currency_id')
        ->orderBy('depenses.created_at', 'DESC')
        ->select(
            'currencies.currency as currency_name',
            DB::raw('sum(depenses.amount) as total'),
        )
        ->groupBy('currencies.currency')
        ->get();
    }

    public static function create(array $inputs)
    {
        $inputs['school_id'] = auth()->user()->school->id;
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
