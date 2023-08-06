<?php

namespace App\Console\Commands;

use App\Http\Livewire\Helpers\DateFormatHelper;
use App\Models\Inscription;
use App\Models\Payment;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Console\Command;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RestoreOldStudnet extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:restore-old-studnet';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Restaurer la liste des ancien eélèves';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $inscDate=array();
        $students=Student::all();
        $inscDate=array();
        $nameNotInsc=array();

        $this->comment("Payment bien mis à jour");
    }

}
