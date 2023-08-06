<?php

namespace App\Console\Commands;

use App\Models\TypeOtherCost;
use Illuminate\Console\Command;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RestoreOldTypeCostOther extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:restore-old-type-cost-other';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $counter=0;
        $worksheet=$this->getActiveSheet(storage_path('data/type_other_costs.xlsx'));
        foreach ($worksheet->getRowIterator() as $row) {
            if($counter++ ==0) continue;
            $iteratorCell=$row->getCellIterator();
            $iteratorCell->setIterateOnlyExistingCells(true);
            $cells=[];
            foreach ($iteratorCell as $cell) {
                $cells[]=$cell->getValue();

            }
            TypeOtherCost::create([
                'id'=>$cells[0],
                'name'=>$cells[1],
                'school_id'=>$cells[2],
                'active'=>$cells[3],
                'scolary_year_id'=>$cells[4],

            ]);
        }
        $this->comment("Fiche bien importées");
    }
    public function getActiveSheet(string $path): Worksheet
    {
        return (new Xlsx)->load($path)->getActiveSheet();
    }
}
