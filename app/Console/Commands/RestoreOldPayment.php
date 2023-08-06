<?php

namespace App\Console\Commands;

use App\Models\CostGeneral;
use App\Models\Payment;
use Illuminate\Console\Command;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RestoreOldPayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:restore-old-payment';

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
        $worksheet=$this->getActiveSheet(storage_path('data/payments.xlsx'));
        foreach ($worksheet->getRowIterator() as $row) {
            if($counter++ ==0) continue;
            $iteratorCell=$row->getCellIterator();
            $iteratorCell->setIterateOnlyExistingCells(true);
            $cells=[];
            foreach ($iteratorCell as $cell) {
                $cells[]=$cell->getValue();

            }
            /*
            Payment::create([
                'id'=>$cells[0],
                'name'=>$cells[1],
                'amount'=>$cells[2],
                'active'=>$cells[3],
                'type_other_cost_id'=>$cells[4],

            ]);
            */
        }
        dd($cells);
        $this->comment("Fiche bien importées");
    }
    public function getActiveSheet(string $path): Worksheet
    {
        return (new Xlsx)->load($path)->getActiveSheet();
    }
}
